<?php

namespace modeles\labo;

/**
 * La class labo est un conteneur d'information.
 * 
 * 
 * @package     modeles\labo;
 * @subpackage  Labo
 * @category    classes
 * @author      benoît barthès
 */
class Labo {

    /**
     *
     * @var string 
     */
    public $id;

     /**
      *
      * @var string
      */
     public $courriel;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     *
     * @var sel 
     */
    public $sel;
     
    /**
     * 
     * @param type $id
     * @param type $courriel
     * @param type $name
     * @param type $sel
     */
    function __construct($id, $courriel, $name, $sel) {
        $this->id = $id;
        $this->courriel =$courriel;
        $this->name = $name;
        $this->sel = $sel;
    }

    public function getId() {
        return $this->id;
    }

    public function getCourriel() {
        return $this->courriel;
    }

    public function getName() {
        return $this->name;
    }

    public function getSel() {
        return $this->sel;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCourriel($courriel) {
        $this->courriel = $courriel;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSel(sel $sel) {
        $this->sel = $sel;
    }


}

