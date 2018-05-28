<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Play
 *
 * @ORM\Table(name="play")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayRepository")
 */
class Play
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
     * @var int
     *
     * @ORM\Column(name="couleur", type="integer")
     */
    private $couleur;
    
    
    /**
     * 
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="play")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     */
    
    private $user;
    
    
    /**
     * 
     * @var Partie
     * 
     * @ORM\ManyToOne(targetEntity="Partie", inversedBy="play")
     * @ORM\JoinColumn(name="partie_id",referencedColumnName="id")
     * 
     */

    private $partie;
    
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
     * Set couleur
     *
     * @param integer $couleur
     *
     * @return Play
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return int
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Play
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set partie
     *
     * @param \AppBundle\Entity\Partie $partie
     *
     * @return Play
     */
    public function setPartie(\AppBundle\Entity\Partie $partie = null)
    {
        $this->partie = $partie;

        return $this;
    }

    /**
     * Get partie
     *
     * @return \AppBundle\Entity\Partie
     */
    public function getPartie()
    {
        return $this->partie;
    }
}
