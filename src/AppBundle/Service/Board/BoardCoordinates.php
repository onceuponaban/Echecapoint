<?php
namespace Service\Board;

/**
 * @name BoardCoordinates
 *
 * @desc Représente les coordonnées d'une case de l'échiquier
 *
 * @author Luca Mayer-Dalverny
 */
class BoardCoordinates
{
    /**
     * @name file
     * @desc La colonne de la case
     * @var integer
     */
    private $file;
    
    /**
     * @name rank
     * @desc La ligne de la case
     * @var integer
     */
    private $rank;
    
    /**
     * @name isOnTheBoard
     * @desc Si les coordonnées sont sur le plateau
     * @var boolean : true, les coordonnées sont sur le plateau | false, les coordonnées ne sont pas sur le plateau
     */
    private $isOnTheBoard;
    
    /**
     * @method construct
     * @desc Instancie l'objet à partir de la ligne et de la colonne de la case
     * @param int $file : La colonne de la case
     * @param int $rank : La ligne de la case
     */
    public function __construct(int $file, int $rank)
    {
        $this->setFileAndRank($file, $rank);
    }
    
    /**
     * @method toString
     * @desc Représente la coordonnées de la case sous forme d'une chaine de caractère
     * @return String
     */
    public function toString():String
    {
        
    }
    
    /**
     * @method setFile
     * @desc Change la valeur de la colonne des coordonnées de la case
     * @param int $newFile
     */
    public function setFile(int $newFile)
    {
        $this->file = $newFile;
        
        if(($this->file < 0)||($this->file > 7))
        {
            $this->isOnTheBoard = false;
        }
    }
    
    /**
     * @method setRank
     * @desc Change la valeur de la ligne des coordonnées de la case
     * @param int $newRank
     */
    public function setRank(int $newRank)
    {
        $this->rank = $newRank;
        
        if(($this->rank < 0)||($this->rank > 7))
        {
            $this->isOnTheBoard = false;
        }
    }
    
    /**
     * @method setFileAndRank
     * @desc
     * @param int $newFile
     * @param int $newRank
     */
    public function setFileAndRank(int $newFile, int $newRank)
    {
        $this->setFile($newFile);
        $this->setRank($newRank);
    }
    
    /**
     * @method getFile
     * @desc Renvoi la colonne de la case
     * @return int
     */
    public function getFile():int
    {
        return $this->file;
    }
    
    /**
     * @method getRank
     * @desc Renvoi la ligne de la case
     * @return int
     */
    public function getRank():int
    {
        return $this->rank;
    }
    
    /**
     * @method isOnTheBoard
     * @desc Permet de savoir si la case est sur le plateau
     * @return bool : true, la case est sur le plateau | false, la case n'est pas sur le plateau
     */
    public function isOnTheBoard():bool
    {
        return $this->isOnTheBoard;
    }
}

