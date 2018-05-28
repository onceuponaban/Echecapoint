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
    
    public function toString():string
    {
        return "";
    }
}

