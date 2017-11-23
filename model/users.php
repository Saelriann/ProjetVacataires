<?php 
/**
 * User Model
 */
 
class users_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	  }
	  
	public function getAllUsers() {
		$result = $this->helper->db_select("*", "utilisateur", "");
		return $result;
	}

	public function getAllUsersByPoste($poste) {
		$result = $this->helper->db_select("*", "utilisateur", "WHERE poste=$poste");
	}
	
	public function insertUser($data, $table) {
		$result = $this->helper->db_insert($data, $table);
		return $result;
	}
	
	public function updateUser($data, $table, $email) {
		$result = $this->helper->db_update($data, $table, "WHERE email='$email'");
		return $result;
	}
	
	public function getUserById($email) {		
		$resultRaw = $this->helper->db_select("*", "utilisateur", "WHERE email='$email'");
		$result = $resultRaw->fetch_assoc();
		return $result;
	}
	
	public function deleteUserById($email) {
		$result = $this->helper->db_delete("utilisateur", "WHERE email='$email'");
		return $result;
	}

}