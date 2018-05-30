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
        return $this->turnNumber." ".$this->whiteMove->toString()." ".$this->blackMove->toString();
    }
    
    public static function fromString(string $stringTurn):Turn
    {
        
        echo "\nListe de Tour : ".$stringTurn."\n";
        
        $arrayMove = explode(" ", $stringTurn);
        
        
        echo "Array de Move : ";
        foreach ($arrayMove as $move)
        {
            echo $move."_&_";
        }
        echo "\n";
        
        $turnNumber = intval($arrayMove[0]);
        
        $whiteMove = Move::fromString($arrayMove[1],true);
        
        if(count($arrayMove) > 2)
        {
            $blackMove = Move::fromString($arrayMove[2],false);
        }
        else
        {
            $blackMove == null;
        }
        
        return new Turn($turnNumber, $whiteMove, $blackMove);
    }
    
    public function isEqualTo(Turn $otherTurn):bool
    {
        $postulate = false;
        
        if(($this->whiteMove == $otherTurn->getWhiteMove())&&($this->blackMove == $otherTurn->getBlackMove()))
        {
            $postulate = true;
        }
        
        return $postulate;
    }
    
    /**
     * @return number
     */
    public function getTurnNumber()
    {
        return $this->turnNumber;
    }

    /**
     * @return \AppBundle\Service\Movements\Move
     */
    public function getWhiteMove()
    {
        return $this->whiteMove;
    }

    /**
     * @return \AppBundle\Service\Movements\Move
     */
    public function getBlackMove()
    {
        return $this->blackMove;
    }
}

