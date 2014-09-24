<?php

namespace models\database;

/**
 * dbinfo est une class qui contiend les informations de connection à la base de données.
 * 
 * @package     webConnect\database
 * @subpackage  DBInfo
 * @category    classes
 * @author      benoît barthès
 */
class DBInfo {

    const dbhost = 'dbhost';
    const dbport = 'dbport';
    const dbname = 'dbname';
    const dbuser = 'dbuser';
    const dbpassword = 'dbpassword';

    /**
     * Constructeur de la class
     * Jamais appelé
     * @access private
     */
    private function __construct() {
        
    }
}
