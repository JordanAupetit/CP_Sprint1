<?php


class AtelierForm {
 


  protected $atelier;
  

 /* Fonctions membres de la classe */

  /* Constructeur   */
  public function __construct($atelier) {
	 $this->atelier = $atelier;
  }


  public function makeForm($actionUrl,$invite) {
	$nomAtelier = $this->atelier->getNomAtelier();
	$dateAtelier = $this->atelier->getDateAtelier();
    $description = $this->atelier->getDescription();
    $id = $this->atelier->getId(); 

    /* génération du formulaire :
     * - on affiche les données de l'objet dans les différents champs
     */      
    $text = <<<EOT
	<form action="{$actionUrl}" method="post" >

	<div><span>Nom de l'atelier :</span>
     	<span><input type="text" name="nomAtelier" value="{$nomAtelier}" /></span>
	</div>

	<div><span>date :</span>
     		<span><input type="text" name="dateAtelier" value="{$dateAtelier}" /></span>
	</div>

	<div><span>Description :</span>
     		<span><textarea name="description" cols="30" rows="3">
             		{$description}</textarea></span>
	</div>

	<div class="submit">
     		<input type="hidden" name="id" value="{$id}" />
     		<input type="submit" name="go" value="{$invite}" />
	</div>
	</form>
EOT;
return $text;
 }
 }