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

    public function mesCours() 
    {
        if(isset($_SESSION['email'])) {
            $coursedata = $this->model->courseDetailsByTrainor($_SESSION['email']);
            if($coursedata[0] != NULL ) {
                $data['coursedata'] = $coursedata;
            } else {
                $data['errors'] = "Aucun cours.";
            }
            $data['ep_title'] = "Cours"; // Nom
            $data['view_page'] = "courses/mesCours.php"; // controleur à afficher
            $data['ep_header'] = $GLOBALS['ep_header']; // entête
            $data['ep_footer'] = $GLOBALS['ep_footer']; //  bas de page
        } else {
            $data['errors'] = "Veuillez vous connecter";
        }
        return $data;
    }

}