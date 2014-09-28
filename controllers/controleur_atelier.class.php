<?php 
require_once("../config/config.php");
require_once("../models/atelier.class.php");
require_once("../models/AtelierConstruct.class.php");
require_once("../models/AtelierAffichage.class.php");
require_once("../models/AtelierForm.class.php");
require_once("../models/AtelierDetails.class.php");

$data = is_array($_POST) ? $_POST : array();

$action = isset($_GET['a']) ? $_GET['a'] : "";

$titre="";
$c="";

//$squelette = "..\\views\\Ateliers\\view_atelier.html.php";
$squelette = "../views/Ateliers/view_atelier.html.php";

function affichageAtelier($atelier, &$c) {
  $ui = new AtelierAffichage($atelier);
  $c .= "<a href=\"controleur_atelier.class.php?a=ajouter\">Ajouter un atelier</a>";

  foreach (Atelier::get_all_ateliers() as $line) {
    $atelier = AtelierConstruct::initialize($line);
    $ui = new AtelierAffichage($atelier);
    $c .= $ui->makeHtml();
  }
}

switch($action) {
  
 /* afficher un atelier */
 case "afficher" : 
  $titre = "Atelier";
   
   if (isset($_GET['id'])) {
     $id = $_GET['id'];
     
     $at = Atelier::get_atelier($id);
     $atelier = AtelierConstruct::initialize($at);
     $details = new AtelierDetails($atelier);
     $c = $details->makeDetail();
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

    $atelier = AtelierConstruct::initialize();
	$form = new AtelierForm($atelier);
    $c = $form->makeForm(PUBLIC_URL."controleur_atelier.class.php?a=enregistrernouveau", "ajouter");
    
    break;

 /* modifier un un atelier */
 case "modifier" : 
    $titre = "Modifier un atelier";
   
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $atelier = Atelier::get_atelier($id); //a implementer
    $form = new AtelierForm($atelier);
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
   affichageAtelier($atelier, $c);
   
   break;

case "enregistrermodif":
  $titre = "Atelier enregistr&eacute;";
  //$atelier = Atelier::lire($data['id']);
  $atelier->update($data);
  $form = new AtelierForm($atelier);

  Atelier::update_title($atelier);
	Atelier::update_description($atelier);
  affichageAtelier($atelier, $c);
  break; 

 /* supprimer un atelier */
 case "supprimer":
   $titre = "Atelier supprim&eacute;";

  if (isset($_GET['id'])) {
    $c=Atelier::remove($_GET['id']);
  } else {
    $titre = "Pas d'identifiant - suppression impossible";
  }
  $atelier = AtelierConstruct::initialize("");
  affichageAtelier($atelier, $c);
   break;

 default:
	defaultlabel:
   $titre = "Ateliers";
   $atelier = AtelierConstruct::initialize("");
   affichageAtelier($atelier, $c);

}

ob_start();
require_once($squelette);
$html = ob_get_contents();
ob_end_clean();
echo $html;
?>
