<?php
/**
 * Controleur du dashboard
 */

class dashboard extends authcheck
{

    public function __construct()
    {
        $this->model = new auth_model();
        $this->authcheck = new authcheck(); // vérifie si l'id de l'utilsateur de la session existe
        $this->SessionId = $_SESSION["easyphp_sessionid"]; // id de la session
    }

    public function index()
    {
        $userdata = $this->model->userDetails();
        $data['userdata'] = $userdata;
        $data['userdata']['datenaissance'] = $this->model->helper->dateen2fr($data['userdata']['datenaissance']);
        $data['ep_title'] = "Dashboard"; // Nom
        $data['view_page'] = "users/dashboard.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

    public function settings()
    {
        $userdata = $this->model->userDetails();
        if (!empty($_POST)) {
            $userdata = $_POST;
            $v = new Valitron\Validator($_POST);
            $v->rule('required', 'nom');
            $v->rule('lengthMin', 'nom', 3);
            $v->rule('required', 'prenom');
            $v->rule('lengthMin', 'prenom', 3);
            $v->rule('required', 'datenaissance');
            if ($v->validate()) {
                $final_array = array();
                $keys = array_keys($_POST);
                foreach ($keys as $key) {
                    $value = strip_tags($_POST[$key]);
                    $value = trim($value);
                    if ($key != "mdp" && $key != "email") {
                        $final_array[$key] = $value;
                    }
                }
                $data['result'] = $this->model->update($final_array, "utilisateur");
            } else {
                // Errors
                $data['errors'] = $v->errors();
            }
        }
        $data['userdata'] = $userdata;
        $data['ep_title'] = "Paramètres"; // nom de la page
        $data['view_page'] = "users/settings.php"; // vue du controleur
        $data['ep_header'] = $GLOBALS['ep_header']; // entête de page
        $data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
        return $data;
    }

    public function password()
    {
        $userdata = $this->model->userDetails();
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
                        $final_array[$key] = md5($value);
                    }
                }
                $data['result'] = $this->model->update($final_array, "utilisateur");
            } else {
                // Errors
                $data['errors'] = $v->errors();
            }
        }

        $data['userdata'] = $userdata;
        $data['ep_title'] = "Changement de mot de passe"; // Nom de la page
        $data['view_page'] = "users/password.php"; // Vue du controleur
        $data['ep_header'] = $GLOBALS['ep_header']; // entête de page
        $data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page
        return $data;
    }

    public function checkDuplicateEmail($email)
    {
        $userdata = $this->model->userDetails();
        $user_id = $userdata['id'];
        $ownval = $this->model->checkifexists("WHERE email='$email' && id='$user_id'");
        if (!$ownval) {
            $result = $this->model->checkifexists("WHERE email='$email'");
        } else {
            $result = false;
        }
        return $result;
    }

    public function logout()
    {
        $this->model->deleteSession();
        $data['ep_title'] = "Logout";
        $data['view_page'] = "false";
        $data['ep_header'] = "false";
        $data['ep_footer'] = "false";
    }

}