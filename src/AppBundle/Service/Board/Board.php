<?php
namespace Service\Board;

use AppBundle\Service\Movements\Move;
use AppBundle\Service\Pieces\King;
use AppBundle\Service\Pieces\Piece;
use AppBundle\Service\Pieces\Pawn;
use AppBundle\Service\Pieces\Bishop;
use AppBundle\Service\Pieces\Knight;
use AppBundle\Service\Pieces\Rook;
use AppBundle\Service\Pieces\Queen;
use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Movements\Turn;

/**
 * @name Board
 *
 * @desc Représente un plateau d'échecs
 *
 * @author Luca Mayer-Dalverny
 */
class Board
{
    /**
     * @name pieceList
     * @desc La liste des pièces présentes sur le plateau
     * @var array(Piece::class)
     */
    private $pieceList = array(Piece::class);
    
    /**
     * @name turnList
     * @desc La liste des tours de jeu déjà joués
     * @var array(Turn::class)
     */
    private $turnList = array(Turn::class);
    
    /**
     * @name whiteScore
     * @desc Le score du joueur blanc
     * @var integer
     */
    private $whiteScore;
    
    /**
     * @name blackScore
     * @desc Le score du joueur noir
     * @var integer
     */
    private $blackScore;
    
    const WHITE = 1;
    const BLACK = 0;
    
    public function getPossibleMovesOf(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        
        switch ($pieceToGetMoves)
        {
            case Pawn::class:
                break;
                
            case Bishop::class:
                $moveList = $this->getPossibleMovesOfBishop($pieceToGetMoves);
                break;
                
            case Knight::class:
                $moveList = $this->getPossibleMovesOfKnight($pieceToGetMoves);
                break;
                
            case Rook::class:
                $moveList = $this->getPossibleMovesOfRook($pieceToGetMoves);
                break;
                
            case Queen::class:
                $moveList = $this->getPossibleMovesOfQueen($pieceToGetMoves);
                break;
                
            case King::class:
                break;
                
            return $moveList;
        }
    }
    
    public function getPossibleMovesOfBishop(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        //On va parcourir les quatres diagonales jusqu'à rencontrer
        $i = 1;
        do {
            $move = new BoardCoordinates($pieceFile + $i, $pieceRank + $i);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
            $moveList[] = $move;
            if($this->isFilled($move)) //si la case est occupée, on s'arrête également
            {
                //si la pièce est du camp adverse, elle peut être capturée
                if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                    $moveList[] = $move;
                break;
            }
            $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile + $i, $pieceRank - $i);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile - $i, $pieceRank + $i);
            if(!$move->isOnTheBoard())
                if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile - $i, $pieceRank - $i);
            if(!$move->isOnTheBoard())
                if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        return $moveList;
    }
    
    public function getPossibleMovesOfKnight(Piece $pieceToGetMoves):array
    {
        $untestedMoveList = array();
        $moveList = array();
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        //Les 8 cases possibles pour un cavalier
        $untestedMoveList[] = new BoardCoordinates($pieceFile+2, $pieceRank+1);
        $untestedMoveList[] = new BoardCoordinates($pieceFile+2, $pieceRank-1);
        $untestedMoveList[] = new BoardCoordinates($pieceFile-2, $pieceRank+1);
        $untestedMoveList[] = new BoardCoordinates($pieceFile-2, $pieceRank-1);
        $untestedMoveList[] = new BoardCoordinates($pieceFile+1, $pieceRank+2);
        $untestedMoveList[] = new BoardCoordinates($pieceFile+1, $pieceRank-2);
        $untestedMoveList[] = new BoardCoordinates($pieceFile-1, $pieceRank+2);
        $untestedMoveList[] = new BoardCoordinates($pieceFile-1, $pieceRank-2);
        foreach($untestedMoveList as $move)
        {
            //on vérifie si la case est sur le plateau
            if($move->isOnTheBoard())
            {
                $moveList[] = $move;
            }
        }
        return $moveList;
    }
    
    public function getPossibleMovesOfRook(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        $i = 1;
        do {
            $move = new BoardCoordinates($pieceFile + $i, $pieceRank);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile - $i, $pieceRank);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile, $pieceRank + $i);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        do {
            $move = new BoardCoordinates($pieceFile + $i, $pieceRank - $i);
            if(!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
                break;
                $moveList[] = $move;
                if($this->isFilled($move)) //si la case est occupée
                {
                    //si la pièce est du camp adverse, elle peut être capturée
                    if(!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                        $moveList[] = $move;
                    break;
                }
                $i++;
        } while($i<=7);
        
        return $moveList;
    }
    
    public function getPossibleMovesOfQueen(Piece $pieceToGetMoves):array
    {
        //le mouvement de la reine est le mouvement combiné d'une tour et d'un fou.
        $moveList = array_merge($this->getPossibleMovesOfBishop($pieceToGetMoves),$this->getPossibleMovesOfRook($pieceToGetMoves));
        return $moveList;
    }
    
    public function checkOf(int $color):bool
    {
        
        //Recherche des coordonnées du roi de la couleur spécifiée
        foreach ($this->pieceList  as $piece){
            //Si la piece dans la list est un roi
            if($piece==King::class){
                //Si le roi et la couleur de recherche sont les mêmes
                if(!($piece->isWhite xor $color)){
                 $KingCoordinates=$piece.getcoordinates();
                }
            }
        }
        
        //Pour toutes les pièce de l'autre couleur on vérifie si elles peuvent mettre le roi en echec
        
        foreach ($this->pieceList as $piece){
            if($piece->isWhite xor $color){
                //test coup possible vers $KingCoordinates
                $savePiece = $piece;
                if($piece->moveTo($KingCoordinates)){
                    $piece=$savePiece;
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            }
        }
    }
    
    public function checkmateOf(int $color):bool
    {
        //Le roi de la couleur est-il en echec
        if($this->checkOf($color)){
            //On sauvegarde la liste de pièce actuelle
            $savePieceList = $this->pieceList;
            
            //On cherche les coordonnées du roi
            foreach ($this->pieceList  as $piece){
                //Si la pièce dans la list est un roi
                if($piece==King::class){
                    //Si le roi est la couleur de recherche sont les mêmes
                    if(!($piece->isWhite xor $color)){
                        $KingCoordinates=$piece.getcoordinates();
                        $King = $piece;
                    }
                }
            }
            //On récupère la liste des déplacements possibles du roi en question
            $KingMoves = $this->getPossibleMovesOf($King);
            
            //Pour tous les mouvements possibles de la liste
            foreach ($KingMoves as $move){
                //On déplace le roi
                $King->moveTo($move);
                //Si le roi n'est plus en echec
                if(!($this->checkOf($color))){
                    //On replace le roi
                    $King->moveTo($KingCoordinates);
                    //Il n'y a pas echec et mat
                    return false;
                }
            }
            //Pour tous les déplacements possibles du roi, ce dernier est toujours en echec
            //On replace le roi a sa position initiale
            $King->moveTo($KingCoordinates);
            //On est en echec et mat
            return true;
            
            
        }
        else{
            //le roi n'est pas en echec, donc pas de mat
            return FALSE;
        }
        
        
    }
    
    public function stalemateOf(int $color)
    {
        //S'il y a echec
        if($this->checkOf($color)){
            //alors il n'y a pas de pat
            return false;
        }
        else{
            $savePieceList = $this->pieceList;
            foreach ($this->pieceList as $piece){
                //Si la piece et la couleur sont les mêmes
                if(!($piece->isWhite xor $color)){
                    //On récupère les mouvement possibles
                    $savePiece = $piece;
                    $MovePossible = $this->getPossibleMovesOf($piece);
                    //On teste chacun des mouvements
                    foreach ($MovePossible as $move){
                        //On bouge la pièce
                        $piece->moveTo($move);
                        //On teste s'il y a echec au roi dans cete configuration
                        if(!($this->checkOf($color))){
                            //Le roi n'est pas mis en echec alors il n'y a a pas de pat, on remet le plateau à sa place originelle
                            $piece = $savePiece;
                            $this->pieceList = $savePieceList;
                            return false;
                        }
                    }
                    //On replace la piece à ses valeurs initiales
                    $piece=$savePiece;
                }
            }
            //On a testé tous les mouvements sans en trouver un ne mettant pas le roi en echec, alors il y a pat
            return TRUE;
        }
    }
    
    public function updateFromString(string $gameNotation)
    {
        $turnArray = explode(";",$gameNotation);
        
        foreach($turnArray as $turn)
        {
            array_push($this->turnList, Turn::fromString($turn));
        }
    }
    
    public function updateFromMove(Move $moveToAdd)
    {
        
    }
    
    public function isFilled(BoardCoordinates $coordinates)
    {
        if(is_null(pieceAt($coordinates)))
            return false;
        return true;
    }
    
    public function pieceAt(BoardCoordinates $coordinates)
    {
        
        foreach ($this->pieceList as $piece)
        {
            //si on retrouve une pièce de même ligne et colonne
            if($piece->getCoordinates()->getFile() == $coordinates->getFile() && $piece->getCoordinates()->getRank() == $coordinates->getRank())
                return $piece;
        }
        return null;
    }
    
}

