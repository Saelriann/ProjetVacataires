<?php 
/**
 * Model
 */
 
class home_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();
		$this->connection = $connection->connectToDatabase();
	  }
}