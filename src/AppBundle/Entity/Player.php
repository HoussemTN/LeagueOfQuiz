<?php
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 * @UniqueEntity("Email")
 */
class Player{ 
   /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questions")
     * @ORM\JoinColumn(name="idQuestion", referencedColumnName="id")
     
     */
     private $idQuestion ;
      /**
      * @return mixed
      */
      public function getIdQuestion()
      {
          return $this->idQuestion;
      }
 /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
     /**
     * @ORM\Column(type="string", length=255)
     */
     private $Name ;
     /**
     * @ORM\Column(type="string", length=255)
     */
     private $Username ;
     /**
     * @ORM\Column(type="string", length=255 ,unique=true)
     * @Assert\Email
     */
     private $Email ;

	/**
     * @ORM\Column(type="string", length=255)
     */
     private $Password ;
     /**
     * @ORM\Column(type="integer")
     */
     private $Score=0 ;
      /**
     * @ORM\Column(type="integer")
     */
     private $Cle=0 ;
     /**
     * @ORM\Column(type="integer")
     */
     private $BE =1000;
	
    /**
     * @return mixed
     */
     public function getId()
     {
         return $this->id;
     }
 
     /**
      * @return mixed
      */
     public function getName()
     {
         return $this->Name;
     }
 
     /**
      * @return mixed
      */
     public function getUsername()
     {
         return $this->Username;
     }
 
     /**
      * @return mixed
      */
     public function getEmail()
     {
         return $this->Email;
     }
 
     /**
      * @return mixed
      */
     public function getPassword()
     {
         return $this->Password;
     }
 
     /**
      * @return mixed
      */
     public function getScore()
     {
         return $this->Score;
     }
 
     /**
      * @return mixed
      */
     public function getCle()
     {
         return $this->Cle;
     }
 
     /**
      * @return mixed
      */
     public function getBE()
     {
         return $this->BE;
     }
 
    
 
     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->id = $id;
     }
 
     /**
      * @param mixed $Name
      */
     public function setName($Name)
     {
         $this->Name = $Name;
     }
 
     /**
      * @param mixed $Surname
      */
     public function setUsername($Username)
     {
         $this->Username= $Username;
     }
 
     /**
      * @param mixed $Email
      */
     public function setEmail($Email)
     {
         $this->Email = $Email;
     }
 
     /**
      * @param mixed $Password
      */
     public function setPassword($Password)
     {
         $this->Password = $Password;
     }
 
     /**
      * @param mixed $Score
      */
     public function setScore($Score)
     {
         $this->Score = $Score;
     }
 
     /**
      * @param mixed $Keys
      */
     public function setCle($Cle)
     {
         $this->Cle = $Cle;
     }
 
     /**
      * @param mixed $BE
      */
     public function setBE($BE)
     {
         $this->BE = $BE;
     }
 
    

}




