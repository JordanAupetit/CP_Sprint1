<?php
ob_start();  
require_once("config/config.php");
header("Location: " . BASE_URL . "controllers/controleur_atelier.class.php");
ob_end_flush();
?>
