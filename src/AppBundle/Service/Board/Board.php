<?php
namespace Service\Board;

use AppBundle\Service\Pieces\King;
use AppBundle\Service\Pieces\Piece;

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
    
    
    
    public function echecToKingOf(int $color):bool{
        
        //Recherche des coordonn�es du roi de la couleur sp�cifi�e
        foreach ($this->pieceList  as $piece){
            //Si la piece dans la list est un roi
            if($piece==King::class){
                //Si le roi et la couleur de recherche sont les m�mes
                if(!($piece->isWhite xor $color==WHITE)||!($piece->isWhite xor $color==BLACK)){
                 $KingCoordinates=$piece.getcoordinates();
                }
            } 
        }
        
        //Pour toutes les pi�ce de l'autre couleur on v�rifie si elles peuvent mettre le roi en echec 
        
        foreach ($this->pieceList as $piece){
            if(($piece->isWhite xor $color==BLACK)||($piece->isWhite xor $color==WHITE)){
                //test coup possible vers $KingCoordinates
                //si le coup est possible
                //return true;
                
                //sinon
                //return false
            }
        }
    }
    
    public function echecAndMat(int $color):bool{
        //Le roi de la couleur est-il en echec
        if(self::echecToKingOf($color)){
            //On sauvegarde la liste de pi�ce actuelle
            $savePieceList = $this->pieceList;
            
            //On cherche les coordonn�es du roi
            foreach ($this->pieceList  as $piece){
                //Si la piece dans la list est un roi
                if($piece==King::class){
                    //Si le roi est la couleur de recherche sont les m�mes
                    if(!($piece->isWhite xor $color==WHITE)||!($piece->isWhite xor $color==BLACK)){
                        $KingCoordinates=$piece.getcoordinates();
                        $King = $piece;
                    }
                }
            }
            //On r�cup�re la liste des d�placements possibles du roi en question
            $KingMoves = $King->getPossibleMovesCoordinates();
            
            //Pour tous les mouvements possibles de la liste
            foreach ($KingMoves as $move){
                //On d�place le roi
                $King->moveTo($move);
                //Si le roi n('est plus en echec
                if(!self::echecToKingOf($color)){
                    //On replace le roi
                    $King->moveTo($KingCoordinates);
                    //Il n'y a pas echec et mat
                    return false;  
                }
            }
            //Pour tous les d�placements possibles du roi, ce dernier est toujours en echec
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
    
    public function Pat(int $color){
        //S'il y a echec
        if(self::echecToKingOf($color)){
            //alors il n'y a pas de pat
            return false;
        }
        else{
            $savePieceList = $this->pieceList;
            foreach ($this->pieceList as $piece){
                //Si la piece et la couleur sont les m�mes
                if(!($piece->isWhite xor $color==WHITE)||!($piece->isWhite xor $color==BLACK)){
                    //On r�cup�re les mouvement possibles
                    $savePiece = $piece;
                    $MovePossible = $piece->getPossibleMoves();
                    //On teste chacun des mouvements
                    foreach ($MovePossible as $move){
                        //On bouge la pi�ce
                        $piece->moveTo($move);
                        //On teste s'il y a echec au roi dans cete configuration
                        if(!self::echecToKingOf($color)){
                            //Le roi n'est pas mis en echec alors il n'y a a pas de pat, on remet le plateau � sa place originelle
                            $piece = $savePiece;
                            $this->pieceList = $savePieceList;
                            return false;
                        }
                    }
                    //On replace la piece � ses valeurs initiales
                    $piece=$savePiece;
                }
            }
            //On a test� tous les mouvements sans en trouver un ne mettant pas le roi en echec, alors il y a pat
            return TRUE;
        }
    }
    
    
}

