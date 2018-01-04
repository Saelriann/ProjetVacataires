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
			array_pop($result);
			return $result;
	}

	public function alldata() {
		$et = $this->helper->db_select("email, nom, prenom", "utilisateur", "WHERE poste='2'");
		for($i = 0; $result[$i] = $et->fetch_assoc(); $i++) {
			$alldata['responsableFormation'][$i]['email']=$result[$i]['email'];
			$alldata['responsableFormation'][$i]['prenom'] = $result[$i]['prenom'];
			$alldata['responsableFormation'][$i]['nom'] = $result[$i]['nom'];
		}
		$st = $this->helper->db_select("email, nom, prenom", "utilisateur", "WHERE poste='3'");
		for($i = 0; $result[$i] = $st->fetch_assoc(); $i++) {
			$responsable = $et->fetch_assoc();
			$alldata['secretaireFormation'][$i]['email']=$result[$i]['email'];
			$alldata['secretaireFormation'][$i]['prenom'] = $result[$i]['prenom'];
			$alldata['secretaireFormation'][$i]['nom'] = $result[$i]['nom'];
		}

		return $alldata;
	}

	public function trainingDetailsById($id) {
			$resultRaw = $this->helper->db_select("*", "formation", "WHERE idformation='$id'");
			$trainingdata['id'] = $id;
			for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {
				$r = $result[$i]['responsable'];
				$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
				$responsable = $et->fetch_assoc();
				$trainingdata['responsableFormation']['email']=$r;
				$trainingdata['responsableFormation']['prenom'] = $responsable['prenom'];
				$trainingdata['responsableFormation']['nom'] = $responsable['nom'];

				$s = $result[$i]['secretaire'];
				$st = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$s'");
				$secretaire = $st->fetch_assoc();
				$trainingdata['secretaireFormation']['email']=$s;
				$trainingdata['secretaireFormation']['prenom'] = $secretaire['prenom'];
				$trainingdata['secretaireFormation']['nom'] = $secretaire['nom'];
			}
			return $trainingdata;
	}

	public function modify($data, $id) {
		$final_data = array();
		$keys = array_keys($data);
		foreach($keys as $key) {
			$value = mysqli_real_escape_string($this->connection, $data[$key]);
			$final_data[$key] = $value;
		}
		$result = $this->helper->db_update($final_data, "formation", "where idformation='$id'");
		return $result;
	}

}







