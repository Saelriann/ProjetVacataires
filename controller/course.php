<?php
/**
 * Controleur des cours
 */

class course
{

    public function __construct()
    {
        $this->model = new course_model();
    }

    public function index()
    {
        $coursedata = $this->model->courseDetails();
        $data['coursedata'] = $coursedata;
        $data['ep_title'] = "Cours"; // Nom
        $data['view_page'] = "courses/liste.php"; // controleur à afficher
        $data['ep_header'] = $GLOBALS['ep_header']; // entête
        $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        return $data;
    }

}