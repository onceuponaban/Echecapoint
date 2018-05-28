<?php
namespace tests\AppBundle\Service\Board;

use AppBundle\Service\Board\BoardCoordinates;
use Service\Board\Board;

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
        $coordinates = new BoardCoordinates(5,5);
        
        self::assertEquals("f4",$coordinates->toString());
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
        
        self::assertTrue($coordinatesMin->isOnTheBoard(),"");
        
        $coordinatesMax = new BoardCoordinates(8,8);
        
        self::assertTrue($coordinatesMax->isOnTheBoard(),"");
        
        $randomCoordinates = new BoardCoordinates(-4,6);
        
        self::assertTrue($randomCoordinates->isOnTheBoard(),"");
    }
}

