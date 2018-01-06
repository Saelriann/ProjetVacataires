<?php
/**
 * Controleur des paiements
 */

class pay extends authcheck
{

    public function __construct()
    {
        $this->model = new pay_model();
    }

    public function index()
    {
        $data['ep_title'] = "Paiements"; // Nom
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        
        if (!isset(($_SESSION["easyphp_sessionid"])) || empty($_SESSION["easyphp_sessionid"]) ) header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");
        if ($_SESSION["poste"] == 1 ) {
            header("Location: " . $GLOBALS['ep_dynamic_url']."pay/mesPaiements");
        } 
        if ($_SESSION["poste"] == 2 || $_SESSION["poste"] == 3 ) {
            header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");
        }
        else {
            $data['view_page'] = "pay/liste.php"; // controleur à afficher 
            $paydata = $this->model->remunerationDetails();
            $data['paydata'] = $paydata;

            if (!empty($paydata)) {
                for ($i=0; $i < sizeof($data['paydata']) ; $i++) { 
                    $data['paydata'][$i]['dateremuneration'] = $this->model->helper->dateen2fr($data['paydata'][$i]['dateremuneration']);
                }
            }
        }
        return $data;
    }

    public function mesPaiements() 
    {
        if(isset($_SESSION['email'])) {
            $paydata = $this->model->remunerationDetailsByVacataire($_SESSION['email']);
            if($paydata != NULL ) {
                $data['paydata'] = $paydata;
                for ($i=0; $i < sizeof($data['paydata']) ; $i++) { 
                    $data['paydata'][$i]['dateremuneration'] = $this->model->helper->dateen2fr($data['paydata'][$i]['dateremuneration']);
                }
            } else {
                $data['errors'] = "Aucun paiement.";
            }
            $data['ep_title'] = "Paiement"; // Nom
            $data['view_page'] = "pay/mesRemunerations.php"; // controleur à afficher
            $data['ep_header'] = $GLOBALS['ep_header']; // entête
            $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        } else {
            $data['errors'] = "Veuillez vous connecter";
        }
        return $data;
    }

    public function add() {
         if (!isset(($_SESSION["easyphp_sessionid"])) || empty($_SESSION["easyphp_sessionid"]) ) header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");
        if ($_SESSION["poste"] == 4 || $_SESSION["poste"] == 5 ) {
            $data['ep_title'] = "Ajouter un paiement"; // Nom
            $data['view_page'] = "pay/add.php"; // controleur à afficher 
            $paydata = $this->model->listesDeroulantes();
            $data['paydata'] = $paydata;
        } else {
            header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");
        }
        if (!empty($_POST)) {
            $data['post'] = $_POST;
            $final_array = array();
            $keys = array_keys($_POST);
            foreach($keys as $key) {
                $value = strip_tags($_POST[$key]);
                $value = trim($value);
                $final_array[$key] = $value;
            }
            $data['result'] = $this->model->add($final_array);
        }
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

}