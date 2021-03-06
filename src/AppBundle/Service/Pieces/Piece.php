<?php
namespace AppBundle\Service\Pieces;

use AppBundle\Service\Board\BoardCoordinates;
use phpDocumentor\Reflection\Types\String_;

/**
 * @name Piece
 *
 * @desc Représente une piece du jeu d'échec
 *
 * @author Luca Mayer-Dalverny
 */
abstract class Piece
{
    /**
     * @name coordinates
     * @desc Les coordonnées de la case où se trouve la pièce
     * @var BoardCoordinates
     */
    private $coordinates;
    
    /**
     * @name isWhite
     * @desc La couleur de la pièce. true, blanche / false, noire
     * @var bool
     */
    private $isWhite;
    
    /**
     * @name value
     * @desc La valeur de la pièce en points
     * @var PiecesValue
     */
    private $value;
    
    /**
     * @name htmlCode
     * @desc Le code html de la pièce
     * @var string
     */
    private $htmlCode;

    /**
     * @method construct
     * @desc Le constructeur de la classe
     * @param BoardCoordinates $coordinates
     * @param bool $isWhite
     */
    public abstract function __construct(BoardCoordinates $coordinates, bool $isWhite);
    
    /**
     * @name moveTo
     * @desc Déplace la piece
     * @param BoardCoordinates $newCoordinates
     */
    public abstract function moveTo(BoardCoordinates $newCoordinates):bool;
    
    /**
     * @method ToString
     * @desc Renvoie la chaine de caractère contenant la lettre de la pièce suivi de ses coordonnées sur le plateau
     * @return String
     */
    public abstract function toString():String;
}

