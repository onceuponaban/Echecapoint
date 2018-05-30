<?php

use AppBundle\Service\Board\Board;
use AppBundle\Service\Pieces\King;
use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Pieces\Pawn;
use AppBundle\Service\Pieces\Bishop;
use AppBundle\Service\Pieces\Knight;
use AppBundle\Service\Pieces\Rook;
use AppBundle\Service\Pieces\Queen;
use AppBundle\AppBundle;
/**
 * Board test case.
 */
class BoardTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Board
     */
    private $board;
    
    
    const WHITE = 1;
    const BLACK = 0;
    
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated BoardTest::setUp()
        
        $this->board = new Board(true);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated BoardTest::tearDown()
        $this->board = null;
        
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }
    
    
    public function testConstruct()
    {
        $board = new Board(false);
        
        $pieceList = $board->getPieceList();
        
        foreach ($pieceList as &$piece)
        {   
            switch (get_class($piece))
            {
                case Rook::class:
                    
                    break;
                    
                case Knight::class:
                    
                    break;
                    
                case Bishop::class:
                    
                    break;
                    
                case Rook::class:
                    if($piece->isWhite())
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(0,0)));
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(7,0)));
                    }
                    else
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(7,7)));
                    }
                    break;
                    
                case Queen::class:
                    if($piece->isWhite())
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(3,0)));
                    }
                    else
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(3,7)));
                    }
                    break;
                    
                case King::class:
                    if($piece->isWhite())
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(4,0)));
                    }
                    else
                    {
                        self::assertTrue($piece->getCoordinates()->isEqualTo(new BoardCoordinates(4,7)));
                    }
                    break;
            }
        }
    }
    
    /**
     * Tests Board->getPossibleMovesOf()
     */
    public function testGetPossibleMovesOf()
    {
        // TODO Auto-generated BoardTest->testGetPossibleMovesOf()
        $this->markTestIncomplete("getPossibleMovesOf test not implemented");
        
        $this->board->getPossibleMovesOf(/* parameters */);
    }
    /**
     * Tests Board->getPossibleMovesOfBishop()
     */
    public function testGetPossibleMovesOfBishop()
    {
        // TODO Auto-generated BoardTest->testGetPossibleMovesOfBishop()
        $this->markTestIncomplete("getPossibleMovesOfBishop test not implemented");
        
        $this->board->getPossibleMovesOfBishop(/* parameters */);
    }
    /**
     * Tests Board->getPossibleMovesOfKnight()
     */
    public function testGetPossibleMovesOfKnight()
    {
        // TODO Auto-generated BoardTest->testGetPossibleMovesOfKnight()
        $this->markTestIncomplete("getPossibleMovesOfKnight test not implemented");
        
        $this->board->getPossibleMovesOfKnight(/* parameters */);
    }
    /**
     * Tests Board->getPossibleMovesOfRook()
     */
    public function testGetPossibleMovesOfRook()
    {
        // TODO Auto-generated BoardTest->testGetPossibleMovesOfRook()
        $this->markTestIncomplete("getPossibleMovesOfRook test not implemented");
        
        $this->board->getPossibleMovesOfRook(/* parameters */);
    }
    /**
     * Tests Board->getPossibleMovesOfQueen()
     */
    public function testGetPossibleMovesOfQueen()
    {
        // TODO Auto-generated BoardTest->testGetPossibleMovesOfQueen()
        $this->markTestIncomplete("getPossibleMovesOfQueen test not implemented");
        
        $this->board->getPossibleMovesOfQueen(/* parameters */);
    }
    /**
     * Tests Board->checkOf()
     */
    public function testCheckOf()
    {
        // TODO Auto-generated BoardTest->testCheckOf()
        /*
        
        $Board = new Board(false);
        
        $WhiteKingsCoordinates = new BoardCoordinates(4, 0);
        $BlackPawnsCoordinates = new BoardCoordinates(3, 1);
        $BlackKingsCoordinates = new BoardCoordinates(3, 6);
        $WhiteBishopsCoordinates = new BoardCoordinates(0, 4);
        
        $WhiteKing = new King($WhiteKingsCoordinates, TRUE);
        $BlackPawn = new Pawn($BlackPawnsCoordinates, FALSE);
        $BlackKing = new King($BlackKingsCoordinates, FALSE);
        $WhiteBishop = new Bishop($WhiteBishopsCoordinates, TRUE);
        
        $Board->addPiece($WhiteKing);
        $Board->addPiece($BlackKing);
        $Board->addPiece($BlackPawn);
        $Board->addPiece($WhiteBishop);
        
        self::assertEquals(true, $Board->checkOf(WHITE));
        self::assertEquals(FALSE, $Board->checkOf(BLACK));
        
        */
        
    }
    /**
     * Tests Board->checkmateOf()
     */
    public function testCheckmateOf()
    {
        // TODO Auto-generated BoardTest->testCheckmateOf()
        $this->markTestIncomplete("checkmateOf test not implemented");
        
        $this->board->checkmateOf(/* parameters */);
    }
    /**
     * Tests Board->stalemateOf()
     */
    public function testStalemateOf()
    {
        // TODO Auto-generated BoardTest->testStalemateOf()
        $this->markTestIncomplete("stalemateOf test not implemented");
        
        $this->board->stalemateOf(/* parameters */);
    }
    /**
     * Tests Board->updateFromString()
     */
    public function testUpdateFromString()
    {
        // TODO Auto-generated BoardTest->testUpdateFromString()
        $this->markTestIncomplete("updateFromString test not implemented");
        
        $this->board->updateFromString(/* parameters */);
    }
    /**
     * Tests Board->updateFromMove()
     */
    public function testUpdateFromMove()
    {
        // TODO Auto-generated BoardTest->testUpdateFromMove()
        $this->markTestIncomplete("updateFromMove test not implemented");
        
        $this->board->updateFromMove(/* parameters */);
    }
    /**
     * Tests Board->isFilled()
     */
    public function testIsFilled()
    {
        // TODO Auto-generated BoardTest->testIsFilled()
        $this->markTestIncomplete("isFilled test not implemented");
        
        $this->board->isFilled(/* parameters */);
    }
    /**
     * Tests Board->pieceAt()
     */
    public function testPieceAt()
    {
        // TODO Auto-generated BoardTest->testPieceAt()
        $this->markTestIncomplete("pieceAt test not implemented");
        
        $this->board->pieceAt(/* parameters */);
    }
}