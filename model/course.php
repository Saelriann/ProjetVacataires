
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
	 
	public function courseDetails() {
		$resultRaw = $this->helper->db_select("*", "cours", "");
		for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {

			// traitement enseignant
			$r = $result[$i]['enseignant'];
			$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
			$enseignant = $et->fetch_assoc();
			$result[$i]['enseignant'] = $enseignant['prenom'].' '.$enseignant['nom'];

			// traitement matiere
			$m = $result[$i]['idmatiere'];
			$et = $this->helper->db_select("intitulematiere, idniveau", "matiere", "WHERE idmatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			
			// niveau
			$n =  $arraytemp['idniveau'];
			$et = $this->helper->db_select("nomniveau", "niveau","WHERE idniveau='$n'");
			$temp = $et->fetch_assoc();
			$niveau[$i] = $temp['nomniveau'];

			// matiere
			$m = $arraytemp['intitulematiere'];
			$et = $this->helper->db_select("intitulematiere", "nommatiere", "WHERE idnommatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			$matiere[$i] = $arraytemp['intitulematiere'];

			$result[$i]['matiere'] = $matiere[$i].' ('.$niveau[$i].')';

			// traitement salle  
			$s = $result[$i]['idsalle'];
			$et = $this->helper->db_select("numerosalle, idbatiment", "salle", "WHERE idsalle='$s'");
			$temp = $et->fetch_assoc();
			$salle[$i] =  $temp['numerosalle'];  
			// batiment
			$b = $temp['idbatiment'];
			$et = $this->helper->db_select("codebatiment, libellebatiment", "batiment", "WHERE idbatiment='$b'");
			$temp = $et->fetch_assoc();
			$batiment[$i] = $temp['codebatiment'].' '.$temp['libellebatiment'];

			$result[$i]['salle'] = $salle[$i].' '.$batiment[$i];

			// traitement horaire
			$result[$i]['datecours'] = $this->helper->dateen2fr($result[$i]['datecours']);
			$result[$i]['horaire'] = $result[$i]['datecours'].' ~ '.$result[$i]['heuredebutcours'].' - '.$result[$i]['heurefincours'];

			// traitement type
			$t = $result[$i]['idtype'];
			$et = $this->helper->db_select("libelletype", "type", "WHERE idtype='$t'");
			$result[$i]['type'] = $et->fetch_assoc();
			$result[$i]['type'] = $result[$i]['type']['libelletype'];
		}
		return $result;
	}

	public function courseDetailsBy($formation) {
		$resultRaw = $this->helper->db_select("*", "cours", "WHERE idformation=$formation");
		for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {

			// traitement enseignant
			$r = $result[$i]['enseignant'];
			$et = $this->helper->db_select("nom, prenom", "utilisateur", "WHERE email='$r'");
			$enseignant = $et->fetch_assoc();
			$result[$i]['enseignant'] = $enseignant['prenom'].' '.$enseignant['nom'];

			// traitement matiere
			$m = $result[$i]['idmatiere'];
			$et = $this->helper->db_select("intitulematiere, idniveau", "matiere", "WHERE idmatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			
			// niveau
			$n =  $arraytemp['idniveau'];
			$et = $this->helper->db_select("nomniveau", "niveau","WHERE idniveau='$n'");
			$temp = $et->fetch_assoc();
			$niveau[$i] = $temp['nomniveau'];

			// matiere
			$m = $arraytemp['intitulematiere'];
			$et = $this->helper->db_select("intitulematiere", "nommatiere", "WHERE idnommatiere='$m'");
			$arraytemp = $et->fetch_assoc();
			$matiere[$i] = $arraytemp['intitulematiere'];

			$result[$i]['matiere'] = $matiere[$i].' ('.$niveau[$i].')';

			// traitement salle  
			$s = $result[$i]['idsalle'];
			$et = $this->helper->db_select("numerosalle, idbatiment", "salle", "WHERE idsalle='$s'");
			$temp = $et->fetch_assoc();
			$salle[$i] =  $temp['numerosalle'];  
			// batiment
			$b = $temp['idbatiment'];
			$et = $this->helper->db_select("codebatiment, libellebatiment", "batiment", "WHERE idbatiment='$b'");
			$temp = $et->fetch_assoc();
			$batiment[$i] = $temp['codebatiment'].' '.$temp['libellebatiment'];

			$result[$i]['salle'] = $salle[$i].' '.$batiment[$i];

			// traitement horaire
			$result[$i]['datecours'] = $this->helper->dateen2fr($result[$i]['datecours']);
			$result[$i]['horaire'] = $result[$i]['datecours'].' ~ '.$result[$i]['heuredebutcours'].' - '.$result[$i]['heurefincours'];

			// traitement type
			$t = $result[$i]['idtype'];
			$et = $this->helper->db_select("libelletype", "type", "WHERE idtype='$t'");
			$result[$i]['type'] = $et->fetch_assoc();
			$result[$i]['type'] = $result[$i]['type']['libelletype'];
		}
		return $result;

	}
}









