<?php 
require_once("../config/config.php");
require_once __DIR__ . '/../spring_autoload.php';

use models\atelier;

$data = is_array($_POST) ? $_POST : array();

$action = isset($_GET['a']) ? $_GET['a'] : "";

$titre="";
$c="";

$squelette = BASE_FILE . "views\\Ateliers\\view_atelier.html.php";

switch($action) {
  
 /* afficher un atelier */
 case "afficher" : 
  
    break;
  /* ajouter un nouvel atelier */
 case "ajouter" : 
  
    break;

 /* modifier un un atelier */
 case "modifier" : 
    $titre = "Modifier un atelier";
  
   
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
   $titre = "Ateliers";
   
   

   foreach (Atelier::get_all_ateliers() as $line) {//mettre les méthodes en statique?
    
       $c .= $line;
    }
   


}

ob_start();
require_once($squelette);
$html = ob_get_contents();
ob_end_clean();
echo $html;
?>
