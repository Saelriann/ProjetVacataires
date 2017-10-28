<?php
/**
 * Database Connector
 */
 
class DBconfig
{
    var $connection;
	
	public function __construct()
	{
		$this->hostname = $GLOBALS['ep_hostname'];
		$this->username = $GLOBALS['ep_username']; 
		$this->password = $GLOBALS['ep_password'];
		$this->database = $GLOBALS['ep_database'];
	}

    function connectToDatabase()
    {
		$connection = new mysqli($this->hostname,$this->username,$this->password,$this->database);
		
        if($connection->connect_errno > 0)
        {
            die ('<div class="alert alert-danger"> Connexion impossible à la base de données.</div>');
        }

        else
        {
            $this->connection = $connection;
        }

        return $this->connection;

    }

}