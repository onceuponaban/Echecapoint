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
        $possibleMovesList = array();
        $i = $this->coordinates->getFile();
        $j = $this->coordinates->getRank();
        for($k = 1; $k<6;$k++) //parcours des diagonales avec vérification des coordonnées
        {
            $moveCandidate0 = new BoardCoordinates($i+$k, $j+$k);
            if($moveCandidate0->isOnTheBoard())
                $possibleMovesList[] = $moveCandidate0;
            
            $moveCandidate1 = new BoardCoordinates($i+$k, $j-$k);
            if($moveCandidate1->isOnTheBoard())
                $possibleMovesList[] = $moveCandidate1;
            
            $moveCandidate2 = new BoardCoordinates($i-$k, $j+$k);
            if($moveCandidate2->isOnTheBoard())
                $possibleMovesList[] = $moveCandidate2;
            
            $moveCandidate3 = new BoardCoordinates($i-$k, $j-$k);
            if($moveCandidate3->isOnTheBoard())
                $possibleMovesList[] = $moveCandidate3;
        }
        return $possibleMovesList;
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

