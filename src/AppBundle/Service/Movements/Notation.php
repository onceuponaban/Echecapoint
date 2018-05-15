<?php
namespace AppBundle\Service\Movements;

abstract class Notation
{
    const MOVE = '-';
    
    const CAPTURE = 'x';
    
    const CHECK = '+';
    
    const MATE = '#';
    
    const PAWN = '';
    
    const KNIGHT = 'N';
    
    const BISHOP = 'B';
    
    const ROOK = 'R';
    
    const QUEEN = 'Q';
    
    const KING = 'K';
}

