<?php

require_once __DIR__ . '/../spring_autoload.php';

use \PDO;
use models\database\DataBaseConnection;

class Atelier
{
    
	public static function add($title, $dateAtelier, $description) {
		if($title == "") {
			return;
		}

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

	public static function update_title($id, $title) {
		if($title == "") {
			return;
		}

		$sql = 'UPDATE Atelier SET nomAtelier=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);

		$req->execute(array(
		    $title,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public static function update_description($id, $description) {
		$sql = 'UPDATE Atelier SET description=? WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
		    $description,
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}

	public static function get_all_ateliers() {
		$sql = 'SELECT * FROM Atelier';
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
		$sql = 'DELETE FROM Atelier WHERE idAtelier=?';
		$req = DataBaseConnection::prepare($sql);
		
		$req->execute(array(
			$id
		));

		$req->closeCursor(); /* Termine le traitement de la requête */
	}
}