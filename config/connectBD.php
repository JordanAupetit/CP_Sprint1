<?php

	$sgbd='mysql';
	$host='dbserver';
	$utilisateur=''; // Mettez vos identifiants <<<<
	$motDePasse='';	 // Mettez vos identifiants <<<<
	$nomBase='';	 // Mettez vos identifiants <<<<
	$dns=$sgbd.':host='.$host.';dbname='.$nomBase;

	//Tentative de connexion au serveur
	try
	{
		$connexion=new PDO($dns,$utilisateur,$motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	}
	
	catch(Exception $e)
	{
		die('Erreur :' .$e->getMessage());
	}
