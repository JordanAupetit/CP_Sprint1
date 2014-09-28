<?php
class AtelierDetails {
protected $atelier;
public function __construct($atelier) {
	 $this->atelier = $atelier;
  }


  public function makeDetail($actionUrl,$invite) {
	$nomAtelier = $this->atelier->getNomAtelier();
	$dateAtelier = $this->atelier->getDateAtelier();
    $description = $this->atelier->getDescription();
    $id = $this->atelier->getId(); 

    $text = <<<EOT
	<form  >

	<div><span>Nom de l'atelier :</span>
     	<span><input type="text" name="nomAtelier" value="{$nomAtelier}" disabled="disabled"  /></span>
	</div>

	<div><span>date :</span>
     		<span><input type="text" name="dateAtelier" value="{$dateAtelier}" disabled="disabled"  /></span>
	</div>

	<div><span>Description :</span>
     		<span><textarea name="description" cols="30" rows="3" disabled="disabled" >
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