<?php 
/**
 * Modèle pour les rémunérations
 */
 
class pay_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}
	 
	public function remunerationDetails() {
			$resultRaw = $this->helper->db_select("*", "remuneration", "");
			for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {
				$r = $result[$i]['email'];
				$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
				$responsable = $et->fetch_assoc();
				$result[$i]['prenom'] = $responsable['prenom'];
				$result[$i]['nom'] = $responsable['nom'];

			}
			array_pop($result);
			return $result;
	}

	public function remunerationDetailsByVacataire($vacataire) {
			$resultRaw = $this->helper->db_select("*", "remuneration", "WHERE email='$vacataire'");
			for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) 
			return $result;
	}


	public function listesDeroulantes() {
		$resultRaw = $this->helper->db_select("*", "utilisateur", "WHERE poste=1");
		for ($i=0; $i < $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			$final['vacataire'][$i]['email'] = $result[$i]['email'];
			$final['vacataire'][$i]['prenom'] = $result[$i]['prenom'];
			$final['vacataire'][$i]['nom'] = $result[$i]['nom'];
		}
		return $final;
	}


	public function add($data) {
		var_dump($data);
		$final_data = array();
		$keys = array_keys($data);
		foreach($keys as $key) {
			$value = mysqli_real_escape_string($this->connection, $data[$key]);
			$final_data[$key] = $value;
		}
		$result = $this->helper->db_insert($final_data, "remuneration");
		return $result;
	}

}







