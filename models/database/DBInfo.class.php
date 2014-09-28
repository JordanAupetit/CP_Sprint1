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

    const dbhost = 'mysql';
    const dbport = 'dbserver';
    const dbname = 'jaupetit';
    const dbuser = 'jaupetit';
    const dbpassword = 'jaupetit';

    /**
     * Constructeur de la class
     * Jamais appelé
     * @access private
     */
    private function __construct() {
        
    }
}
