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
    public function getPossibleMovesCoordinates(): array
    {
        $possibleMovesList = array();
        $i = $this->coordinates->getFile();
        $j = $this->coordinates->getRank();
        
        for($k=$i-1;$k<=$i+1;$k++) //On vérifie chaque case dans une grille 3x3 centrée sur la pièce
        {
            for($l=$j-1;$l<=$j+1;$l++)
            {
                $moveCandidate = new BoardCoordinates($k, $l);
                if(($k != $i && $l != $j)&&($moveCandidate->isOnTheBoard())) //si les coordonnées sont valides et ne sont pas la pièce elle même
                {
                    $possibleMovesList = $moveCandidate;
                }
            }
        }
        
        return $possibleMovesList;
    }
    
    public function toString(): String
    {
        return Notation::KING . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = 0; //le roi ne peut pas être pris, il n'a donc pas de valeur!
    }
    
    public function moveTo(BoardCoordinates $newCoordinates): bool
    {
        return false;
    }
    
}

