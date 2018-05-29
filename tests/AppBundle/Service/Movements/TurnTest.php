<?php
namespace tests\AppBundle\Service\Movements;

use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Move;
use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Pieces\Rook;
use AppBundle\Service\Movements\Turn;

class TurnTest extends \PHPUnit_Framework_TestCase
{
    public function testToStringOK()
    {
        $whiteMove = new Move(new Queen(new BoardCoordinates(3,3),true),new BoardCoordinates(4,4), false);
        
        $blackMove = new Move(new Rook(new BoardCoordinates(6,7), false),new BoardCoordinates(0,7),true);
        
        $turn = new Turn(1, $whiteMove, $blackMove);
        
        self::assertEquals("1 Qd4-e5 Rg8xa8;",$turn->toString());
    }
    
    public function testToStringWrongNumber()
    {
        $whiteMove = new Move(new Queen(new BoardCoordinates(3,3),true),new BoardCoordinates(4,4), false);
        
        $blackMove = new Move(new Rook(new BoardCoordinates(6,7), false),new BoardCoordinates(0,7),true);
        
        $turn = new Turn(-1, $whiteMove, $blackMove);
        
        self::assertEquals("1 Qd4-e5 Rg8xa8;",$turn->toString());
    }
}

