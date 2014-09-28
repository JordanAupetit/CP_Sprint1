<?php

spl_autoload_register('sprint_autoload');
/**
 * Fonction d'autoload des class 
 * 
 * @param string $class nom de la class qualifier (package\class)
 */
function sprint_autoload($class) {

    require_once __DIR__ . '/' . str_replace('\\', '/', $class) . '.class.php';
}

