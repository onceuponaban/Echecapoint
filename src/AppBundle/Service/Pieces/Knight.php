<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Notation;

/**
 * @name Knight
 *
 * @desc Représente un cavalier sur un plateau d'échecs
 *
 * @author Luca Mayer-Dalverny & Antoine Berenguer
 */

class Knight extends Piece
{
    public function getPossibleMovesCoordinates(): array
    {
        $untestedMovesList = array();
        $possibleMovesList = array();
        $i = $this->coordinates->getFile();
        $j = $this->coordinates->getRank();
        //On ajoute chaque possibilité pour le mouvement sans prendre en compte la position de la pièce sur le tableau
        $untestedMovesList[] = new BoardCoordinates($i+2, $j+1);
        $untestedMovesList[] = new BoardCoordinates($i+2, $j-1);
        $untestedMovesList[] = new BoardCoordinates($i-2, $j+1);
        $untestedMovesList[] = new BoardCoordinates($i-2, $j-1);
        $untestedMovesList[] = new BoardCoordinates($i+1, $j+2);
        $untestedMovesList[] = new BoardCoordinates($i+1, $j-2);
        $untestedMovesList[] = new BoardCoordinates($i-1, $j+2);
        $untestedMovesList[] = new BoardCoordinates($i-1, $j-2);
        //On vérifie si les coordonnées sont sur le plateau, et si oui on les rajoute au tableau de retour
        foreach ($untestedMovesList as $move)
        {
            if($move->isOnTheBoard())
                $possibleMovesList[] = $move;
        }
        return $possibleMovesList;
    }
    
    public function toString(): String
    {
        return Notation::KNIGHT . $this->coordinates->toString();
    }
    
    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::KNIGHT;
    }
    
}

