<?php

namespace models\database;

require_once __DIR__ . '/../../sprint_autoload.php';

use \PDO;
//use webConnect\database\DBInfo;

/**
 * Class simple pour préparer ou exécuter une requette sql. 
 * Elle ne peut pas étre instancier.
 * 
 * @package     webConnect\database
 * @subpackage  DataBaseConnection
 * @category    classes
 * @author      benoît barthès
 */
class DataBaseConnection {

    /**
     * Objet de connection avec une base de données
     * @var PDO $pdo
     * @static
     * @access private
     */
    private static $pdo = NULL;

    /**
     * Constructeur de la class jamais appelé
     * @access private
     */
    private function __construct() {

    }

    /**
     * Ce connecte à une base de données 
     * 
     * @static
     * @access private
     * @return void
     */
    private static function connection() {
        $url = 'mysql:host=' . DBInfo::dbhost . ';port=' . DBInfo::dbport . ';dbname=' . DBInfo::dbname;
        self::$pdo = new PDO($url, DBInfo::dbuser, DBInfo::dbpassword , array(
           PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
    }

    private static function isSetConnection() {
        return self::$pdo != null;
    }

    /**
     * Vérifie si la connection est active, si ce n'est pas le cas elle lance l'acte de connexion.
     *  
     * @static
     * @access private 
     * @return void
     */
    private static function setConnection() {
        if (!self::isSetConnection()) {
            self::connection();
        }
    }

    /**
     * Préparer une requette
     *  
     * @static
     * @access private
     * 
     * @param string $querys contiend une requette
     *  
     * @return PDOStatement permet de lancer plusieur fois une requette
     */
    public static function prepare($querys) {
        self::setConnection();

        return self::$pdo->prepare($querys);
    }

    /**
     * Execute une requette
     *  
     * @static
     * @access private
     * 
     * @param string $querys contiend une requette
     *  
     * @return PDOStatement contient le résulta de la requette
     */
    public static function query($querys) {
        self::setConnection();
        var_dump($querys);
        return self::$pdo->query($querys);
    }

    public static function lastInsertId($name = null) {
        $return = null;
        if (self::isSetConnection()) {
            $return = self::$pdo->lastInsertId($name);
        }

        return $return;
    }

}
