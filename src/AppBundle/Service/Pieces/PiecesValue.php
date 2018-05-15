<?php
namespace Service\Pieces;

/**
 * @name PiecesValue
 *
 * @desc D�finie les valeurs des pi�ces et des coups lors d'une partie d'�checs � points
 *
 * @author Luca Mayer-Dalverny
 */
abstract class PiecesValue
{
    /**
     * @name PAWN
     * @desc La valeur du pion
     * @var integer
     */
    const PAWN = 1;
    
    /**
     * @name CHECK
     * @desc La valeur d'une mise en �chec du roi adverse
     * @var integer
     */
    const CHECK = 2;
    
    /**
     * @name KNIGHT
     * @desc La valeur d'un cavalier
     * @var integer
     */
    const KNIGHT = 3;
    
    /**
     * @name BISHOP
     * @name La valeur d'un fou
     * @var integer
     */
    const BISHOP = 3;
    
    /**
     * @name ROOK
     * @desc la valeur d'une tour
     * @var integer
     */
    const ROOK = 5;
    
    /**
     * @name QUEEN
     * @desc La valeur de la reine
     * @var integer
     */
    const QUEEN = 9;
    
    /**
     * @name MATE
     * @desc La valeur de la mise en �chec et mat du roi adverse
     * @var integer
     */
    const MATE = 20;
}

