<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\DBAL\Types\JsonArrayType;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPartiesJouees", type="integer")
     */
    private $nbPartiesJouees;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPartiesGagnees", type="integer")
     */
    private $nbPartiesGagnees;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPtsTotal", type="integer")
     */
    private $nbPtsTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPtsLaisses", type="integer")
     */
    private $nbPtsLaisses;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="password",type="string")
     */
    private $password;
    
    
    /**
     * @var string
     * 
     * @ORM\Column(name="salt",type="string",length=255)
     */
    
    private $salt;
    
    /**
     * @var array
     * 
     * @ORM\Column(name="roles",type="json_array")
     * 
     */
    private $roles;

    
    /**
     * 
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Game",mappedBy="whitePlayer")
     *  
     */
    private $partiesBlanches;
    
    /**
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Game",mappedBy="blackPlayer")
     */
    private $partiesNoires;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $pseudo
     *
     * @return User
     */
    public function setUsername($pseudo)
    {
        $this->username = $pseudo;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nbPartiesJouees
     *
     * @param integer $nbPartiesJouees
     *
     * @return User
     */
    public function setNbPartiesJouees($nbPartiesJouees)
    {
        $this->nbPartiesJouees = $nbPartiesJouees;

        return $this;
    }

    /**
     * Get nbPartiesJouees
     *
     * @return int
     */
    public function getNbPartiesJouees()
    {
        return $this->nbPartiesJouees;
    }

    /**
     * Set nbPartiesGagnees
     *
     * @param integer $nbPartiesGagnees
     *
     * @return User
     */
    public function setNbPartiesGagnees($nbPartiesGagnees)
    {
        $this->nbPartiesGagnees = $nbPartiesGagnees;

        return $this;
    }

    /**
     * Get nbPartiesGagnees
     *
     * @return int
     */
    public function getNbPartiesGagnees()
    {
        return $this->nbPartiesGagnees;
    }

    /**
     * Set nbPtsTotal
     *
     * @param integer $nbPtsTotal
     *
     * @return User
     */
    public function setNbPtsTotal($nbPtsTotal)
    {
        $this->nbPtsTotal = $nbPtsTotal;

        return $this;
    }

    
    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get nbPtsTotal
     *
     * @return int
     */
    public function getNbPtsTotal()
    {
        return $this->nbPtsTotal;
    }

    /**
     * Set nbPtsLaisses
     *
     * @param integer $nbPtsLaisses
     *
     * @return User
     */
    public function setNbPtsLaisses($nbPtsLaisses)
    {
        $this->nbPtsLaisses = $nbPtsLaisses;

        return $this;
    }

    /**
     * Get nbPtsLaisses
     *
     * @return int
     */
    public function getNbPtsLaisses()
    {
        return $this->nbPtsLaisses;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->play = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
        // TODO Auto-generated method stub
        
    }
    
    /**
     * Get password
     * 
     * @return string 
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
     * 
     * 
     */
    public function getPassword()
    {
        
        return $this->password;
    }
    
    

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return $this->salt;
        
    }

    public function getRoles()
    {
        return $this->roles;
        
    }
    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    /**
     * @return \Symfony\Component\Validator\Constraints\Collection
     */
    public function getPartieBlanche()
    {
        return $this->partieBlanche;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Collection
     */
    public function getPartieNoire()
    {
        return $this->partieNoire;
    }

    /**
     * @param \Symfony\Component\Validator\Constraints\Collection $partieBlanche
     */
    public function setPartieBlanche($partieBlanche)
    {
        $this->partieBlanche = $partieBlanche;
    }

    /**
     * @param \Symfony\Component\Validator\Constraints\Collection $partieNoire
     */
    public function setPartieNoire($partieNoire)
    {
        $this->partieNoire = $partieNoire;
    }

}
