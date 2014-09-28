<?php


class AtelierAffichage {

 protected $atelier;

 /* Fonctions membres de la classe */


  /* Constructeur   */

  public function __construct(AtelierConstruct $atelier) {
    $this->atelier = $atelier;

  }


  /* Méthode afficher : afficher les ateliers avec les liens modifier/supprimer */
  public function makeHtml() {
 	$htmlCode = "<div class=\"atelier\">Atelier : {$this->atelier->getId()} et {$this->atelier->getNomAtelier()} -- <a href=\"controleur_atelier.class.php?a=afficher&id={$this->atelier->getId()}\">afficher</a> -- <a href=\"controleur_atelier.class.php?a=modifier&id={$this->atelier->getId()}\">modifier</a> -- <a href=\"controleur_atelier.class.php?a=supprimer&id={$this->atelier->getId()}\">supprimer</a></div>\n";
    return $htmlCode;

  }

}
?>
