<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name Queen
 *
 * @desc Représente une reine sur un plateau d'échecs
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class Queen extends Piece
{
    public function getPossibleMovesCoordinates(): array
    {
        $possibleMovesList = array();
        $a = $this->coordinates->getFile();
        $b = $this->coordinates->getRank();
        for($i = 1; $i < 8; $i++) //Parcours dans 8 directions sur 7 cases
        {
            for($j = -1; $j < 2; $j++)
            {
                for($k = -1; $k < 2; $k++)
                {
                    $moveCandidate = new BoardCoordinates($a+$i*$j,$b+$i*$k);
                    //on vérifie si les coordonnées ne correspondent pas à la même pièce et si elles sont valides
                    if($moveCandidate->onTheBoard() && !($moveCandidate->getFile() == $a && $moveCandidate->getRank()== $b))
                        $possibleMovesList[] = $moveCandidate;
                }
            }
        }
        return $possibleMovesList;
    }
    
    public function toString(): String
    {
        return Notation::QUEEN . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::QUEEN;
        
        if($this->isWhite())
        {
            $this->htmlCode = "9813";
        }
        else
        {
            $this->htmlCode = "9819";
        }
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        if($newCoordinates->isOnTheBoard())
        {
            $this->coordinates = $newCoordinates;
            return true;
        }
        return false;
    }
    
}

