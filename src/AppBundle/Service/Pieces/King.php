<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name King
 *
 * @desc Représente un roi sur un plateau d'échecs
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class King extends Piece
{
    private $hasMoved;

    public function hasMoved()
    {
        return $this->hasMoved;
    }

    public function toString(): String
    {
        return Notation::KING . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = new BoardCoordinates($coordinates->getFile(), $coordinates->getRank());
        $this->isWhite = $isWhite;
        $this->value = 0; //le roi ne peut pas être pris, il n'a donc pas de valeur!
        $this->hasMoved = false;
        
        if($this->isWhite())
        {
            $this->htmlCode = "9812";
        }
        else
        {
            $this->htmlCode = "9818";
        }
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        if($newCoordinates->isOnTheBoard())
        {
            $this->coordinates = new BoardCoordinates($newCoordinates->getFile(), $newCoordinates->getRank());
            if(!$this->hasMoved)
                $this->hasMoved = true;
            return true;
        }
        return false;
    }
    
    /**
     * @return \AppBundle\Service\Board\BoardCoordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    
    /**
     * @return boolean
     */
    public function isWhite()
    {
        return $this->isWhite;
    }
    
    /**
     * @return \AppBundle\Service\Pieces\PiecesValue
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @return string
     */
    public function getHtmlCode()
    {
        return $this->htmlCode;
    }
    
}

