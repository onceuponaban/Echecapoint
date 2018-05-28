<?php
namespace AppBundle\Service\Movements;

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
    
    public function __construct(int $turnNumber, Move $whiteMove, Move $blackMove)
    {
        if($turnNumber > 0)
        {
            $this->turnNumber = $turnNumber;
        }
        else
        {
            $this->turnNumber = 1;
        }
        
        $this->whiteMove = $whiteMove;
        $this->blackMove = $blackMove;
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

