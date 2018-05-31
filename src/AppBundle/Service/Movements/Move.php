<?php
namespace AppBundle\Service\Movements;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Pieces\Piece;
use AppBundle\Service\Pieces\Pawn;
use AppBundle\Service\Pieces\Knight;
use AppBundle\Service\Pieces\Bishop;
use AppBundle\Service\Pieces\Rook;
use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Pieces\King;

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
     * @return \AppBundle\Service\Pieces\Piece
     */
    public function getPiece()
    {
        return $this->piece;
    }

    /**
     * @return \AppBundle\Service\Board\BoardCoordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @return boolean
     */
    public function isACapture()
    {
        return $this->isACapture;
    }

    /**
     * @name contruct
     * @desc Le constructeur de la classe
     * @param Piece $pieceToMove
     * @param BoardCoordinates $coordinatesToGo
     * @param bool $isACapture
     */
    public function __construct(Piece $pieceToMove, BoardCoordinates $coordinatesToGo, bool $isACapture)
    {
        $this->piece = $pieceToMove;
        $this->coordinates = $coordinatesToGo;
        $this->isACapture = $isACapture;
    }
    
    public function toString():String
    {
        $moveType = "";
        
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
    
    public static function fromString(string $stringMove, bool $whiteToMove):Move
    {
        
        $arrayMove = str_split($stringMove);
        
        $startCoordinates = BoardCoordinates::fromString($arrayMove[1]." ".$arrayMove[2]);
        
        $endCoordinates = BoardCoordinates::fromString($arrayMove[4]." ".$arrayMove[5]);
        
        if($arrayMove[3] == '-')
        {
            $isACapture = false;
        }
        else
        {
            $isACapture = true;
        }
        
        $move;
        
        switch ($arrayMove[0])
        {
            case Notation::PAWN:
                $move = new Move(new Pawn($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
                
            case Notation::KNIGHT:
                $move = new Move(new Knight($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
                
            case Notation::BISHOP:
                $move = new Move(new Bishop($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
                
            case Notation::ROOK:
                $move = new Move(new Rook($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
                
            case Notation::QUEEN:
                $move = new Move(new Queen($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
                
            case Notation::KING:
                $move = new Move(new King($startCoordinates, $whiteToMove), $endCoordinates, $isACapture);
                break;
        }
        
        return $move;
    }
}

