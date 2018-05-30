<?php

use AppBundle\Service\Board\Board;
use AppBundle\Service\Board\BoardCoordinates;

$case = (isset($_GET["Case"])) ? $_GET["Case"] : NULL;
$partie = (isset($_GET["Partie"])) ? $_GET["Partie"] : NULL;

if($case && $partie)
{
    $board = new Board(false);
    $board->updateFromString($partie);
    
    $piece = $board->pieceAt(BoardCoordinates::fromString($case));
    
    $moveList = $board->getPossibleMovesOf($piece);
}
else
{
    echo "";
}