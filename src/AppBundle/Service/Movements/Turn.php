<?php
namespace Service\Movements;

use AppBundle\Service\Movements\Move;

/**
 * @name Turn
 * 
 * @desc Représete un tour de jeu aux échecs
 * 
 * @author Luca Mayer-Dalverny
 */
class Turn
{
    /**
     * @name turnNumber
     * @desc Numéro du tour
     * @var integer
     */
    private $turnNumber;
    
    /**
     * @name whiteMove
     * @desc Déplacement des blancs
     * @var Move
     */
    private $whiteMove;
    
    /**
     * @name blackMove
     * @desc Déplacement des noirs
     * @var Move
     */
    private $blackMove;
    
    public function __construct()
    {
        
    }
    
    /**
     * @name toString
     * @desc Renvoie la chaine de caractère associé à un tour de jeu
     * @return string
     */
    public function toString():string
    {
        return $this->turnNumber.". ".$this->whiteMove->toString()." ".$this->blackMove->toString()." ";
    }
}
