<?php 
/**
 * Modèle pour les documents
 */
 
class doc_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}
	 
	public function documentDetails() {
			$resultRaw = $this->helper->db_select("*", "document", "");
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

	public function documentsByVacataire($vacataire) {
			$resultRaw = $this->helper->db_select("*", "document", "WHERE email='$vacataire'");
			for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {}
			return $result;
	}


	public function add($data) {
		$final_data = array();
		$keys = array_keys($data);
		foreach($keys as $key) {
			$value = mysqli_real_escape_string($this->connection, $data[$key]);
			$final_data[$key] = $value;
		}
		$result = $this->helper->db_insert($final_data, "document");

		return $result;
	}

}







