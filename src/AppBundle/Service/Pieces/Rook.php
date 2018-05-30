<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name Rook
 *
 * @desc Représente une tour sur un plateau d'échec
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class Rook extends Piece
{
    private $hasMoved;
    
    /**
     * @return boolean
     */
    public function hasMoved()
    {
        return $this->hasMoved;
    }

    public function toString(): String
    {
        return Notation::ROOK . $this->coordinates->toString();
    }

    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = new BoardCoordinates($coordinates->getFile(), $coordinates->getRank());
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::ROOK;
        $this->hasMoved = false;
        
        if($this->isWhite())
        {
            $this->htmlCode = "9814";
        }
        else
        {
            $this->htmlCode = "9820";
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

