
<?php 
/**
 * Modèle pour les matières
 */
 
class major_model extends DBconfig {
	
	public function __construct()
	{
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}

		public function traitementMatiere($where) {
			//group by idformation, idniveau
		$resultRaw = $this->helper->db_select("*", "matiere", "$where");
		for($i = 0; $result[$i] = $resultRaw->fetch_assoc(); $i++) {
			$result[$i]['nomformation'] = $result[$i]['idformation'];

			$n =  $result[$i]['idniveau'];
			$et = $this->helper->db_select("nomniveau", "niveau","WHERE idniveau='$n'");
			$temp = $et->fetch_assoc();
			$result[$i]['niveau'] = $temp['nomniveau'];
			

			$m =  $result[$i]['intitulematiere'];
			$et = $this->helper->db_select("intitulematiere", "nommatiere","WHERE idnommatiere='$m'");
			$temp = $et->fetch_assoc();
			$result[$i]['intitulematiere'] = $temp['intitulematiere'];
		}
		return $result;
	}

	 
	public function majorDetails() {
		return $this->traitementMatiere("order by idformation, idniveau");
	}

	public function majorDetailsByTrainingAndLevel($formation, $niveau) {
		return $this->traitementMatiere("WHERE idformation=$formation AND idniveau=$niveau");

	}

}









