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
    
    public function getPossibleMovesCoordinates(): array
    {
        $possibleMovesList = array();
        $i = $this->coordinates->getFile();
        $j = $this->coordinates->getRank();
        
        $possibleMovesList[] = new BoardCoordinates($i+1,$j);
        if(!$this->hasMoved) //si le pion n'a pas bougé, il peut avancer de deux cases
            $possibleMovesList[] = new BoardCoordinates($i+2,$j);
        
        return $possibleMovesList;
    }
    
    public function toString(): String
    {
        return Notation::PAWN . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::PAWN;
        $this->hasMoved = false;
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        return false;
    }
    
}

