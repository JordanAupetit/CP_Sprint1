<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

require_once __DIR__ . '/../sprint_autoload.php';

use \PDO;
use models\database\DataBaseConnection;

class Atelier
{
	public static function add($atelier) {
		$title = $atelier->getNomAtelier();
		$dateAtelier = $atelier->getDateAtelier();
		$description = $atelier->getDescription();


		if($title == "") {
			//return;
		}

		$sql = 'INSERT INTO atelier(nomAtelier, dateAtelier, description, inscription, labo_idlabo) 
				VALUES(:nomAtelier, :dateAtelier, :description, :inscription, :labo_idlabo)';

		try {

			$req = DataBaseConnection::prepare($sql);
			
			$req->execute(array(
			    'nomAtelier' => $title,
			    'dateAtelier' => $dateAtelier,
			    'description' => $description,
			    'inscription' => true,
			    'labo_idlabo' => 1 // Temporaire
			));

			$req->closeCursor();
		}
		catch(Exception $e)
		{
			die('Erreur :' .$e->getMessage());
		}
	}

	public static function update_title($id, $title) {
		if($title == "") {
			return;
		}

		$sql = 'UPDATE atelier SET nomAtelier=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);

		$req->execute(array(
		    $title,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public static function update_description($id, $description) {
		$sql = 'UPDATE atelier SET description=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
		    $description,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public static function get_all_ateliers() {
		$sql = 'SELECT * FROM atelier';
		$req = DataBaseConnection::prepare($sql);
		$result = array();

		while($rep = $req->fetch()){
			$obj = (object) [	
				'idLabo' => $rep[0],
				'courrielLabo' => $rep[1],
				'nomLabo' => $rep[2],
				'pwd' => $rep[3],
				'sel' => $rep[4]
			];

			$result[] = $obj;
		}

		return $result; // Peut être vide
	}

	public static function remove($id) {
		$sql = 'DELETE FROM atelier WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}
}