<?php
namespace tests\AppBundle\Service\Movements;

use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Move;

class MoveTest extends \PHPUnit_Framework_TestCase
{
    public function testToStringMove()
    {
        $move = new Move(new Queen(new BoardCoordinates(3,3),true),new BoardCoordinates(4,4), false);
        
        self::assertEquals("Qd4-e5",$move->toString());
    }
    
    public function testToStringCapture()
    {
        $move = new Move(new Queen(new BoardCoordinates(3,3),true),new BoardCoordinates(4,4), true);
        
        self::assertEquals("Qd4xe5",$move->toString());
    }
    
    public static function fromString(string $stringMove):Move
    {
        return null;
    }
}

