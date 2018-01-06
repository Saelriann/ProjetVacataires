<?php
/**
 * Controleur des formations
 */

class training extends authcheck
{

    public function __construct()
    {
        $this->model = new training_model();
    }

    public function index()
    {
        $trainingdata = $this->model->trainingDetails();
        $data['trainingdata'] = $trainingdata;
        $data['ep_title'] = "Formations"; // Nom
        $data['view_page'] = "training/liste.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }
    public function modify($id) 
    {
        // securisation : pas possible de modifier si pas connecté, et pas admin compétent
        if (!isset(($_SESSION["easyphp_sessionid"])) || empty($_SESSION["easyphp_sessionid"]) || $_SESSION["poste"] == 1 || $_SESSION["poste"] == 5 ) header("Location: " . $GLOBALS['ep_dynamic_url']."dashboard");

        $trainingdata = $this->model->trainingDetailsById($id);
        $alldata = $this->model->alldata();
        if (!empty($_POST)) {
            $data['post'] = $_POST;
            $final_array = array();
            $keys = array_keys($_POST);
            foreach($keys as $key) {
                $value = strip_tags($_POST[$key]);
                $value = trim($value);
                $final_array[$key] = $value;
            }
            $data['result'] = $this->model->modify($final_array, $id);
            $trainingdata = $this->model->trainingDetailsById($id);
        }
     
        $data['trainingdata'] = $trainingdata;
        $data['alldata'] = $alldata;
        $data['ep_title'] = "Modifier une formation"; // Nom
        $data['view_page'] = "training/modify.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

}