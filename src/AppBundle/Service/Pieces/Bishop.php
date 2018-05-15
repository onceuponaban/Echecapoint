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
        $i = $this->coordinates->getFile();
        $j = $this->coordinates->getRank();
        for($k = 1; $k<6;$k++) //parcours des diagonales avec vérification des coordonnées
        {
            $MoveCandidate0 = new BoardCoordinates($i+$k, $j+$k);
            if($MoveCandidate0->isOnTheBoard())
                $PossibleMovesList[] = $MoveCandidate0;
            
            $MoveCandidate1 = new BoardCoordinates($i+$k, $j-$k);
            if($MoveCandidate1->isOnTheBoard())
                $PossibleMovesList[] = $MoveCandidate1;
            
            $MoveCandidate2 = new BoardCoordinates($i-$k, $j+$k);
            if($MoveCandidate2->isOnTheBoard())
                $PossibleMovesList[] = $MoveCandidate2;
            
            $MoveCandidate3 = new BoardCoordinates($i-$k, $j-$k);
            if($MoveCandidate3->isOnTheBoard())
                $PossibleMovesList[] = $MoveCandidate3;
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

