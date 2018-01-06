<?php
/**
 * Controleur des matières
 */

class major extends authcheck
{

    public function __construct()
    {
        $this->model = new major_model();
    }

    public function index()
    {
        $majordata = $this->model->majorDetails();
        $data['majordata'] = $majordata;
        $data['ep_title'] = "Major"; // Nom
        $data['view_page'] = "major/liste.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

}