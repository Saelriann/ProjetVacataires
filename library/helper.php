<?php 
/**
 * Helper page
 */
 
 class helper extends DBconfig {
	 
	 public function __construct()
	{
		$connection = new DBconfig();
		$this->connection = $connection->connectToDatabase();
	}
	
	public function db_insert($array, $tbname) {
		$array_keys = array_keys($array);
		$array_keys = implode(", ", $array_keys);
		$array_values = implode("','", $array);
		$array_values = "'".$array_values."'";
		$query = "INSERT INTO $tbname ($array_keys) VALUES ($array_values)";
		if (mysqli_query($this->connection, $query)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function db_select($select, $tbname, $filter="") {
		$query = "SELECT $select FROM $tbname $filter";
		$result = $this->connection->query($query);
		return $result;
	}
	
	public function db_update($array, $tbname, $where) {
		$keys = array_keys($array);
		$set = array();
		foreach($keys as $key) {
			$set[] = "$key = '$array[$key]' ";
		}
		$set = implode(", ", $set);
		$query = "UPDATE $tbname SET $set $where";
		if (mysqli_query($this->connection, $query)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function db_delete($tbname, $where) {
		$query = "DELETE FROM $tbname $where";
		if (mysqli_query($this->connection, $query)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function check($tbname, $where) {
		$query = "SELECT * FROM $tbname $where";
		$query_result = mysqli_query($this->connection, $query);
		if (mysqli_num_rows($query_result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function verifyDate($date) { //fr to en if needed but i don't think so
        $validation = DateTime::createFromFormat('d/m/Y', $date);
        if ($validation) {
            $arr = explode("/", $date);
            if (checkdate($arr[1], $arr[0], $arr[2])) {
                $dateF = implode("-", array_reverse($arr));
                return $dateF;
            }
        }
        return null;
    }

    public function dateen2fr($date) { // affichage d'une date au format français
        $date = explode("-", $date);
        return implode("/", array_reverse($date));
    }
 }