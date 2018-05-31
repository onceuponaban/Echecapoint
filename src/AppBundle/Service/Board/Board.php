<?php
namespace AppBundle\Service\Board;

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
    private $pieceList = array();
    
    /**
     * @name turnList
     * @desc La liste des tours de jeu déjà joués
     * @var array(Turn::class)
     */
    private $turnList = array();
    
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

    public function __construct(bool $isEmpty)
    {
        
        if(!$isEmpty)
        {
            for($index = 0 ; $index < 8 ; $index+=1)
            {
                $this->addPiece(new Pawn(new BoardCoordinates($index, 1), true));
                $this->addPiece(new Pawn(new BoardCoordinates($index, 6), false));
                
                if(($index == 0) || ($index == 7))
                {
                    $this->addPiece(new Rook(new BoardCoordinates($index,0), true));
                    $this->addPiece(new Rook(new BoardCoordinates($index,7), false));
                }
                
                if(($index == 1) || ($index == 6))
                {
                    $this->addPiece(new Knight(new BoardCoordinates($index,0), true));
                    $this->addPiece(new Knight(new BoardCoordinates($index,7), false));
                }
                
                if(($index == 2) || ($index == 5))
                {
                    $this->addPiece(new Bishop(new BoardCoordinates($index,0), true));
                    $this->addPiece(new Bishop(new BoardCoordinates($index,7), false));
                }
                
                if($index == 3)
                {
                    $this->addPiece(new Queen(new BoardCoordinates($index,0), true));
                    $this->addPiece(new Queen(new BoardCoordinates($index,7), false));
                }
                
                if($index == 4)
                {
                    $this->addPiece(new King(new BoardCoordinates($index,0), true));
                    $this->addPiece(new King(new BoardCoordinates($index,7), false));
                }
            }
        }
        
        $this->whiteScore = 0;
        $this->blackScore = 0;
    }
    
    public function getPossibleMovesOf(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        
        switch (get_class($pieceToGetMoves) )
        {
            case Pawn::class:
                $moveList = $this->getPossibleMovesOfPawn($pieceToGetMoves);
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
                $moveList = $this->getPossibleMovesOfKing($pieceToGetMoves);
                break;
                
            
        }
        return $moveList;
    }
    
    public function getPossibleMovesOfPawn(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        if($pieceToGetMoves->isWhite())
        {
            $move1 = new BoardCoordinates($pieceFile, $pieceRank + 1);
            //si la case devant est vide
            if(!$this->isFilled($move1))
            {
                $moveList[] = $move1;
                $move2 = new BoardCoordinates($pieceFile, $pieceRank + 2);
                //si la case 2 lignes devant est vide également et que le pion n'a pas bougé
                if(!$this->isFilled($move2) && !$pieceToGetMoves->hasMoved())
                    $moveList[] = $move2;
            }
            $diagonalLeft = new BoardCoordinates($pieceFile - 1, $pieceRank + 1);
            if($this->isFilled($diagonalLeft))
            {
                //si une pièce ennemie est à la diagonale gauche
                if(!($this->pieceAt($diagonalLeft)->isWhite() == $pieceToGetMoves->isWhite()))
                    $moveList[] = $diagonalLeft;
            }
            $diagonalRight = new BoardCoordinates($pieceFile + 1, $pieceRank + 1);
            if($this->isFilled($diagonalRight))
            {
                //si une pièce ennemie est à la diagonale droite
                if(!($this->pieceAt($diagonalRight)->isWhite() == $pieceToGetMoves->isWhite()))
                    $moveList[] = $diagonalRight;
            }
            //Prise en passant
            $leftOfPawn = new BoardCoordinates($pieceFile - 1, $pieceRank);
            if($this->isFilled($leftOfPawn))
            {
                //si une pièce ennemie est à gauche
                if(!($this->pieceAt($leftOfPawn)->isWhite() == $pieceToGetMoves->isWhite()))
                {
                    if($this->pieceAt($leftOfPawn) instanceof Pawn)
                    {
                        if($this->pieceAt($leftOfPawn)->enPassantCapturePossible())
                            $moveList[] = $leftOfPawn;
                    }
                    $moveList[] = $leftOfPawn;
                }
            }
            $rightOfPawn = new BoardCoordinates($pieceFile + 1, $pieceRank);
            if($this->isFilled($rightOfPawn))
            {
                //si une pièce ennemie est à la diagonale droite
                if(!($this->pieceAt($rightOfPawn)->isWhite() == $pieceToGetMoves->isWhite()))
                {
                    if($this->pieceAt($rightOfPawn) instanceof Pawn)
                    {
                        if($this->pieceAt($rightOfPawn)->enPassantCapturePossible())
                            $moveList[] = $rightOfPawn;
                    }
                    $moveList[] = $rightOfPawn;
                }
            }
        }
        else
        {
            $move1 = new BoardCoordinates($pieceFile, $pieceRank - 1);
            //si la case devant est vide
            if(!$this->isFilled($move1))
            {
                $moveList[] = $move1;
                $move2 = new BoardCoordinates($pieceFile, $pieceRank - 2);
                //si la case 2 lignes devant est vide également et que le pion n'a pas bougé
                if(!$this->isFilled($move2) && !$pieceToGetMoves->hasMoved())
                    $moveList[] = $move2;
            }
            $diagonalLeft = new BoardCoordinates($pieceFile - 1, $pieceRank - 1);
            if($this->isFilled($diagonalLeft))
            {
                //si une pièce ennemie est à la diagonale gauche
                if(!($this->pieceAt($diagonalLeft)->isWhite() == $pieceToGetMoves->isWhite()))
                    $moveList[] = $diagonalLeft;
            }
            $diagonalRight = new BoardCoordinates($pieceFile + 1, $pieceRank - 1);
            if($this->isFilled($diagonalRight))
            {
                //si une pièce ennemie est à la diagonale droite
                if(!($this->pieceAt($diagonalRight)->isWhite() == $pieceToGetMoves->isWhite()))
                    $moveList[] = $diagonalRight;
            }
            //Prise en passant
            $leftOfPawn = new BoardCoordinates($pieceFile - 1, $pieceRank);
            if($this->isFilled($leftOfPawn))
            {
                //si une pièce ennemie est à gauche
                if(!($this->pieceAt($leftOfPawn)->isWhite() == $pieceToGetMoves->isWhite()))
                {
                    if($this->pieceAt($leftOfPawn) instanceof Pawn)
                    {
                        if($this->pieceAt($leftOfPawn)->enPassantCapturePossible())
                            $moveList[] = $leftOfPawn;
                    }
                    $moveList[] = $leftOfPawn;
                }
            }
            $rightOfPawn = new BoardCoordinates($pieceFile + 1, $pieceRank);
            if($this->isFilled($rightOfPawn))
            {
                //si une pièce ennemie est à la diagonale droite
                if(!($this->pieceAt($rightOfPawn)->isWhite() == $pieceToGetMoves->isWhite()))
                {
                    if($this->pieceAt($rightOfPawn) instanceof Pawn)
                    {
                        if($this->pieceAt($rightOfPawn)->enPassantCapturePossible())
                            $moveList[] = $rightOfPawn;
                    }
                    $moveList[] = $rightOfPawn;
                }
            }
        }
        return $moveList;
    }
    
    public function getPossibleMovesOfBishop(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        //On va parcourir les quatres diagonales jusqu'à rencontrer une pièce ou la fin du plateau
        $directionsList = array(
            array('file' => 1, 'rank' => 1),
            array('file' => 1, 'rank' => -1),
            array('file' => -1, 'rank' => 1),
            array('file' => -1, 'rank' => -1),
        );
        foreach ($directionsList as $direction)
        {
            $moveList = array_merge($moveList,$this->exploreDirection($pieceToGetMoves, $direction));
        }
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
            //on vérifie si la case est sur le plateau et que le mouvement ne soit pas bloqué par une pièce alliée
            if ($move->isOnTheBoard())
            {
                //si la case est occupée
                if ($this->isFilled($move))
                {
                    //si la pièce sur la case est ennemie
                    if($this->pieceAt($move)->isWhite() != $pieceToGetMoves->isWhite())
                    {
                        $moveList[] = $move;
                    }
                }
                else //la case est vide
                {
                    $moveList[] = $move;
                }
            }
        }
        return $moveList;
    }
    
    public function getPossibleMovesOfRook(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        //On va parcourir les quatres directions cardinales jusqu'à rencontrer une pièce ou la fin du plateau
        $directionsList = array(
            array('file' => 1, 'rank' => 0),
            array('file' => -1, 'rank' => 0),
            array('file' => 0, 'rank' => 1),
            array('file' => 0, 'rank' => -1),
        );
        foreach ($directionsList as $direction)
        {
            $moveList = array_merge($moveList,$this->exploreDirection($pieceToGetMoves, $direction));
        }
        return $moveList;
    }
    
    public function getPossibleMovesOfQueen(Piece $pieceToGetMoves):array
    {
        //le mouvement de la reine est le mouvement combiné d'une tour et d'un fou.
        $moveList = array_merge($this->getPossibleMovesOfBishop($pieceToGetMoves),$this->getPossibleMovesOfRook($pieceToGetMoves));
        return $moveList;
    }
    
    public function getPossibleMovesOfKing(Piece $pieceToGetMoves):array
    {
        $moveList = array();
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        for ($i = $pieceFile - 1; $i <= $pieceFile + 1; $i++)
        {
            for ($j = $pieceRank - 1; $j <= $pieceRank + 1; $j++)
            {
                $move = new BoardCoordinates($i, $j);
                //On vérifie que le mouvement est sur le plateau
                if ($move->isOnTheBoard())
                {
                    //si la place est libre, c'est un mouvement valide
                    if (!$this->isFilled($move))
                    {
                        $moveList[] = $move;
                    }
                    //si la pièce est du camp adverse, elle peut être capturée
                    else if (!($this->pieceAt($move)->isWhite() == $pieceToGetMoves->isWhite()))
                    {
                        $moveList[] = $move;
                    }
                }
            }
        }
        //Gestion du roque: il faut que le roi n'ait pas bougé, et que la tour n'ai pas bougé
        if(!$pieceToGetMoves->hasMoved())
        {
            $possibleRookLeft = new BoardCoordinates(0, $pieceRank);
            $possibleRookRight = new BoardCoordinates(7, $pieceRank);
            if($this->checkRook($possibleRookLeft))
                $moveList[] = $possibleRookLeft;
            if($this->checkRook($possibleRookRight))
                $moveList[] = $possibleRookRight;
        }
        return $moveList;
    }
    
    //vérifie si une tour n'ayant jamais bougé est présente sur la case indiquée
    public function checkRook(BoardCoordinates $coordinates):bool
    {
        if($this->isFilled($coordinates))
        {
            if($this->pieceAt($coordinates) instanceof Rook)
            {
                if(!$this->pieceAt($coordinates)->hasMoved())
                    return true;
            }
        }
        return false;
    }

    
    public function checkOf(int $color):bool
    {
        
        //Recherche des coordonnées du roi de la couleur spécifiée
        foreach ($this->pieceList  as $piece){
            //Si la piece dans la list est un roi
            if(get_class($piece) == King::class){
                
                //Si le roi et la couleur de recherche sont les mêmes
                if(!($piece->isWhite xor $color)){
                    
                 $KingCoordinates=$piece->getCoordinates();
                }
            }
        }
        
        //Pour toutes les pièce de l'autre couleur on vérifie si elles peuvent mettre le roi en echec
        
        foreach ($this->pieceList as $piece){
         
            if($piece->isWhite xor $color){
                //test coup possible vers $KingCoordinates
                $piecePossiblesMove = $this->getPossibleMovesOf($piece);
                
                foreach ($piecePossiblesMove as $move){
                   
                   //Si le mouvement est aux coordonnées du roi
                    if(($move->getFile() == $KingCoordinates->getFile())&&($move->getRank()==$KingCoordinates->getRank())){
                       
                        return TRUE;
                    }
                }
                
            }
        }
        
        
      
        return FALSE;
        
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
                if(get_class($piece)==King::class){
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
    
    public function exploreDirection(Piece $pieceToGetMoves, array $direction): array
    {
        //echo "Appel de la fonction sur la direction (".$direction['file'].",".$direction['rank'].")\n";
        $i = 1;
        $pieceFile = $pieceToGetMoves->getCoordinates()->getFile();
        $pieceRank = $pieceToGetMoves->getCoordinates()->getRank();
        $moveList = array();
        do
        {
            $move = new BoardCoordinates($pieceFile + $i*$direction['file'], $pieceRank + $i*$direction['rank']);
            if (!$move->isOnTheBoard()) //si la case n'est pas sur le tableau, on s'arrête
            {
                break;
            }
            //si la case est vide on l'ajoute
            if (!$this->isFilled($move))
            {
                $moveList[] = $move;
            }
            if ($this->isFilled($move)) //si la case est occupée
            {
                //si la pièce est du camp adverse, elle peut être capturée
                if ($this->pieceAt($move)->isWhite() != $pieceToGetMoves->isWhite())
                {
                    $moveList[] = $move;
                    break;
                }
                else
                {
                    break;
                }
            }
            $i++;
        } while($i<=7);
        return $moveList;
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
        if(($gameNotation != " ")&&($gameNotation != ""))
        {
            $turnArray = explode(";",$gameNotation);
            
            foreach($turnArray as $turn)
            {
                array_push($this->turnList, Turn::fromString($turn));
            }
        }
    }
    
    public function updateFromMove(Move $moveToAdd):bool
    {
        //on récupère la liste des coups possible pour la pièce
        $moveList = $this->getPossibleMovesOf($moveToAdd->getPiece());
        //On parcours la liste des mouvement possibles pour vérifier que le mouvement est possbile
        foreach ($moveList as $move)
        {
            if($moveToAdd->getCoordinates()->isEqualTo($move))
            {
                //On recopie notre plateau sur un plateau de test
                $boardTest = new Board(true);
                $boardTest->setWhiteScore($this->whiteScore);
                $boardTest->setBlackScore($this->blackScore);
                $boardTest->setTurnList($this->getTurnList());
                foreach ($this->pieceList as $pieceMain)
                {
                    switch (get_class($pieceMain) )
                    {
                        case Pawn::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new Pawn($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                        case Bishop::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new Bishop($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                            
                        case Knight::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new Knight($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                            
                        case Rook::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new Rook($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                            
                        case Queen::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new Queen($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                            
                        case King::class:
                            $coordinates = new BoardCoordinates($pieceMain->getCoordinates()->getFile(), $pieceMain->getCoordinates()->getRank());
                            $pieceToAdd = new King($coordinates, $pieceMain->isWhite());
                            $boardTest->addPiece($pieceToAdd);
                            break;
                    }
                }
                //le mouvement n'est valide que si il ne met pas le roi en échec. On va donc effectuer le mouvement puis vérifier si le roi est en échec.
                if(!$moveToAdd->isACapture())
                {
                    //le mouvement est soit un mouvement normal soit un roque
                    if($moveToAdd->getPiece() instanceof King
                        && (abs($moveToAdd->getCoordinates()->getFile() - $moveToAdd->getPiece()->getCoordinates()->getFile()) == 2))
                    {
                        //si la distance entre la tour et le roi est positive, c'est un petit roque
                        if ($moveToAdd->getCoordinates()->getFile() - $moveToAdd->getPiece()->getCoordinates()->getFile() > 0)
                        {
                            //on vérifie qu'aucune des cases couvertes par le roque ne soient menacées
                            for ($i = $moveToAdd->getPiece()->getCoordinates()->getFile(); $i <= $moveToAdd->getCoordinates()->getFile(); $i++)
                            {
                                $SquareToCheck = new BoardCoordinates($i, $moveToAdd->getPiece()->getCoordinates()->getRank());
                                foreach ($boardTest->getPieces() as $pieceTest)
                                {
                                    foreach($boardTest->getPossibleMovesOf($pieceTest) as $possibleMove)
                                    {
                                        if($SquareToCheck->isEqualTo($possibleMove))
                                            return false;
                                    }
                                }
                            }
                            //aucune des cases ne sont menacées: on tente le mouvement sur le plateau de test
                            $currentRookLocation = new BoardCoordinates(7, $moveToAdd->getCoordinates()->getRank());
                            $newRookLocation = new BoardCoordinates($moveToAdd->getCoordinates()->getFile() - 1, $moveToAdd->getCoordinates()->getRank());
                            //déplacement du roi
                            $boardTest->pieceAt($moveToAdd->getPiece()->getCoordinates())->moveTo($moveToAdd->getCoordinates());
                            //déplacement de la tour
                            ($boardTest->pieceAt($currentRookLocation))->moveTo($newRookLocation);
                        }
                        else //sinon, c'est un grand roque.
                        {
                            //on vérifie qu'aucune des cases couvertes par le roque ne soient menacées
                            for ($i = $moveToAdd->getCoordinates()->getFile(); $i <= $moveToAdd->getPiece()->getCoordinates()->getFile(); $i++)
                            {
                                $SquareToCheck = new BoardCoordinates($i, $moveToAdd->getPiece()->getCoordinates()->getRank());
                                foreach ($boardTest->getPieces() as $pieceTest)
                                {
                                    foreach($boardTest->getPossibleMovesOf($pieceTest) as $possibleMove)
                                    {
                                        if($SquareToCheck->isEqualTo($possibleMove))
                                            return false;
                                    }
                                }
                            }
                            //aucune des cases ne sont menacées: on tente le mouvement sur le plateau de test
                            $currentRookLocation = new BoardCoordinates(7, $moveToAdd->getCoordinates()->getRank());
                            $newRookLocation = new BoardCoordinates($moveToAdd->getCoordinates()->getFile() + 1, $moveToAdd->getCoordinates()->getRank());
                            //déplacement du roi
                            ($boardTest->pieceAt($moveToAdd->getPiece()->getCoordinates()))->moveTo($moveToAdd->getCoordinates());
                            //déplacement de la tour
                            ($boardTest->pieceAt($currentRookLocation))->moveTo($newRookLocation);
                        }
                    }
                    else
                    {
                        
                        //Mouvement standard : on tente le mouvement sur le plateau de test
                        ($boardTest->pieceAt($moveToAdd->getPiece()->getCoordinates()))->moveTo($moveToAdd->getCoordinates());
                    }
                }
                else //le mouvement est soit une capture normale soit une prise en passant
                {
                    //si c'est une prise en passant, la case de capture doit être vide
                    if(!$boardTest->isFilled($moveToAdd->getCoordinates()))
                    {
                        //on récupère la position du pion à capturer
                        $enemyPawnTrueLocation = new BoardCoordinates($moveToAdd->getCoordinates()->getFile(), $moveToAdd->getPiece()->getCoordinates()->getFile());
                        //on effectue le mouvement sur le plateau de test
                        ($boardTest->pieceAt($moveToAdd->getPiece()->getCoordinates()))->moveTo($moveToAdd->getCoordinates());
                        //On ajuste le score en conséquence
                        if($moveToAdd->getPiece()->isWhite())
                        {
                            $boardTest->setWhiteScore($boardTest->getWhiteScore() + $boardTest->pieceAt($enemyPawnTrueLocation)->getValue());
                        }
                        else
                        {
                            $boardTest->setBlackScore($boardTest->getBlackScore() + $boardTest->pieceAt($enemyPawnTrueLocation)->getValue());
                        }
                        $boardTest->removePieceAt($enemyPawnTrueLocation);
                    }
                    else //mouvement avec capture normal
                    {
                        $boardTest->pieceAt($moveToAdd->getPiece()->getCoordinates())->moveTo($moveToAdd->getCoordinates());
                        //On ajuste le score en conséquence
                        if($moveToAdd->getPiece()->isWhite())
                        {
                            $boardTest->setWhiteScore($boardTest->getWhiteScore() + $boardTest->pieceAt($moveToAdd->getCoordinates())->getValue());
                        }
                        else
                        {
                            $boardTest->setBlackScore($boardTest->getBlackScore() + $boardTest->pieceAt($moveToAdd->getCoordinates())->getValue());
                        }
                        $boardTest->removePieceAt($moveToAdd->getCoordinates());
                    }
                }
                //Après le mouvement (si il y en a eu un) on met à jour la liste de tours sur le plateau de test
                if($moveToAdd->getPiece()->isWhite())
                {
                    $turn = new Turn(count($boardTest->getTurnList()) + 1, $moveToAdd, null);
                    $turnListToUpdate = $boardTest->getTurnList();
                    $turnListToUpdate[] = $turn;
                    $boardTest->setTurnList($turnListToUpdate);
                }
                else
                {
                    //On récupère la liste des tours
                    $turnListToUpdate = $boardTest->getTurnList();
                    //On met a jour le dernier tour
                    $turnListToUpdate[count($turnListToUpdate) - 1]->setBlackMove($moveToAdd);
                    //On le remet dans la liste
                    $boardTest->setTurnList($turnListToUpdate);
                }
                // et on vérifie si il met le roi en echec
                if(!$boardTest->checkOf($moveToAdd->getPiece()->isWhite()))
                {
                    //mouvement valide ne mettant pas le roi en échec: on recopie la liste des pièces du plateau de test sur le plateau principal et on applique le score
                    $this->setPieces($boardTest->getPieces());
                    $this->setWhiteScore($boardTest->whiteScore);
                    $this->setBlackScore($boardTest->blackScore);
                    $this->setTurnList($boardTest->getTurnList());
                    //var_dump($turnListToUpdate);
                    return true;
                }
            }
        }
        return false;
    }
    
    public function isFilled(BoardCoordinates $coordinates):bool
    {
        if(is_null($this->pieceAt($coordinates)))
            return false;
        return true;
    }
    
    //vérifie si les tableaux de coordonnées fournis en paramètre ont les mêmes coordonnées (peu importe l'ordre)
    public function equalCoords($coords1, $coords2):bool
    {
        if (count($coords1) != count($coords2))
            return false;
        $arrayCheck = $coords2;
        $valueExists = false;
        foreach($coords1 as $i => $checked)
        {
            $valueExists = false;
            while(!$valueExists)
            {
                foreach($arrayCheck as $key => $check)
                {
                    if(!$valueExists && $coords1[$i]->isEqualTo($check))
                    {
                        unset($arrayCheck[$key]);
                        $valueExists = true;
                    }
                }
            }
            if (!$valueExists)
                return false;
        }
        return true;
    }
    
    //retourne la piece présente aux coordonnées données si elle existe, sinon retourne null
    public function pieceAt(BoardCoordinates $coordinates): ?Piece
    {
        
        foreach ($this->pieceList as $piece)
        {
            //si on retrouve une pièce de même ligne et colonne
            if($piece->getCoordinates()->isEqualTo($coordinates))
                return $piece;
        }
        return null;
    }
    
    public function addPiece(Piece $piece)
    {
        array_push($this->pieceList, $piece);
    }
    
    public function getPieces():array
    {
        return $this->pieceList;
    }
    
    /**
     * @return \AppBundle\Service\Board\array(Piece::class)
     */
    public function getPieceList()
    {
        return $this->pieceList;
    }

    /**
     * @return number
     */
    public function getWhiteScore()
    {
        return $this->whiteScore;
    }

    /**
     * @return number
     */
    public function getBlackScore()
    {
        return $this->blackScore;
    }
    
    /**
     * @param number $whiteScore
     */
    public function setWhiteScore($whiteScore)
    {
        $this->whiteScore = $whiteScore;
    }
    
    /**
     * @param number $blackScore
     */
    public function setBlackScore($blackScore)
    {
        $this->blackScore = $blackScore;
    }
    
    /**
     * @param \AppBundle\Service\Board\array(Piece::class) $pieceList
     */
    public function setPieces($pieceList)
    {
        $this->pieceList = $pieceList;
    }
    
    public function removePieceAt(BoardCoordinates $coordinates):bool
    {
        foreach($this->getPieces() as $piece)
        {
            if(($piece->getCoordinates())->isEqualto($coordinates))
            {
                unset($piece);
                return true;
            }
        }
        return false;
    }
    
    /**
     * @return \AppBundle\Service\Board\array(Turn::class)
     */
    public function getTurnList()
    {
        return $this->turnList;
    }
    
    /**
     * @param \AppBundle\Service\Board\array(Turn::class) $turnList
     */
    public function setTurnList($turnList)
    {
        $this->turnList = $turnList;
    }
    
    public function toString():string
    {
        $turnListString = "";
        foreach($this->getTurnList() as $turn)
        {
            $turnListString = $turnListString . "" . $turn->toString() . ";";
        }
        return $turnListString;
    }
    
}

