<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartieRepository")
 */
class Partie
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
     * @ORM\Column(name="Plateau", type="string", length=255)
     */
    private $plateau;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTour", type="integer")
     */
    private $nbTour;

    /**
     * @var bool
     *
     * @ORM\Column(name="TourReineN", type="boolean")
     */
    private $tourReineN;

    /**
     * @var bool
     *
     * @ORM\Column(name="TourReineB", type="boolean")
     */
    private $tourReineB;

    /**
     * @var bool
     *
     * @ORM\Column(name="TourRoiN", type="boolean")
     */
    private $tourRoiN;

    /**
     * @var bool
     *
     * @ORM\Column(name="TourRoiB", type="boolean")
     */
    private $tourRoiB;

    /**
     * @var string
     *
     * @ORM\Column(name="PrisePassant", type="string", length=255, nullable=true)
     */
    private $prisePassant;

    /**
     * @var bool
     *
     * @ORM\Column(name="RoqueOk", type="boolean")
     */
    private $roqueOk;
    
    /**
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Play",mappedBy="partie")
     * 
     */
    private $play;


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
     * Set plateau
     *
     * @param string $plateau
     *
     * @return Partie
     */
    public function setPlateau($plateau)
    {
        $this->plateau = $plateau;

        return $this;
    }

    /**
     * Get plateau
     *
     * @return string
     */
    public function getPlateau()
    {
        return $this->plateau;
    }

    /**
     * Set nbTour
     *
     * @param integer $nbTour
     *
     * @return Partie
     */
    public function setNbTour($nbTour)
    {
        $this->nbTour = $nbTour;

        return $this;
    }

    /**
     * Get nbTour
     *
     * @return int
     */
    public function getNbTour()
    {
        return $this->nbTour;
    }

    /**
     * Set tourReineN
     *
     * @param boolean $tourReineN
     *
     * @return Partie
     */
    public function setTourReineN($tourReineN)
    {
        $this->tourReineN = $tourReineN;

        return $this;
    }

    /**
     * Get tourReineN
     *
     * @return bool
     */
    public function getTourReineN()
    {
        return $this->tourReineN;
    }

    /**
     * Set tourReineB
     *
     * @param boolean $tourReineB
     *
     * @return Partie
     */
    public function setTourReineB($tourReineB)
    {
        $this->tourReineB = $tourReineB;

        return $this;
    }

    /**
     * Get tourReineB
     *
     * @return bool
     */
    public function getTourReineB()
    {
        return $this->tourReineB;
    }

    /**
     * Set tourRoiN
     *
     * @param boolean $tourRoiN
     *
     * @return Partie
     */
    public function setTourRoiN($tourRoiN)
    {
        $this->tourRoiN = $tourRoiN;

        return $this;
    }

    /**
     * Get tourRoiN
     *
     * @return bool
     */
    public function getTourRoiN()
    {
        return $this->tourRoiN;
    }

    /**
     * Set tourRoiB
     *
     * @param boolean $tourRoiB
     *
     * @return Partie
     */
    public function setTourRoiB($tourRoiB)
    {
        $this->tourRoiB = $tourRoiB;

        return $this;
    }

    /**
     * Get tourRoiB
     *
     * @return bool
     */
    public function getTourRoiB()
    {
        return $this->tourRoiB;
    }

    /**
     * Set prisePassant
     *
     * @param string $prisePassant
     *
     * @return Partie
     */
    public function setPrisePassant($prisePassant)
    {
        $this->prisePassant = $prisePassant;

        return $this;
    }

    /**
     * Get prisePassant
     *
     * @return string
     */
    public function getPrisePassant()
    {
        return $this->prisePassant;
    }

    /**
     * Set roqueOk
     *
     * @param boolean $roqueOk
     *
     * @return Partie
     */
    public function setRoqueOk($roqueOk)
    {
        $this->roqueOk = $roqueOk;

        return $this;
    }

    /**
     * Get roqueOk
     *
     * @return bool
     */
    public function getRoqueOk()
    {
        return $this->roqueOk;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->play = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add play
     *
     * @param \AppBundle\Entity\Play $play
     *
     * @return Partie
     */
    public function addPlay(\AppBundle\Entity\Play $play)
    {
        $this->play[] = $play;

        return $this;
    }

    /**
     * Remove play
     *
     * @param \AppBundle\Entity\Play $play
     */
    public function removePlay(\AppBundle\Entity\Play $play)
    {
        $this->play->removeElement($play);
    }

    /**
     * Get play
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlay()
    {
        return $this->play;
    }
}
