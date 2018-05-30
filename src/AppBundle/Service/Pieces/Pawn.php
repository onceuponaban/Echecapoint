<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name Pawn
 *
 * @desc Représente un pion sur un plateau d'échecs
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class Pawn extends Piece
{
    private $hasMoved;
    
    private $enPassantCapturePossible;
    
    /**
     * @return boolean
     */
    public function hasMoved()
    {
        return $this->hasMoved;
    }
    
    public function toString(): String
    {
        return Notation::PAWN . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = new BoardCoordinates($coordinates->getFile(), $coordinates->getRank());
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::PAWN;
        $this->hasMoved = false;
        $this->enPassantCapturePossible = false;
        
        if($this->isWhite())
        {
            $this->htmlCode = "9817";
        }
        else
        {
            $this->htmlCode = "9823";
        }
        
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        if($newCoordinates->isOnTheBoard())
        {
            $this->coordinates = new BoardCoordinates($newCoordinates->getFile(), $newCoordinates->getRank());
            if(!$this->hasMoved)
                $this->hasMoved = true;
            if(abs($newCoordinates->getRank()-$this->getCoordinates()->getRank()) == 2)
                $this->enPassantCapturePossible = true;
                else $this->enPassantCapturePossible = false;
            return true;
        }
        return false;
    }
    /**
     * @return boolean
     */
    public function enPassantCapturePossible()
    {
        return $this->enPassantCapturePossible;
    }

    
}

