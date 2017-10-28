<?php 
/**
 * Functions
 */
 
 // Début de la session
session_start();
 
// Définition des variables de base
$controller = "";
$func = "index";
$params = "";
$var = array();
$params = array();
$var['ep_header'] = "";
$var['ep_footer'] = "";

// Récupération des paramètres de l'url 
if(isset($_GET['params'])) {
	$paramsRawUnfiltered = $_GET['params'];
	$paramsRawUnfiltered = strip_tags($paramsRawUnfiltered);
	$paramsRaw = explode( "/", $paramsRawUnfiltered); //Converting parameters to array.
	
	// Lecture des valeurs des paramètres, séparation en 3 : contrôleur, fonction et argument 
	if(count($paramsRaw) >= 0) $controller = $paramsRaw[0]; 
	if(count($paramsRaw) > 1) $func = $paramsRaw[1];	
	if(count($paramsRaw) > 1)  {
		for($i = 2; $i < count($paramsRaw); $i+=2) {
		  $params[] = $paramsRaw[$i+1];
		}
	}
}

// Inclusion des essentiels (configuration et base de données)
include('library/config.php');
if(!$GLOBALS['ep_base_url'] || !$GLOBALS['ep_dynamic_url']) {
	echo '<div class="alert alert-info"> Veuillez renseigner votre fichier de configuration correctement concernant les URL - library/config.php </div>';
}
if(!$GLOBALS['ep_hostname'] || !$GLOBALS['ep_username'] || !$GLOBALS['ep_database']) {
	echo '<div class="alert alert-info"> Veuillez renseigner votre fichier de configuration correctement concernant la base de données - library/config.php </div>';
}
include('library/database.php');

// Inclusion de tous les modèles
$model_array    = 'model';
$model_files = scandir($model_array);
$model_files_filtered = array_diff($model_files, array('.', '..'));
foreach($model_files_filtered as $model) {
	if (strpos($model, '.') !== TRUE) {
		include('model/'.$model);
	}
}
include('library/helper.php');
include('plugins/plugins.php'); 
include('library/routes.php');

if(!$controller) $controller = $GLOBALS['ep_first_page'];
if(!$func) $func = "index";
if($GLOBALS['seourl'] == "false") $GLOBALS['ep_dynamic_url'] = $GLOBALS['ep_dynamic_url']."?params=";

// Inclusion du controleur concerné par la page, en prenant son nom de l'url
if (file_exists("controller/".$controller.".php")) {
	include("controller/".$controller.".php");
// Initialisation du controleur
	$functions = new $controller();

// Récupération de la variable définie dans le contrôleur et définition de celle-ci comme nom de variable.
	if(method_exists($controller, $func)) {
		$var = call_user_func_array(array($functions, $func), $params);
		$keys = array_keys($var);
		foreach($keys as $key) {
			$$key = $var[$key];
		}
	}
}
// Construction de la vue
if($var['ep_header']) {
	if($var['ep_header'] && $var['ep_header'] != "false") {
		include('view/'.$var['ep_header']);	
	}
}
else {
	include('view/'.$GLOBALS['ep_header']);
}
if(method_exists($controller, $func)) {
	if($var['view_page'] != "false") {
		include('view/'.$var['view_page']); 
	}
}
else {
	include('view/404.php'); 
}
if($var['ep_footer']) {
	if($var['ep_footer'] && $var['ep_footer'] != "false") {
		include('view/'.$var['ep_footer']);	
	}
}
else {
		include('view/'.$GLOBALS['ep_footer']);
}
?>