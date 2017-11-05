<?php 
/**
 * Register Controller
 */
 
class register {
	
	public function __construct()
	  {
			$this->model = new auth_model(); 
	  }
	  
	public function index() {
		if(isset($_SESSION["easyphp_sessionid"])) {
			$ifSessionExists = $this->model->checksession($_SESSION["easyphp_sessionid"]);
			if($ifSessionExists) {
				header("Location: ".$GLOBALS['ep_dynamic_url']."dashboard");
				die();
			}
		}
		if(isset($_GET['redirecturl'])) {
			$_SESSION['redirecturl'] = $_GET['redirecturl'];
		}
		if (!empty($_POST)) {
			$data['post'] = $_POST; 
			// Validation grâce au module Valitron
			$v = new Valitron\Validator($_POST);
			$v->rule('required', 'mdp');
			$v->rule('lengthMin', 'mdp', 6);
			$v->rule('regex', 'mdp', '/[^a-z_\-0-9]/i')->message('Le mot de passe doit être alphanumérique et doit contenir au moins un caractère spécial');
			$v->rule('equals', 'mdp', 'passwordverify')->message('Veuillez re-renseigner le mot de passe');
			$v->rule('required', 'email');
			$v->rule('email', 'email');
            $v->rule('required', 'nom');
            $v->rule('lengthMin', 'nom', 3);
            $v->rule('required', 'prenom');
            $v->rule('lengthMin', 'prenom', 3);
			$v->rule('required', 'datenaissance');
			$email_exists = $this->checkDuplicateEmail($_POST['email']);
			if($v->validate() && !$email_exists) {
				$final_array = array();
				$keys = array_keys($_POST);
				foreach($keys as $key) {
					$value = strip_tags($_POST[$key]);
					$value = trim($value);
					if($key != "passwordverify") {
						$final_array[$key] = $value;
					}
					if($key == "mdp") {
						$final_array[$key] = md5($value);
					}
				}
				$data['result'] = $this->model->register($final_array);
			} else {
				// Erreurs éventuelles
				$errors = array();
				$errors_email = array();
				if($email_exists) {
					$errors_email = array(array("Cette adresse email existe déjà."));
				}
				$errors = $v->errors();
				$data['errors'] = array_merge($errors,$errors_email);
			}
		}
		$data['ep_title'] = "Enregistrement"; // nom de la page
		$data['view_page'] = "users/register.php"; // controleur à afficher
		$data['ep_header'] = "header.php"; // entête
		$data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
		return $data;
	}  

	public function checkDuplicateEmail($email) {
		$result = $this->model->checkifexists("WHERE email='$email'");
		return $result;
	}
}
	