<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Player;
use AppBundle\Entity\Question;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class DefaultController extends Controller
{
   
    /**
    * @Route("/signup",name="signup")
    */
public function signup(Request $request)
{
   $newPlayer=new Player();
   $f=$this->createFormBuilder($newPlayer)
       ->add("Name",TextType::class,array('label' => 'Name : '))
       ->add("Username",TextType::class,array('label' => 'Username : '))
       ->add("Email",TextType::class,array('label' => 'Email : '))
       ->add("Password",PasswordType::class,array('label' => 'Password : '))
       ->add("Signup",SubmitType::class ,array('label' => 'SIGN UP'))
       ->getForm();
     $f->handleRequest($request);
     $validator = $this->get('validator');
     $errors = $validator->validate($newPlayer);
 
    if ($f->isSubmitted() && $f->isValid()){
        $em=$this->getDoctrine()->getManager();
        // new user starts with the first question
        $firstIdQuestion = $em->find('AppBundle\Entity\Question', 1);
        $newPlayer->setIdQuestion($firstIdQuestion);
       $em->persist($newPlayer);
       $em->flush();
       return $this->redirectToRoute('signin');
    }
   return $this->render('default/signup.html.twig', 
   ["f"=>$f->createView(),'errors' => $errors,]);
   
}
 
  /**
    * @Route("/",name="signin")
    */
   
public function signin(Request $request)
{
   $newPlayer=new Player();
   $f=$this->createFormBuilder($newPlayer)
       ->add("Username",TextType::class,array('label' => 'Username :'))
       ->add("Password",TextType::class,array('label' => 'Password : '))
       ->add("SIGNIN",SubmitType::class ,array('label' => 'SIGN IN'))
       ->getForm();
   $f->handleRequest($request);
  if ($f->isSubmitted() && $f->isValid()){
       $em=$this->getDoctrine()->getManager();
       $em->persist($l);
       $em->flush();
       return $this->redirectToRoute('signup');
   }
   return $this->render('default/signin.html.twig', [
       "f"=>$f->createView()
   ]);
}

 /**
    * @Route("/game",name="game")
    */
public function game(Request $request){
   $player= new Player();
    $repository = $this->getDoctrine()->getRepository(Player::class);
    // 1 is the player id that should be given as parameter
    $player=$repository->find(1);
  
    //get Question for the player 
    $repository = $this->getDoctrine()->getRepository(Question::class);
    $question=$repository->find($player->getIdQuestion()->getRank());
    //manage ranks
    $rank = $player->getScore();
    if($rank==0){
        $elo= "img/ranks/unranked.jfif";
    }else if ($rank>0 && $rank<=100){
        $elo= "img/ranks/Iron.png";
        $LP=$rank;
    }else if ($rank>100 && $rank<=200){
       $LP=$rank-100;
        $elo= "img/ranks/Bronze.png";
    }else if($rank>200 && $rank<=300){
       $LP=$rank-200;
        $elo= "img/ranks/Silver.png";
    }else if($rank>300 && $rank<=400){
       $LP=$rank-300;
        $elo= "img/ranks/Gold.png";
    }else if($rank>400 && $rank<=500){ 
       $LP=$rank-400;
        $elo= "img/ranks/Platinum.png";
    }else if ($rank>500 && $rank<=600){
       $LP=$rank-500;
        $elo= "img/ranks/Diamond.png";
    }else if ($rank>600 && $rank<=700){
       $LP=$rank-600;
        $elo= "img/ranks/Master.png";
    }else if ($rank>700 && $rank<=800){
        $LP=$rank;
        $elo= "img/ranks/GrandMaster.png";
     }else if($rank>800){
       $LP=$rank;
        $elo= "img/ranks/Challenger.png";
     }

    //control ShownImages
     self::ControlShownImages($question,$player);

    //empty Question
   $res =new Question();
    $f=$this->createFormBuilder($res)
    ->add("Response",TextType::class)
    ->add("Submit",SubmitType::class ,array('label' => '>'))
    ->getForm();
    
$f->handleRequest($request);
if ($f->isSubmitted() && $f->isValid()){
    
    //getting posted form data
    $data = $f->getData();

    // getting current loot
    $BE= $player->getBE(); 
    $score = $player->getScore();


    // if response is correct
    if($data->getResponse()==$question->getResponse()){
       $player->setBE($BE+1000); 
        $player->setScore($score+$question->getReward());
        $player->setShownImages(1);
        $em=$this->getDoctrine()->getManager();
        // player->getIdGuestion return a question object then we acces to rank and increment it
        $question=$em->getRepository(Question::class)->find($player->getIdQuestion()->getRank()+1);
        $player->setIdQuestion($question);
        $em->persist($player);
         $em->flush();  
          // TODO Create Victory Screen 
         
    // if response is incorrect     
    } if ($data->getResponse()!=$question->getResponse()){
        $this->addFlash('errors-game','Incorrect Answer');
    
    }
   
    return $this->redirectToRoute('game');
}
return $this->render('default/game.html.twig', [
    'p'=>$player,
    'elo'=>$elo,
    'LP'=>$LP,
    'q'=>$question,
    'f'=>$f->createView()
    ]);
}
 

/**
* @Route("/suppPlayer/{id}", name="suppPlayer")
*/
public function suppPlayer($id)
{
   $em=$this->getDoctrine()->getManager();
   $Player=$em->getRepository(Player::class)->find($id);
   $em->remove($Player);
   $em->flush();
  return $this->redirectToRoute('game');
}
/**
* @Route("/showImage/{id}/{num}/{PriceKey}", name="showImage")
*/
public function showImage($id,$num,$PriceKey)
{
   $em=$this->getDoctrine()->getManager();
   $Player=$em->getRepository(Player::class)->find($id);
   $nbShownImages= $Player->getShownImages();
   $nbCle= $Player->getCle();
   // there is image to unlock have enough keys
   if ($nbShownImages<1111 && $PriceKey<=$nbCle ){
   $Player->setShownImages($nbShownImages+$num);
   $Player->setCle($nbCle-$PriceKey);
   $em->persist($Player);
   $em->flush();
   }else{ 
       $needed =$PriceKey-$nbCle ;
       if($needed>1){
           $keys ="keys";
       }else{
           $keys="key";
       }

        //  $this->addFlash('error','You need '.$needed.' '.$keys.' to unlock this chest');
        
   
   }
  return $this->redirectToRoute('game');
}

/**
* @Route("/shop/{id}", name="shop")
*/
public function shop($id){
    $player= new Player();
    $repository = $this->getDoctrine()->getRepository(Player::class);
    $player=$repository->find($id);
 //elo rank 
 $rank = $player->getScore();
 if($rank==0){
     $elo= "img/ranks/unranked.jfif";
 }else if ($rank>0 && $rank<=100){
     $elo= "img/ranks/Iron.png";
     $LP=$rank;
 }else if ($rank>100 && $rank<=200){
    $LP=$rank-100;
     $elo= "img/ranks/Bronze.png";
 }else if($rank>200 && $rank<=300){
    $LP=$rank-200;
     $elo= "img/ranks/Silver.png";
 }else if($rank>300 && $rank<=400){
    $LP=$rank-300;
     $elo= "img/ranks/Gold.png";
 }else if($rank>400 && $rank<=500){ 
    $LP=$rank-400;
     $elo= "img/ranks/Platinum.png";
 }else if ($rank>500 && $rank<=600){
    $LP=$rank-500;
     $elo= "img/ranks/Diamond.png";
 }else if ($rank>600 && $rank<=700){
    $LP=$rank-600;
     $elo= "img/ranks/Master.png";
 }else if ($rank>700 && $rank<=800){
     $LP=$rank;
     $elo= "img/ranks/GrandMaster.png";
  }else if($rank>800){
    $LP=$rank;
     $elo= "img/ranks/Challenger.png";
  }
  
    return $this->render('default/shop.html.twig', [
        'p'=>$player,
        'elo'=>$elo,
        'LP'=>$LP
    ]);

}
/**
* @Route("/PurchaseKeys/{id}/{price}/{Quantity}", name="PurchaseKeys")
*/
 public function PurchaseKeys($id,$price,$Quantity){
    $player= new Player();
    $repository = $this->getDoctrine()->getRepository(Player::class);
    $player=$repository->find($id);
    $BE=$player->getBE();
    if($price<=$BE){
    $nbMyKeys=$player->getCle();
    $player->setCle($nbMyKeys+$Quantity);
    $player->setBE($BE-$price);
    $em=$this->getDoctrine()->getManager();
    $em->persist($player);
    $em->flush();
    $this->addFlash('valid',"Purchase Sucessfully done !");
}else{
    $this->addFlash('error','You Don\'t Have enough BE!');
}
    return $this->redirectToRoute('shop',array('id' => $id));
 }
 public function ControlShownImages(Question $question,Player $player){
 if($player->getShownImages()==1){
    $question->setImage2('img/chest.jpg');
    $question->setImage3('img/chest.jpg');
    $question->setImage4('img/chest.jpg');
}else if ($player->getShownImages()==11){
    $question->setImage3('img/chest.jpg');
    $question->setImage4('img/chest.jpg');
}else if($player->getShownImages()==101){
    $question->setImage2('img/chest.jpg');
    $question->setImage4('img/chest.jpg');
}else if($player->getShownImages()==1001){
    $question->setImage2('img/chest.jpg');
    $question->setImage3('img/chest.jpg');
}else if($player->getShownImages()==111){
    $question->setImage4('img/chest.jpg');
}else if($player->getShownImages()==1011){
    $question->setImage3('img/chest.jpg');
}else if($player->getShownImages()==1101){
    $question->setImage2('img/chest.jpg');
}else{}
    
//end ControlShownImage function  
}
//end class
}




