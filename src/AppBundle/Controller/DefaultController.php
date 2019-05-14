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

   // if he don't have enough BE to Play redirect to gameover
   // TO DO Create game Over Screen  
    if($BE<100){
        return $this->redirectToRoute('signin');
    }
    // if response is correct
    if($data->getResponse()==$question->getResponse()){
       $player->setBE($BE+1000); 
        $player->setScore($score+10);
        $em=$this->getDoctrine()->getManager();
        // player->getIdGuestion return a question object then we acces to rank and increment it
        $question=$em->getRepository(Question::class)->find($player->getIdQuestion()->getRank()+1);
        $player->setIdQuestion($question);
        $em->persist($player);
         $em->flush();
         
    // if response is incorrect     
    }else{
        $player->setBE($BE-100); 
        $em=$this->getDoctrine()->getManager();
        $em->persist($player);
         $em->flush();
    }
    /* $em=$this->getDoctrine()->getManager();
    $em->persist($l);
    $em->flush();*/
    return $this->redirectToRoute('game');
}
return $this->render('default/game.html.twig', [
    'p'=>$player,
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
   }
  return $this->redirectToRoute('game');
}


}


//end class

