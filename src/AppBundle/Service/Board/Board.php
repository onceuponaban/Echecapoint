<?php
namespace Service\Board;

use AppBundle\Service\Pieces\Piece;

/**
 * @name Board
 * 
 * @desc ReprÃ©sente un plateau d'Ã©checs
 * 
 * @author Luca Mayer-Dalverny
 */
class Board
{
    /**
     * @name pieceList
     * @desc La liste des piÃ¨ces prÃ©sentes sur le plateau
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
        
        //Recherche des coordonnées du roi de la couleur spécifiée
        foreach ($this->pieceList  as $piece){
            //Si la piece dans la list est un roi
            if($piece==King::class){
                //Si le roi est blanc et la couleur de recherche aussi
                if(($piece->isWhite && $color==WHITE)||(!$piece->isWhite && $color==BLACK)){
                 $KingCoordinates=$piece.getcoordinates();
                }
            } 
        }
        
        //Pour toutes les pièce de l'autre couleur on vérifie si elles peuvent mettre le roi en echec 
        
        foreach ($this->pieceList as $piece){
            if(($piece->isWhite && $color==BLACK)||(!$piece->isWhite && $color==WHITE)){
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
            //On sauvegarde la liste de pièce actuelle
            $savePieceList = $this->pieceList;
            
            //On cherche les coordonnées du roi
            foreach ($this->pieceList  as $piece){
                //Si la piece dans la list est un roi
                if($piece==King::class){
                    //Si le roi est la couleur de recherche sont les mêmes
                    if(($piece->isWhite && $color==WHITE)||(!$piece->isWhite && $color==BLACK)){
                        $KingCoordinates=$piece.getcoordinates();
                        $King = $piece;
                    }
                }
            }
            //On récupère la liste des déplacements possibles du roi en question
            $KingMoves = $King->getPossibleMovesCoordinates();
            
            //Pour tous les mouvements possibles de la liste
            foreach ($KingMoves as $move){
                //On déplace le roi
                $King->coordinates->setFileAndRank($move->getFile(),$move->getRank());
                //Si le roi n('est plus en echec
                if(!self::echecToKingOf($color)){
                    //On replace le roi
                    $King->coordinates->setFileAndRank($KingCoordinates->getFile(),$KingCoordinates->getRank());
                    //Il n'y a pas echec et mat
                    return false;  
                }
            }
            //Pour tous les déplacements possibles du roi, ce dernier est toujours en echec
            //On replace le roi a sa position initiale
            $King->coordinates->setFileAndRank($KingCoordinates->getFile(),$KingCoordinates->getRank());
            //On est en echec et mat
            return true;
            
            
        }
        else{
            //le roi n'est pas en echec, donc pas de mat
            return FALSE;
        }
        
        
    }
    
    
}

