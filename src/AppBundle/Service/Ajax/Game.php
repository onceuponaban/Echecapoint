<?php
namespace AppBundle\Service\Ajax;

use AppBundle\Service\Board\Board;
use AppBundle\Service\Board\BoardCoordinates;

/*
 include '../src/AppBundle/Service/Board/Board.php';
 include '../src/AppBundle/Service/Board/BoardCoordinates.php';
 include '../src/AppBundle/Service/Pieces/Pawn.php';
 include '../src/AppBundle/Service/Pieces/Piece.php';
 include '../src/AppBundle/Service/Pieces/PiecesValue.php';
 include '../src/AppBundle/Service/Pieces/Knight.php';
 include '../src/AppBundle/Service/Pieces/King.php';
 include '../src/AppBundle/Service/Pieces/Queen.php';
 include '../src/AppBundle/Service/Pieces/Bishop.php';
 include '../src/AppBundle/Service/Pieces/Rook.php';
 include '../src/AppBundle/Service/Movements/Move.php';
 include '../src/AppBundle/Service/Movements/Notation.php';
 include '../src/AppBundle/Service/Movements/Turn.php';
 */


$case = (isset($_GET["Case"])) ? $_GET["Case"] : NULL;
$partie = (isset($_GET["Partie"])) ? $_GET["Partie"] : NULL;

if($case && $partie)
{
    $board = new Board(false);
    $board->updateFromString($partie);
    
    $piece = $board->pieceAt(BoardCoordinates::fromString($case));
    
    $moveList = $board->getPossibleMovesOf($piece);
    
    if(count($moveList) != 0)
    {
        
        $stringMove = "";
        
        foreach ($moveList as $move)
        {
            $stringMove = $stringMove." ".$move->getCoordinates()->getFile().$move->getCoordinates()->getRank();
        }
        
        echo $stringMove;
        
    }
    else
    {
        echo "";
    }
}
else
{
    echo "";
}

