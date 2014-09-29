<?php

namespace models\database;

require_once __DIR__ . '/../../sprint_autoload.php';

use \PDO;
use modeles\database\DataBaseConnection;
use modeles\labo\Labo;

/**
 * Class qui contien l'ensembe des requettes (vraiment crade au finale)
 * 
 * @todo c'est pas top comme conception je tenterait de faire mieux plutard 

 * 
 * @package     models\database
 * @subpackage  Querys
 * @category    classes
 * @author      benoît barthès
 */
class Querys {
    /*
     * petite note le &= c'est un ET logique avec afectation, c'est comme pour l'adition avec le +=
     */

    /**
     * Tableau associatif de requettes préparé 
     * @var PDOStatement[] $tabPDOStatement
     * @access private
     */
    private static $tabPDOStatement = array();

    /**
     * Constructeur de la class
     * Jamais appelé
     * 
     * @access private
     */
    private function __construct() {
        
    }
	
	
	/**
     * Dit si une requette existe
     * @access public
     * @static
     * 
     * @param string $nameQuery
     * @return boolean
     */
    public static function querysExists($nameQuery) {
        return array_key_exists($nameQuery, Querys::$tabPDOStatement);
        
    }
    /**
     * Vérifie que la requette est déjà préparé
     * @access public
     * @static
     * 
     * @param string $nameQuery
     * @param string $sql
     * @return void
     */
    public static function setQuerys($nameQuery, $sql) {
        if (!Querys::querysExists($nameQuery)) {
            Querys::$tabPDOStatement[$nameQuery] = DataBaseConnection::prepare($sql);
        }
    }
    
    /**
     * Retourne le statement d'une requette
     * @access public
     * @static
     * 
     * @todo a teste
     *
     * @param string $nameQuery
     * @return Statement
     */
    public static function getStatement($nameQuery) {
        if (Querys::querysExists($nameQuery)){
            return Querys::$tabPDOStatement[$nameQuery];
        }
    }
    

    /**
     * Ajoute un labo à la base de données
     * @access public
     * @static
     * 
     * @param \modeles\labo\Labo $labo le nouveaux labo à ajouter
     * @return string numero du labo ou null
     */
    public static function addLabo(Labo $labo) {
        $nameQuery = "addShop";
        $sql = "INSERT INTO labo (`courrielLabo`, `nameLabo`,`pwd`, `sel`) 
                VALUES (:courrielLabo, :nameLabo, :pwd, :sel)";
        Querys::setQuerys($nameQuery, $sql);

        Querys::$tabPDOStatement[$nameQuery]->bindParam(':courrielLabo', $labo->getCourriel());
        Querys::$tabPDOStatement[$nameQuery]->bindParam(':nameLabo', $labo->getName);
        Querys::$tabPDOStatement[$nameQuery]->bindParam(':pwd', $labo->getPwd());
        Querys::$tabPDOStatement[$nameQuery]->bindParam(':sel', $labo->getSel());

        $idLabo = null;
        if (Querys::$tabPDOStatement[$nameQuery]->execute()) {
            $idLabo = DataBaseConnection::lastInsertId();
        }

        return $idLabo;
    }

    /**
     * Récupere un labo
     * 
     * @access public
     * @static
     * 
     * @param int $idLabo
     * @return \modeles\labo\Labo null si le labo n'existe pas
     */
    public static function getLabo($idLabo) {
        $nameQuery = "getLabo";
        $sql = "SELECT * FROM labo WHERE id_labo = :id_labo";
        Querys::setQuerys($nameQuery, $sql);
        Querys::$tabPDOStatement[$nameQuery]->bindParam(':id_labo', $idLabo);
        Querys::$tabPDOStatement[$nameQuery]->execute();

        $labo = null;
        $sqlLabo = Querys::$tabPDOStatement[$nameQuery]->fetch(PDO::FETCH_ASSOC);
        if ($sqlLabo != false) {
            $labo = new Labo($sqlLabo['id_labo'], $sqlLabo['courrielLabo'], $sqlLabo['nameLabo'], $sqlLabo['pwd'], $sqlLabo['sel']);
        }

        return $labo;
    }

}
