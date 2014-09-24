<?php

spl_autoload_register('spring_autoload');
/**
 * Fonction d'autoload des class 
 * 
 * @param string $class nom de la class qualifier (package\class)
 */
function spring_autoload($class) {

    require_once __DIR__ . '/' . str_replace('\\', '/', $class) . '.class.php';
}

