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
        //$this->markTestIncomplete("getPossibleMovesOfKnight test not implemented");
        $knight = new Knight(new BoardCoordinates(1,0), true);
        $board = new Board(true);
        $board->addPiece($knight);
        $moveCheck = array(
            new BoardCoordinates(3, 1),
            new BoardCoordinates(2, 2),
            new BoardCoordinates(0, 2)
        );
        self::assertTrue($board->equalCoords($moveCheck, $board->getPossibleMovesOfKnight($knight)));
        $pawn = new Pawn(new BoardCoordinates(3,1), true);
        $board->addPiece($pawn);
        self::assertFalse($board->equalCoords($moveCheck, $board->getPossibleMovesOfKnight($knight)));
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
        
        //On crée un plateau
        $Board = new Board(TRUE);
        
        //On crée les coordonnées de 4 pièces
        //Roi Blanc
        $WhiteKingsCoordinates = new BoardCoordinates(4, 0);
        //Pion noir
        $BlackPawnsCoordinates = new BoardCoordinates(3, 1);
        //Roi Noir
        $BlackKingsCoordinates = new BoardCoordinates(3, 6);
        //Fou Blanc
        $WhiteBishopsCoordinates = new BoardCoordinates(0, 4);
        
        //On crée les pièces
        //Roi blanc
        $WhiteKing = new King($WhiteKingsCoordinates, TRUE);
        //Pion noir
        $BlackPawn = new Pawn($BlackPawnsCoordinates, FALSE);
        //Roi noir
        $BlackKing = new King($BlackKingsCoordinates, FALSE);
        //Fou blanc
        $WhiteBishop = new Bishop($WhiteBishopsCoordinates, TRUE);
        
        //On ajoute les pièce au plateau
        $Board->addPiece($WhiteKing);
        $Board->addPiece($BlackKing);
        $Board->addPiece($BlackPawn);
        $Board->addPiece($WhiteBishop);
        
        //Le pion noir met le roi blanc en echec
        self::assertEquals(true, $Board->checkOf(WHITE));
        //Le fou blanc ne met pas le roi noir en echec
        self::assertEquals(FALSE, $Board->checkOf(BLACK));
        
        
        
    }
    /**
     * Tests Board->checkmateOf()
     */
    public function testCheckmateOf()
    {
        // TODO Auto-generated BoardTest->testCheckmateOf()
        $this->markTestIncomplete("checkmateOf test not implemented");
        
        //On crée un plateau
        $board = new Board(TRUE);
        
        //On crée les coordonnées des pièces pour tester 
        $BlackKingsCoordinates = new BoardCoordinates(3, 7);
        $WhiteKingCoordinates = new BoardCoordinates(3 , 5);
        $WhiteRookCoordinates = new BoardCoordinates(7, 7);
        
        //On crée les pièces
        $BlackKing = new King($BlackKingsCoordinates, FALSE);
        $WhiteKing = new King($WhiteKingCoordinates, TRUE);
        $WhiteRook = new Rook($WhiteRookCoordinates, TRUE);
        
        //On ajoute les pièces au plateau
        $board->addPiece($BlackKing);
        $board->addPiece($WhiteKing);
        $board->addPiece($WhiteRook);
        
        //Cas echec et mat
        //On teste si on trouve bien le roi noir echec et mat
        self::assertEquals(TRUE, $board->checkmateOf(0));
        
        //Cas ni mat ni echec
        //On teste si on trouve bien que le roi blanc n'est pas echec et mat
        self::assertEquals(FALSE, $board->checkmateOf(1));
        
        $board2 = new Board(true);
        
        //On crée les coordonnées de 4 pièces
        //Roi Blanc
        $WhiteKingsCoordinates = new BoardCoordinates(4, 0);
        //Pion noir
        $BlackPawnsCoordinates = new BoardCoordinates(3, 1);
        //Roi Noir
        $BlackKingsCoordinates = new BoardCoordinates(3, 6);
       
        
        //On crée les pièces
        //Roi blanc
        $WhiteKing = new King($WhiteKingsCoordinates, TRUE);
        //Pion noir
        $BlackPawn = new Pawn($BlackPawnsCoordinates, FALSE);
        //Roi noir
        $BlackKing = new King($BlackKingsCoordinates, FALSE);
        
        
        //On ajoute les pièce au plateau
        $board2->addPiece($WhiteKing);
        $board2->addPiece($BlackKing);
        $board2->addPiece($BlackPawn);
        
        //Cas echec mais pas mat
        //Le pion noir met le roi blanc en echec mais pas en echec et mat
        self::assertEquals(FALSE, $board2->checkmateOf(1));
        
        
    }
    /**
     * Tests Board->stalemateOf()
     */
    public function testStalemateOf()
    {
        //on crée un plateau
        $board = new Board(TRUE);
        
        //On crée les coordonnées des pièces
        $BlackKingsCoordinates = new BoardCoordinates(0, 7);
        $WhiteKingsCoordinates = new BoardCoordinates(2, 4);
        $WhiteQueensCoordinates = new BoardCoordinates(1, 5);
        
        //On crée les pièces
        $BlackKing = new King($BlackKingsCoordinates, FALSE);
        $WhiteKing = new King($WhiteKingsCoordinates, TRUE);
        $WhiteQueen = new Queen($WhiteQueensCoordinates, TRUE);
        
        //On ajoute les pièces au plateau
        $board->addPiece($BlackKing);
        $board->addPiece($WhiteQueen);
        $board->addPiece($WhiteKing);
        
        //Pat
        self::assertEquals(TRUE, $board->stalemateOf(0));
        //pas de pat
        self::assertEquals(FALSE, $board->stalemateOf(1));
        
        
        
        
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