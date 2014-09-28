<?php 
require_once("../config/config.php");
require_once("../models/atelier.class.php");
require_once("../models/AtelierConstruct.class.php");
require_once("../models/AtelierAffichage.class.php");
require_once("../models/AtelierForm.class.php");

$data = is_array($_POST) ? $_POST : array();

$action = isset($_GET['a']) ? $_GET['a'] : "";

$titre="";
$c="";

$squelette = BASE_FILE . "views\\Ateliers\\view_atelier.html.php";

switch($action) {
  
 /* afficher un atelier */
 case "afficher" : 
  $titre = "Atelier";
   
   if (isset($_GET['id'])) {
     $id = $_GET['id'];
     
     //$at = Atelier::lire($id); //a implementer
       $form = new AtelierForm($at);
     $c = $form->makeForm(PUBLIC_URL."controleur_atelier.class.php?a=retour", "retour");
   } else {
      $c = "Il manque un id";
   }
    break;
case "retour" : 
	 goto defaultlabel;
   break;
  /* ajouter un nouvel atelier */
 case "ajouter" : 
	 $titre = "Ajouter un nouvel atelier";   

    $at = AtelierConstruct::initialize();
	$form = new AtelierForm($at);
    $c = $form->makeForm(PUBLIC_URL."controleur_atelier.class.php?a=enregistrernouveau", "ajouter");
    
    break;

 /* modifier un un atelier */
 case "modifier" : 
    $titre = "Modifier un atelier";
   
   if (isset($_GET['id'])) {
     $id = $_GET['id'];
     
     //$at = Atelier::lire($id); //a implementer
       $form = new AtelierForm($at);
     $c = $form->makeForm(PUBLIC_URL."controleur_atelier.class.php?a=enregistrermodif", "modifier");
   } else {
      $c = "Il manque un id";
   }
   
  break; 
  
  case 'enregistrernouveau':
    
   $atelier = AtelierConstruct::initialize($data);

   $form = new AtelierForm($atelier);
   Atelier::add($atelier);
   $titre = "Atelier enregistr&eacute;";
   $ui = new AtelierAffichage($atelier);
   $c = $ui->makeHtml();
   
   break;

case "enregistrermodif":
   $titre = "Atelier enregistr&eacute;";
   //$atelier = Atelier::lire($data['id']);
   $atelier->update($data);
   $form = new AtelierForm($atelier);

     Atelier::update_title($atelier);
	 Atelier::update_description($atelier);
     $ui = new AtelierAffichage($atelier);
     $c = $ui->makeHtml();
   break; 

 /* supprimer un atelier */
 case "supprimer":
   $titre = "Atelier supprim&eacute;";

   if (isset($_GET['id'])) {
     $c=Atelier::remove($_GET['id']); //mettre les méthodes en statique?
   } else {
     $titre = "Pas d'identifiant - suppression impossible";
   }
   break;

 default:
	defaultlabel:
   $titre = "Ateliers";
   $at = AtelierConstruct::initialize("");
   $ui = new AtelierAffichage($at);
   $c.="<a href=\"controleur_atelier.class.php?a=ajouter\">Ajouter un atelier</a>";
   $c .= $ui->makeHtml();

}

ob_start();
require_once($squelette);
$html = ob_get_contents();
ob_end_clean();
echo $html;
?>
