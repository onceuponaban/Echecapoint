<?php
namespace tests\AppBundle\Service\Board;

use AppBundle\Service\Board\Board;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $board = new Board();
        
        $pieceList = $board->getPieces();
        
        foreach ($pieceList as $piece)
        {
            self::assertTrue(false);
        }
    }
    
}

