<?php

namespace views;

/**
 * Produit le corp html(5) d'une page html
 * 
 * @todo c'est juste  le minima pour l'instant

 * 
 * @package     views
 * @subpackage  HtmlBody
 * @category    classes
 * @author      benoît barthès
 */
class HtmlBody {

    /**
     * Constructeur de la class
     * Jamais appelé
     * 
     * @access private
     */
    private function __construct() {
        
    }

    /**
     * retourne le début d'une page html
     * @access private
     * @static
     * 
     * @param string $title
     * @return String code html du head de la page
     */
    private static function getStart($title) {
        $html = "<!doctype html>"
                . "<html lang=fr>"
                . "<head>"
                . "<title>$title</title>"
                . "</head>"
                . "<body>";

        return $html;
    }

    /**
     * retourne la fin d'une page html
     * @access private
     * @static
     * 
     * @return String code html du bed de la page
     */
    private static function getEnd() {
        $html = "</body>"
                . "</html>";

        return $html;
    }

}
