
<?php 
/**
 * Modèle pour les cours
 */
 
class course_model extends DBconfig {
	
	public function __construct()
	{
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}

		public function traitementAffichage($where) {
		$resultRaw = $this->helper->db_select("*", "cours", "$where");
		for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			// traitement enseignant
			$r = $result[$i]['enseignant'];
			$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
			$enseignant = $et->fetch_assoc();
			$result[$i]['enseignant'] = $enseignant['prenom'].' '.$enseignant['nom'];

			// traitement matiere
			$m = $result[$i]['idmatiere'];
			$et = $this->helper->db_select("intitulematiere, idniveau, idformation", "matiere", "WHERE idmatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			$result[$i]['formation'] = $arraytemp['idformation'];

			// niveau
			$n =  $arraytemp['idniveau'];
			$et = $this->helper->db_select("nomniveau", "niveau","WHERE idniveau='$n'");
			$temp = $et->fetch_assoc();
			$result[$i]['niveau'] = $temp['nomniveau'];

			// matiere
			$m = $arraytemp['intitulematiere'];
			$et = $this->helper->db_select("intitulematiere", "nommatiere", "WHERE idnommatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			$result[$i]['matiere'] = $arraytemp['intitulematiere'];

			// traitement salle  
			$s = $result[$i]['idsalle'];
			$et = $this->helper->db_select("numerosalle, idbatiment", "salle", "WHERE idsalle='$s'");
			$temp = $et->fetch_assoc();
			$result[$i]['salle']  =  $temp['numerosalle'];  
			// batiment
			$b = $temp['idbatiment'];
			$et = $this->helper->db_select("codebatiment, libellebatiment", "batiment", "WHERE idbatiment='$b'");
			$temp = $et->fetch_assoc();
			$result[$i]['batiment'] = $temp['codebatiment'].'('.$temp['libellebatiment'].')';

			// traitement horaire
			$result[$i]['datecours'] = $this->helper->dateen2fr($result[$i]['datecours']);

			// traitement type
			$t = $result[$i]['idtype'];
			$et = $this->helper->db_select("libelletype", "type", "WHERE idtype='$t'");
			$result[$i]['type'] = $et->fetch_assoc();
			$result[$i]['type'] = $result[$i]['type']['libelletype'];
		}
		// à régler : la dernière valeur est ajouté automatiquement en tant que "null"
		array_pop($result);
		
		return $result;
	}

	 
	public function courseDetails() {
		return $this->traitementAffichage("");
	}

	public function courseDetailsByTraining($formation) {
		return $this->traitementAffichage("WHERE idformation=$formation");

	}

	public function courseDetailsByTrainor($enseignant) {
		return $this->traitementAffichage("WHERE enseignant='$enseignant'");
	}


}









