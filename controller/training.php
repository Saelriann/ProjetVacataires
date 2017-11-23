<?php
/**
 * Controleur des formations
 */

class training
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

}