
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

		$result = $this->dontDouble($result);
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

	public function dontDouble($result) {
		for ($i=0; $i < count($result) ; $i++) { 
			for ($j=0; $j < count($result) ; $j++) { 
				if($j!=$i && $result[$i]['formation']!='supprimer' && 
					$result[$i]['matiere']==$result[$j]['matiere'] && 
					$result[$i]['datecours']==$result[$j]['datecours'] && 
					$result[$i]['heuredebutcours']==$result[$j]['heuredebutcours']  && 
					$result[$i]['heurefincours']==$result[$j]['heurefincours'] && 
					$result[$i]['heurefincours']==$result[$j]['heurefincours'] && 
					$result[$i]['enseignant'] == $result[$j]['enseignant']
				) {
					$result[$i]['formation'] = $result[$i]['formation'].' '.$result[$j]['formation'];
					if($result[$i]['niveau']!=$result[$j]['niveau'])$result[$i]['niveau'] = $result[$i]['niveau'].' '.$result[$j]['niveau'];
					$result[$j]['formation']='supprimer';
				}
			}
		}
		for ($i=0; $i < count($result) ; $i++) {
			if($result[$i]['formation']!='supprimer') {
				$final[$i]['formation'] = $result[$i]['formation'];
				$final[$i]['niveau'] = $result[$i]['niveau'];
				$final[$i]['datecours']=$result[$i]['datecours'];
				$final[$i]['heuredebutcours']=$result[$i]['heuredebutcours'];
				$final[$i]['heurefincours']=$result[$i]['heurefincours'];
				$final[$i]['type']=$result[$i]['type'];
				$final[$i]['enseignant']=$result[$i]['enseignant'];
				$final[$i]['matiere']=$result[$i]['matiere'];
				$final[$i]['salle']=$result[$i]['salle'];
				$final[$i]['batiment']=$result[$i]['batiment'];
			}

		}
		return $final;
	}

}
