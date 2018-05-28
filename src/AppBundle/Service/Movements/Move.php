<?php
namespace AppBundle\Service\Movements;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Pieces\Piece;

/**
 * @name Move
 *
 * @desc Représente un déplacement aux échecs
 *
 * @author Luca Mayer-Dalverny
 */
class Move
{
    /**
     * @name piece
     * @desc La piece qui se déplace
     * @var Piece
     */
    private $piece;
    
    /**
     * @name coordinates
     * @desc Les coordonnées où l'on veut déplacer la pièce
     * @var BoardCoordinates
     */
    private $coordinates;
    
    /**
     * @name isACapture
     * @desc Si le coup est une capture ou non
     * @var boolean : true, capture | false, pas de capture
     */
    private $isACapture;
    
    /**
     * @name contruct
     * @desc Le constructeur de la classe
     * @param Piece $pieceToMove
     * @param BoardCoordinates $coordinatesToGo
     * @param bool $isACapture
     */
    public function __construct(Piece $pieceToMove, BoardCoordinates $coordinatesToGo, bool $isACapture)
    {
        
    }
    
    function toString():String
    {
        $moveType;
        if($this->isACapture)
        {
            $moveType = Notation::CAPTURE;
        }
        else
        {
            $moveType = Notation::MOVE;
        }
        
        //Ajouter ici le cas de la promotion
        
        return $this->piece->toString().$moveType.$this->coordinates->toString();
    }
}

