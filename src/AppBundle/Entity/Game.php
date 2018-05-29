<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="Board", type="string", length=1000)
     */
    private $board;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="partiesBlanches")
     * @ORM\JoinColumn(name="id_joueur_blanc", referencedColumnName = "id")
     */
    private $whitePlayer;
    
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="partiesNoires")
     * @ORM\JoinColumn(name="id_joueur_noir", referencedColumnName = "id")
     */
    private $blackPlayer;
    

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
     * Set board
     *
     * @param string $board
     *
     * @return Game
     */
    public function setBoard($board)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board
     *
     * @return string
     */
    public function getBoard()
    {
        return $this->board;
    }
    /**
     * @return \AppBundle\Entity\User
     */
    public function getWhitePlayer()
    {
        return $this->whitePlayer;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getBlackPlayer()
    {
        return $this->blackPlayer;
    }

    /**
     * @param \AppBundle\Entity\User $whitePlayer
     */
    public function setWhitePlayer($whitePlayer)
    {
        $this->whitePlayer = $whitePlayer;
    }

    /**
     * @param \AppBundle\Entity\User $blackPlayer
     */
    public function setBlackPlayer($blackPlayer)
    {
        $this->blackPlayer = $blackPlayer;
    }

    
    
}

