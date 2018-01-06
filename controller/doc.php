<?php
/**
 * Controleur des documents
 */

class doc extends authcheck
{

    public function __construct()
    {
        $this->model = new doc_model();
    }

    public function index()
    {
        $data['ep_title'] = "Documents"; // Nom   
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page

        if (!isset(($_SESSION["easyphp_sessionid"])) || empty($_SESSION["easyphp_sessionid"]) ) header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");
        if ($_SESSION["poste"] == 1 || $_SESSION["poste"] == 2 ) {
            header("Location: " . $GLOBALS['ep_dynamic_url']."doc/mesDocs");
        }
        else {
            $docdata = $this->model->documentDetails();
            $data['docdata'] = $docdata;
            $data['view_page'] = "doc/liste.php"; // controleur à afficher 
        }
        return $data;
    }

    public function add() 
    {
        // on ajoute que si on est connecté et qu'on est vacataire
        if (!isset(($_SESSION["easyphp_sessionid"])) || empty($_SESSION["easyphp_sessionid"]) || $_SESSION["poste"] != 1 ) header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");

        // 
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
        $data['ep_title'] = "Ajouter un document"; // Nom
        $data['view_page'] = "doc/add.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

    public function mesDocs() 
    {
        if(isset($_SESSION['email'])) {
            $docdata = $this->model->documentsByVacataire($_SESSION['email']);
            if($docdata != NULL ) {
                $data['docdata'] = $docdata;
            } else {
                $data['errors'] = "Aucun document.";
            }
            $data['ep_title'] = "Mes documents"; // Nom
            $data['view_page'] = "doc/mesDocs.php"; // controleur à afficher
            $data['ep_header'] = $GLOBALS['ep_header']; // entête
            $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        } else {
            $data['errors'] = "Veuillez vous connecter";
        }
        return $data;
    }

}