<?php
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="question")
  * @UniqueEntity("Rank")
 */
 class Question{ 

 /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="idQuestion")
     */
     
       /**
           * @ORM\Column(type="integer",unique=true )
        */
        private $Rank=0 ;
 
    /**
         * @ORM\Id
         * @ORM\GeneratedValue
         * @ORM\Column(type="integer")
         */
        private $id;
         /**
         * @ORM\Column(type="string", length=255)
         */
         private $Response ;
          /**
         * @ORM\Column(type="integer")
         */
         private $Reward ;
         /**
         * @ORM\Column(type="string", length=255)
         */
         private $Image1 ;
         /**
         * @ORM\Column(type="string", length=255)
         */
         private $Image2 ;
         /**
         * @ORM\Column(type="string", length=255)
         */
         private $Image3 ;
         /**
         * @ORM\Column(type="string", length=255)
         */
         private $Image4 ;
          /**
         * @ORM\Column(type="string", length=255)
         */
         private $Hint ;
      /**
      * @return mixed
      */
      public function getRank()
      {
          return $this->Rank;
      }
        /**
      * @return mixed
      */
      public function getHint()
      {
          return $this->Hint;
      }
       /**
      * @param mixed $Rank
      */
     public function setRank($Rank)
     {
         $this->Rank = $Rank;
     }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }
       
    
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
    
        /**
         * @return mixed
         */
        public function getResponse()
        {
            return $this->Response;
        }
    
        /**
         * @param mixed $Response
         */
        public function setResponse($Response)
        {
            $this->Response = $Response;
        }
    
        /**
         * @return mixed
         */
        public function getReward()
        {
            return $this->Reward;
        }
    
        /**
         * @param mixed $Reward
         */
        public function setReward($Reward)
        {
            $this->Reward = $Reward;
        }
    
        /**
         * @return mixed
         */
        public function getImage1()
        {
            return $this->Image1;
        }
    
        /**
         * @param mixed $Image1
         */
        public function setImage1($Image1)
        {
            $this->Image1 = $Image1;
        }
    
        /**
         * @return mixed
         */
        public function getImage2()
        {
            return $this->Image2;
        }
    
        /**
         * @param mixed $Image2
         */
        public function setImage2($Image2)
        {
            $this->Image2 = $Image2;
        }
    
        /**
         * @return mixed
         */
        public function getImage3()
        {
            return $this->Image3;
        }
    
        /**
         * @param mixed $Image3
         */
        public function setImage3($Image3)
        {
            $this->Image3 = $Image3;
        }
    
        /**
         * @return mixed
         */
        public function getImage4()
        {
            return $this->Image4;
        }
    
        /**
         * @param mixed $Image4
         */
        public function setImage4($Image4)
        {
            $this->Image4 = $Image4;
        }
          /**
         * @param mixed $Hint
         */
         public function setHint($Hint)
         {
             $this->Hint = $Hint;
         }
        
      
    
    }