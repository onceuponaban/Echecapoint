<?php
namespace tests\AppBundle\Service\Board;

use AppBundle\Service\Board\BoardCoordinates;

class BoardCoordinatesTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Test de toString()
     */
    
    /**
     * Test de toString() sur le plateau
     */
    public function testToStringInTheBoard()
    {
        $coordinates = new BoardCoordinates(0,0);
        
        self::assertEquals("a1",$coordinates->toString());
        
        $coordinates->setFile(1);
        self::assertEquals("b1",$coordinates->toString());
        
        $coordinates->setFile(2);
        self::assertEquals("c1",$coordinates->toString());
        
        $coordinates->setFile(3);
        self::assertEquals("d1",$coordinates->toString());
        
        $coordinates->setFile(4);
        self::assertEquals("e1",$coordinates->toString());
        
        $coordinates->setFile(5);
        self::assertEquals("f1",$coordinates->toString());
        
        $coordinates->setFile(6);
        self::assertEquals("g1",$coordinates->toString());
        
        $coordinates->setFile(7);
        self::assertEquals("h1",$coordinates->toString());
        
    }
    
    /**
     * Test de toString() sous la limite inférieure
     */
    public function testToStringOffTheBoardSup()
    {
        
        $coordinates = new BoardCoordinates(-1,-1);
        
        self::assertEquals("",$coordinates->toString());
    }
    
    /**
     * Test de toString() au dessus de la limite supérieure
     */
    public function testToStringOffTheBoardInf()
    {
        
        $coordinates = new BoardCoordinates(8,8);
        
        self::assertEquals("", $coordinates->toString());
    }
    
    /**
     * Test de isOnTheBoard()
     */
    
    /**
     * Test de coordonnées dans le plateau 
     */
    public function testIsOnTheBoardTrue()
    {
        $coordinatesMin = new BoardCoordinates(0,0);
        
        self::assertTrue($coordinatesMin->isOnTheBoard(),"");
        
        $coordinatesMax = new BoardCoordinates(7,7);
        
        self::assertTrue($coordinatesMax->isOnTheBoard(),"");
        
        $randomCoordinates = new BoardCoordinates(4,6);
        
        self::assertTrue($randomCoordinates->isOnTheBoard(),"");
    }
    
    /**
     * Test de coordonnées hors du plateau
     */
    public function testIsOnTheBoardFalse()
    {
        $coordinatesMin = new BoardCoordinates(-1,1);
        
        self::assertFalse($coordinatesMin->isOnTheBoard(),"");
        
        $coordinatesMax = new BoardCoordinates(8,8);
        
        self::assertFalse($coordinatesMax->isOnTheBoard(),"");
        
        $randomCoordinates = new BoardCoordinates(-4,6);
        
        self::assertFalse($randomCoordinates->isOnTheBoard(),"");
    }
}

