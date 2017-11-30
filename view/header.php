<!DOCTYPE html>
<html>
	<head>
		<title> <?php echo $ep_title; ?> </title>

		<!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
		<script type="text/javascript" src="<?php echo $GLOBALS['ep_base_url']; ?>view/js/jquery-1.11.3.js"></script>
		<script type="text/javascript" src="<?php echo $GLOBALS['ep_base_url']; ?>view/js/jquery-migrate-1.2.1.js"></script>
		<script type="text/javascript" src="<?php echo $GLOBALS['ep_base_url']; ?>view/js/materialize.js"></script>
		<link rel="shortcut icon" href="<?php echo $GLOBALS['ep_base_url']; ?>view/images/favicon.png" type="image/x-icon" />
	</head>
	<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

  	  <?php if(strlen($_SESSION["easyphp_sessionid"]) > 1) { ?>	
		<!-- Dropdown Trigger -->
		<li><a class="nav-link" href='<?php echo $GLOBALS['ep_dynamic_url']; ?>'> Bonjour, <?php echo $_SESSION['prenom']; ?> </a></li>
	  <?php } 
       if(isset($_SESSION['email'])) {
    ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?php echo $ep_dynamic_url; ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mon compte
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>course/mesCours">Mes Cours</a>
          ----
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>dashboard/settings">Modifier son compte</a>
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>dashboard/password">Changer de mot de passe</a>
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>dashboard/logout">Déconnexion</a>
        </div>
      </li>
    <?php } else { ?>
       <a class="nav-link" href="<?php echo $ep_dynamic_url; ?>"> Se connecter </a>
    <?php } ?>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?php echo $ep_dynamic_url; ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cours et formations
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>training">Affichage des formations</a>
          <a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>course">Affichage des cours</a>
          <?php
          		// le secrétaire gère les cours
            if(isset($_SESSION['email'])) {
              if($_SESSION["poste"] == 3) { ?>	
          	<a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>course/registercourse"> Créer un nouveau cours </a>
          	<a class="dropdown-item" href="<?php echo $ep_dynamic_url; ?>training/updatetraining"> Modifier les formations </a>
          <?php } } ?>
        </div>
      </li>
      <!-- 
      TODO : gérer les documents et les rémunérations
		// le contrleur de gestion gère les cours
       -->
          		
    </ul>
  </div>
</nav>
<center>

<!-- 
<pre> 
<?php 
    //var_dump($_SESSION); 
?> 
</pre> 
-->