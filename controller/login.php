<?php
/**
 * Controleur du login permettant de se connecter
 */

class login
{

    public function __construct()
    {
        $this->model = new auth_model();
    }

    public function index()
    {
        if (isset($_SESSION["easyphp_sessionid"])) {
            $ifSessionExists = $this->model->checksession($_SESSION["easyphp_sessionid"]);
            if ($ifSessionExists) {
                header("Location: " . $GLOBALS['ep_dynamic_url'] . "dashboard");
                die();
            }
        } else if (isset($_COOKIE['projetvacatairesm1IMRMIAGE'])) {
            $ifCookieExists = $this->model->checksession($_COOKIE['projetvacatairesm1IMRMIAGE']);
            if ($ifCookieExists) {
                $_SESSION["easyphp_sessionid"] = $_COOKIE['projetvacatairesm1IMRMIAGE'];
                header("Location: " . $GLOBALS['ep_dynamic_url'] . "dashboard");
                die();
            }
        } else {
            $_SESSION["easyphp_sessionid"] = "";
        }
        if (isset($_GET['redirecturl'])) {
            $_SESSION['redirecturl'] = $_GET['redirecturl'];
        }
        if (!empty($_POST)) {
            $data['post'] = $_POST;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = $_POST['remember'];
            $email = strip_tags($email);
            $password = strip_tags($password);
            $remember = strip_tags($remember);
            $password = md5($password);
            $result = $this->model->login($email, $password, $remember);
            if ($result) {
                if (isset($_SESSION['redirecturl'])) {
                    header("Location: " . $_SESSION['redirecturl']);
                    die();
                } else {
                    header("Location: " . $GLOBALS['ep_dynamic_url'] . "dashboard");
                    die();
                }
            } else {
                $data['errors'] = array(array("L'adresse et le mot de passe ne fonctionnent pas. Veuillez réessayer."));
            }
        }
        $data['ep_title'] = "Connexion"; // nom de la page
        $data['view_page'] = "users/login.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
        return $data;
    }


    // Ces deux dernières fonctions sont en cours d'implémentation
    // Grâce à celles-ci, l'utilisateur pourra réinitialiser son mot de passe, le recevoir par mail et rechanger son mot de passe
    public function forgot()
    {
        if (!empty($_POST)) {
            $data['post'] = $_POST;
            // Validation faite grâce au plugin "Validator"
            $v = new Valitron\Validator($_POST);
            $v->rule('required', 'email');
            $v->rule('email', 'email');
            if ($v->validate()) {
                $value = strip_tags($_POST['email']);
                $value = trim($value);
                // fonction à implémenter : envoi d'un mail pour réinitialiser le mot de passe
                $data['result'] = $this->model->updateForgotPassword($value);
            } else {
                // Errors
                $data['errors'] = $v->errors();
            }
        }
        $data['ep_title'] = "Mot de passe oublié"; // titre de la page
        $data['view_page'] = "users/forgot.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête de page
        $data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
        return $data;
    }

    // fonction à implémenter : envoi d'un mail pour réinitialiser le mot de passe
    public function passwordreset($tempid)
    {
        if (!empty($_POST)) {
            $v = new Valitron\Validator($_POST);
            $v->rule('required', 'mdp');
            $v->rule('lengthMin', 'mdp', 6);
            $v->rule('regex', 'mdp', '/[^a-z_\-0-9]/i')->message('Le mot de passe doit être alphanumérique et doit contenir au moins un caractère spécial');
            $v->rule('equals', 'mdp', 'passwordverify')->message('Veuillez re-renseigner le mot de passe');
            if ($v->validate()) {
                $final_array = array();
                $keys = array_keys($_POST);
                foreach ($keys as $key) {
                    $value = strip_tags($_POST[$key]);
                    $value = trim($value);
                    if ($key != "passwordverify") {
                        $final_array[$key] = $value;
                    }
                    if ($key == "password") {
                        $final_array[$key] = md5($value);
                    }
                }
                $data['result'] = $this->model->passwordreset($final_array['password'], $tempid);
            } else {
                $data['errors'] = $v->errors();
            }
        }
		$data['tempid'] = $tempid;
		$data['ep_title'] = "Changement de mot de passe"; // nom de la page
		$data['view_page'] = "users/changepassword.php"; // controleur à afficher
		$data['ep_header'] = $GLOBALS['ep_header']; // entête de page
		$data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
		return $data;
	}


}