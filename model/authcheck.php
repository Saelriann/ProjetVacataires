<?php 
/**
 * Authcheck Model
 */
 
class authcheck {
	
	public function __construct()
	  {
		//Calling your Model class for page
			$model = new auth_model(); 
			$this->helper = new helper(); // calling helper class
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(isset($_SESSION["easyphp_sessionid"])) {
				$result = $model->checksession($_SESSION["easyphp_sessionid"]);
				if($result) {
					$this->$result = $result;					
				}
				else {
					if($GLOBALS['seourl'] == "false") {
						header("Location: ".$GLOBALS['ep_dynamic_url']."login&redirecturl=".$actual_link);
						die();
					}
					else {
						header("Location: ".$GLOBALS['ep_dynamic_url']."login?redirecturl=".$actual_link);
						die();
					}
				}
			}
			else {
				if($GLOBALS['seourl'] == "false") {
						header("Location: ".$GLOBALS['ep_dynamic_url']."login&redirecturl=".$actual_link);
						die();
					}
					else {
						header("Location: ".$GLOBALS['ep_dynamic_url']."login?redirecturl=".$actual_link);
						die();
					};
			}
	  }	
}