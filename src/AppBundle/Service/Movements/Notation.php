<?php
namespace AppBundle\Service\Movements;

abstract class Notation
{
    const MOVE = '-';
    
    const CAPTURE = 'x';
    
    const PROMOTION = '=';
    
    const CHECK = '+';
    
    const MATE = '#';
    
    const PAWN = 'P';
    
    const KNIGHT = 'N';
    
    const BISHOP = 'B';
    
    const ROOK = 'R';
    
    const QUEEN = 'Q';
    
    const KING = 'K';
}

