<?php
namespace tests\AppBundle\Service\Movements;

use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Board\BoardCoordinates;

class MoveTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $queen = new Queen(new BoardCoordinates(3,3),true);
        
        self::assertEquals("Qd4",$queen->toString());
    }
}

