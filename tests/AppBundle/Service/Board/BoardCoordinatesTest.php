<?php
namespace tests\AppBundle\Service\Board;

use AppBundle\Service\Board\BoardCoordinates;

class BoardCoordinatesTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $coordinates = new BoardCoordinates(5,5);
        
        self::assertEquals("f4",$coordinates->toString());
    }
}

