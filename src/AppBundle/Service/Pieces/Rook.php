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
    public function getPossibleMovesCoordinates(): array
    {
        $possibleMovesList = array();
        for($i = 0; $i < 8; $i++)
        {
            if(!($i == $this->coordinates->getFile())) //Pour toutes les colonnes autre que celle de la pièce elle même
                $possibleMovesList[] = new BoardCoordinates($i, $this->coordinates->getRank()); //On rajoute une coordonnée sur la même ligne
            if(!($i == $this->coordinates->getRank())) //Pour toutes les lignes autre que celle de la pièce elle même
                $possibleMovesList[] = new BoardCoordinates($this->coordinates->getFile(), $i); //On rajoute une coordonnée sur la même colonne
                
        }
        return $possibleMovesList;
    }

    public function toString(): String
    {
        return Notation::ROOK . $this->coordinates->toString();
    }

    public function __construct(BoardCoordinates $coordinates, bool $isWhite)
    {
        $this->coordinates = $coordinates;
        $this->isWhite = $isWhite;
        $this->value = PiecesValue::ROOK;
    }

}

