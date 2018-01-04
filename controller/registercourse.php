<?php 
/**
 * Controleur d'enregistrement des cours
 */
 
class registercourse {
	
	public function __construct()
	  {
			$this->model = new registercourse_model(); 
	  }
	  
	public function index() {
		$coursedata = $this->model->listesDeroulantes();

		if (!empty($_POST)) {
			$data['post'] = $_POST;
			$final_array = array();
			$keys = array_keys($_POST);
			foreach($keys as $key) {
				$value = strip_tags($_POST[$key]);
				$value = trim($value);
				$final_array[$key] = $value;
			}
			$data['result'] = $this->model->register($final_array);
		}

		$data['ep_title'] = "Création cours"; // nom de la page
		$data['coursedata'] = $coursedata;
		$data['view_page'] = "courses/registerCourse.php"; // controleur à afficher
		$data['ep_header'] = "header.php"; // entête
		$data['ep_footer'] = $GLOBALS['ep_footer']; // bas de page

		return $data;
	}  

}

	