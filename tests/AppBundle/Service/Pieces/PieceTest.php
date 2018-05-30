<?php
namespace tests\AppBundle\Service\Pieces;

use AppBundle\Service\Pieces\Pawn;
use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Pieces\Knight;
use AppBundle\Service\Pieces\Bishop;
use AppBundle\Service\Pieces\Rook;
use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Pieces\King;

class PieceTest extends \PHPUnit_Framework_TestCase
{
    
    public function testCoordinatesWhitePawn()
    {
        
        $coordinates = new BoardCoordinates(0,1);
        
        $piece = new Pawn($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackPawn()
    {
        
        $coordinates = new BoardCoordinates(0,6);
        
        $piece = new Pawn($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testCoordinatesWhiteKnight()
    {
        
        $coordinates = new BoardCoordinates(1,0);
        
        $piece = new Knight($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackKnight()
    {
        
        $coordinates = new BoardCoordinates(1,7);
        
        $piece = new Knight($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testCoordinatesWhiteBishop()
    {
        
        $coordinates = new BoardCoordinates(2,0);
        
        $piece = new Bishop($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackBishop()
    {
        
        $coordinates = new BoardCoordinates(2,7);
        
        $piece = new Bishop($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testCoordinatesWhiteRook()
    {
        
        $coordinates = new BoardCoordinates(0,0);
        
        $piece = new Rook($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackRook()
    {
        
        $coordinates = new BoardCoordinates(0,7);
        
        $piece = new Rook($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testCoordinatesWhiteQueen()
    {
        
        $coordinates = new BoardCoordinates(3,0);
        
        $piece = new Queen($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackQueen()
    {
        
        $coordinates = new BoardCoordinates(3,7);
        
        $piece = new Queen($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testCoordinatesWhiteKing()
    {
        
        $coordinates = new BoardCoordinates(4,0);
        
        $piece = new King($coordinates, true);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
    public function testGetCoordinatesBlackKing()
    {
        
        $coordinates = new BoardCoordinates(4,7);
        
        $piece = new King($coordinates, false);
        
        self::assertTrue($coordinates->isEqualTo($piece->getCoordinates()));
        
    }
    
}

