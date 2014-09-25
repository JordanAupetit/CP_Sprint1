<?php

require_once __DIR__ . '/../sprint_autoload.php';

use \PDO;
use models\database\DataBaseConnection;

class Atelier
{

	public function add($title, $dateAtelier, $description) {

		if($title == "") {
			return;
		}

		$title = addslashes($title); /* sécurisation */
		$dateAtelier = addslashes($dateAtelier);
		$description = addslashes($description);

		$sql = 'INSERT INTO Atelier(nomAtelier, dateAtelier, description, inscription, labo_idlabo) 
				VALUES(:nomAtelier, :dateAtelier, :description, :inscription, :labo_idlabo)';
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

	public function update_title($id, $title) {
		if($title == "") {
			return;
		}

		$title = addslashes($title); /* sécurisation */

		$sql = 'UPDATE Atelier SET nomAtelier=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);

		$req->execute(array(
		    $title,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public function update_description($id, $description) {
		$description = addslashes($description); /* sécurisation */

		$sql = 'UPDATE Atelier SET description=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
		    $description,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public function get_all_ateliers() {
		$sql = 'SELECT * FROM Atelier';
		$req = DataBaseConnection::prepare($sql);
		$result = array();

		while($rep = $req->fetch()){
			$result[] = $rep;
		}

		return $result; // Peut être vide
	}

	public function remove($id) {
		$sql = 'DELETE FROM Atelier WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}
}