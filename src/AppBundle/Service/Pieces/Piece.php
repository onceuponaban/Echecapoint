<?php
namespace Service\Pieces;

use Service\Board\BoardCoordinates;

/**
 * @name Piece
 *
 * @desc Repr�sente une piece du jeu d'�chec
 *
 * @author Luca Mayer-Dalverny
 */
abstract class Piece
{
    /**
     * @name coordinates
     * @desc Les coordonn�es de la case o� se trouve la pi�ce
     * @var BoardCoordinates
     */
    private $coordinates;
    
    /**
     * @name isWhite
     * @desc La couleur de la pi�ce. true, blanche / false, noire
     * @var bool
     */
    private $isWhite;
    
    /**
     * @name value
     * @desc La valeur de la pi�ce en points
     * @var PiecesValue
     */
    private $value;
    
    /**
     * @method construct
     * @desc Le constructeur de la classe
     * @param BoardCoordinates $coordinates
     * @param bool $isWhite
     */
    public abstract function __construct(BoardCoordinates $coordinates, bool $isWhite);
    
    /**
     * @method getPossibleMovesCoordinates
     * @desc Renvoie les coordonn�es des cases o� la pi�ce peut se d�placer, sans tenir compte des autres pi�ces de l'�chiquier
     * @return array : Un tableau de BoardCoordinates
     */
    public abstract function getPossibleMovesCoordinates():array;
    
    /**
     * @method ToString
     * @desc Renvoie la chaine de caract�re contenant la lettre de la pi�ce suivi de ses coordonn�es sur le plateau
     * @return String
     */
    public abstract function toString():String;
}

