<?php 
/**
 * Modèle pour les formations
 */
 
class training_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}
	 
	public function trainingDetails() {
			$resultRaw = $this->helper->db_select("*", "formation", "");
			for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {
				$r = $result[$i]['responsable'];
				$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
				$responsable = $et->fetch_assoc();
				$result[$i]['prenomResponsable'] = $responsable['prenom'];
				$result[$i]['nomResponsable'] = $responsable['nom'];

				$r = $result[$i]['secretaire'];
				$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
				$secretaire = $et->fetch_assoc();
				$result[$i]['prenomSecretaire'] = $secretaire['prenom'];
				$result[$i]['nomSecretaire'] = $secretaire['nom'];
			}
			return $result;
	}
}







