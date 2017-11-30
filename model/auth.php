<?php 
/**
 * Auth Model
 */
 
class auth_model extends DBconfig {
	
	public function __construct()
	  {
		$connection = new DBconfig();  // database connection
		$this->connection = $connection->connectToDatabase();
		$this->helper = new helper(); // calling helper class
	}
	  
	public function register($data) {
		$final_data = array();
		$keys = array_keys($data);
		foreach($keys as $key) {
				//mysqli_real_escape_string pour éviter les injections SQL
				$value = mysqli_real_escape_string($this->connection, $data[$key]);
				$final_data[$key] = $value;
			}
		$result = $this->helper->db_insert($final_data, "utilisateur");
		return $result;
	}
	
	public function update($data) {
		$final_data = array();
		$keys = array_keys($data);
		$SessionId = $_SESSION["easyphp_sessionid"];
		$resultRaw = $this->helper->db_select("user_id", "sessions", "WHERE sessionid='$SessionId'");
		$session_array = $resultRaw->fetch_assoc();
		$user_id = $session_array['user_id'];
		foreach($keys as $key) {
            //mysqli_real_escape_string pour éviter les injections SQL
				$value = mysqli_real_escape_string($this->connection, $data[$key]);
				$final_data[$key] = $value;
			}
		$result = $this->helper->db_update($final_data, "utilisateur", "WHERE email='$user_id'"); 
		return $result;
	}
	  
	public function checkifexists($where) {
		   $result = $this->helper->check("utilisateur", $where); 
		   return $result;
	}
	  
	public function login($email, $password, $remember="0") {
        //mysqli_real_escape_string pour éviter les injections SQL
		$email = mysqli_real_escape_string($this->connection, $email);	
		$password = mysqli_real_escape_string($this->connection, $password);
		$result = $this->checkifexists("WHERE email='$email' && mdp='$password'");
		if($result) { 
			$sessionid = substr(md5(microtime()),rand(0,26),15);
			$resultRaw = $this->helper->db_select("*", "utilisateur", "WHERE email='$email' && mdp='$password'");
			$result = $resultRaw->fetch_assoc();
			$data = array('sessionid' => $sessionid, 'user_id' => $result['email'], 'device' => $_SERVER['HTTP_USER_AGENT'], 'ip' => $_SERVER['REMOTE_ADDR']);
			$_SESSION["easyphp_sessionid"] = $sessionid;
			if($remember == "1") {
				$cookie_name = "projetvacatairesm1IMRMIAGE";
				$cookie_value = $sessionid;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			}
			$this->helper->db_insert($data, "sessions");
		}
		return $result;
	}
	  
	public function checksession($sessionid) {
		   $result = $this->helper->check("sessions", "WHERE sessionid='$sessionid' "); 
		   return $result;
	}
	
	public function userDetails() {
		$SessionId = $_SESSION["easyphp_sessionid"];
		$resultRaw = $this->helper->db_select("user_id", "sessions", "WHERE sessionid='$SessionId'");
		$session_array = $resultRaw->fetch_assoc();
		$user_id = $session_array['user_id'];
		$resultRaw = $this->helper->db_select("*", "utilisateur", "WHERE email='$user_id'");
		$result = $resultRaw->fetch_assoc();

		// récupérer le nom du poste de l'utilisateur
		$posteID = $result['poste'];
		$resultRaw = $this->helper->db_select("intituleposte", "utilisateur", "INNER JOIN poste ON utilisateur.poste = poste.idposte WHERE idposte='$posteID'")->fetch_assoc();
		$result['poste_name'] = $resultRaw['intituleposte'];	

		// récupérer la liste des profils qui peuvent être affichés par l'utilisateur
		// liste des profils vu par le Responsable de formation
		if ($result['poste_name'] === "Responsable Formation") {
			$userMail = $session_array['user_id'];
			$userFormationRaw = $this->helper->db_select("idformation", "formation", "WHERE responsable='$userMail'")->fetch_assoc();
			$userFormation = $userFormationRaw['idformation'];
			$resultRaw = mysqli_fetch_all($this->helper->db_select("DISTINCT cours.enseignant", "cours", "INNER JOIN matiere ON cours.idmatiere = matiere.idmatiere WHERE matiere.idformation='$userFormation'"));
			$result['userList'] = $resultRaw;
		}
		
		// liste des profils vu par le Responsable administratif
		if ($result['poste_name'] === "Responsable Administratif") {
			// TODO
		}

		// liste des profils vu par le Contrôle de gestion
		if ($result['poste_name'] === "Contrôle de Gestion") {
			// TODO
		}

		// liste des profils vu par le Responsable financier
		if ($result['poste_name'] === "Responsable Financier") {
			$resultRaw = mysqli_fetch_all($this->helper->db_select("email", "utilisateur", ""));
			$result['userList'] = $resultRaw;
		}

		return $result;
	}
	
	public function deleteSession() {	
		$SessionId = $_SESSION["easyphp_sessionid"];
		$result = $this->helper->db_delete("sessions", "WHERE sessionid='$SessionId'");
		$_SESSION['redirecturl'] = "";
		session_destroy();
		if(!isset($_SESSION["easyphp_sessionid"]) || $result) { 
			header("Location: ".$GLOBALS['ep_dynamic_url']."login");
			die();
		}
	}

	public function passwordreset($password, $tempid) {	
		$resultRaw = $this->helper->db_select("email", "utilisateur", "WHERE tempid='$tempid'");
		$user_array = $resultRaw->fetch_assoc();
		$user_id = $user_array['email'];
		$password = mysqli_real_escape_string($this->connection, $password);
		$tempid = mysqli_real_escape_string($this->connection, $tempid);
		$final_data = array('mdp' => $password, 'tempid' => "");
		$result = $this->helper->db_update($final_data, "utilisateur", "WHERE tempid='$tempid'");
		if($user_id) $result = true;		
		return $result;
	}
	
	public function updateForgotPassword($email) {
		//mysqli_real_escape_string pour éviter les injections SQL
		$value = mysqli_real_escape_string($this->connection, $email);
		$tempid = substr(md5(microtime()),rand(0,26),15);
		$data = array('tempid' => $tempid);
		$result = $this->helper->db_update($data, "utilisateur", "WHERE email='$value'"); 
		$resultRaw = $this->helper->db_select("prenom", "utilisateur", "WHERE email='$value'");
		$user_array = $resultRaw->fetch_assoc();
		$name = $user_array['prenom'];
		$baseurl = $GLOBALS['ep_base_url'];
		if($result) {
			$subject = "Mot de passe oublié";
			$body = "Bonjour $name, <br/> Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe - <br/> ".$baseurl."login/passwordreset/secret/$tempid <br/> Merci,";
			$alertmsg = "<span class='alert alert-success'> Votre demande a bien été prise en compte, s'il vous plaît, veuillez vérifier votre boîte mail pour plus de détails. </span>";
			$email = $email;
			$name = $name;
			$this->mail($subject, $body, $alertmsg, $email, $name); 
		}
		return $result;
	}
	
	public function mail($subject, $body, $alertmsg, $email, $name) {
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;  // Verbal debug
		$mail->isSMTP();        
		$mail->Mailer = $GLOBALS['Mailer'];        // Set mailer to use SMTP
		$mail->Host = $GLOBALS['ep_smpt_server'];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                    // Enable SMTP authentication
		$mail->Username = $GLOBALS['ep_smpt_username']; // SMTP username
		$mail->Password = $GLOBALS['ep_smpt_password']; // SMTP password
		$mail->SMTPSecure = $GLOBALS['SMTPSecure'];     // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $GLOBALS['ep_smpt_port'];         // TCP port to connect to

		$mail->setFrom($email, $GLOBALS['website_name']);
		$mail->addAddress($email, $name);     // Add a recipient

		$mail->isHTML(true);           // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $body;

		if(!$mail->send()) {
		    echo "<span class='alert alert-danger'>";
			echo 'Erreur email';
			echo $mail->ErrorInfo;
			echo "</span>";
		} else {
			echo $alertmsg;
		}
	}

}