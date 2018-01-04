
<?php 
/**
 * Modèle pour l'enregistrement des cours
 */
 
class registercourse_model extends DBconfig {
	
	public function __construct()
	{
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}

	public function listesDeroulantes() {
		$resultRaw = $this->helper->db_select("*", "utilisateur", "WHERE poste=1");
		for ($i=0; $i < $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			$final['enseignant'][$i]['email'] = $result[$i]['email'];
			$final['enseignant'][$i]['prenom'] = $result[$i]['prenom'];
			$final['enseignant'][$i]['nom'] = $result[$i]['nom'];
		}

		$resultRaw = $this->helper->db_select("*", "matiere", "");
		for ($i=0; $i < $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			// nom matiere
			$m = $result[$i]['intitulematiere'];
			$et = $this->helper->db_select("intitulematiere", "nommatiere", "WHERE idnommatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			$result[$i]['intitulematiere'] = $arraytemp['intitulematiere'];
			// niveau
			$n = $result[$i]['idniveau'];
			$et = $this->helper->db_select("nomniveau", "niveau","WHERE idniveau='$n'");
			$temp = $et->fetch_assoc();
			$result[$i]['idniveau'] = $temp['nomniveau'];

			$final['matiere'][$i]['idmatiere'] = $result[$i]['idmatiere'];
			$final['matiere'][$i]['intitulematiere'] = $result[$i]['intitulematiere'];
			$final['matiere'][$i]['idniveau'] = $result[$i]['idniveau'];
			$final['matiere'][$i]['idformation'] = $result[$i]['idformation'];
		}

		$resultRaw = $this->helper->db_select("*", "salle", "");
		for ($i=0; $i < $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			$b = $result[$i]['idbatiment'];
			$et = $this->helper->db_select("codebatiment, libellebatiment", "batiment", "WHERE idbatiment='$b'");
			$arraytemp = $et->fetch_assoc();

			$final['numerosalle'][$i]['idsalle'] = $result[$i]['idsalle'];
			$final['numerosalle'][$i]['codebatiment'] = $arraytemp['codebatiment'];
			$final['numerosalle'][$i]['libellebatiment'] = $arraytemp['libellebatiment'];
			$final['numerosalle'][$i]['numerosalle'] = $result[$i]['numerosalle'];
		}

		$resultRaw = $this->helper->db_select("*", "type", "");
		for ($i=0; $i < $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			$final['type'][$i]['idtype'] = $result[$i]['idtype'];
			$final['type'][$i]['libelletype'] = $result[$i]['libelletype'];
		}

		return $final;
	}

	public function register($data) {
		$final_data = array();
		$keys = array_keys($data);
		foreach($keys as $key) {
			$value = mysqli_real_escape_string($this->connection, $data[$key]);
			$final_data[$key] = $value;
		}
		$result = $this->helper->db_insert($final_data, "cours");
		return $result;
	}
	

}
