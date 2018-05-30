<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name Bishop
 *
 * @desc Représente un fou sur un plateau d'échec
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class Bishop extends Piece
{
    public function toString(): String
    {
        return Notation::BISHOP . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = new BoardCoordinates($coordinates->getFile(), $coordinates->getRank());
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::BISHOP;
        
        if($this->isWhite())
        {
            $this->htmlCode = "9815";
        }
        else
        {
            $this->htmlCode = "9821";
        }
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        if($newCoordinates->isOnTheBoard())
        {
            $this->coordinates = new BoardCoordinates($newCoordinates->getFile(), $newCoordinates->getRank());
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

