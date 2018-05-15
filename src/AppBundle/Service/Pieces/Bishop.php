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
    public function getPossibleMovesCoordinates(): array
    {
        $PossibleMovesList = array();
        for($i = 0; $i < 8; $i++)
        {
            
        }
        return $PossibleMovesList;
    }
    
    public function toString(): String
    {
        return Notation::BISHOP . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::BISHOP;
    }
    
}

