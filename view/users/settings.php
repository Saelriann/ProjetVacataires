<h1> Paramètres du compte </h1> <br>

<?php 
if(!empty($errors)) {
	foreach($errors as $message) {
		echo "<span class='alert alert-danger'>".$message[0]."</span><br/>";
	}
}
if(!empty($result)) {
	echo "<span class='alert alert-success'> Mise à jour réussie ! </span>";
}
?>

<div class="user-form"> 
		<form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>dashboard/settings" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="email">Email</label> <br>
                <span> <?php if(!empty($userdata['email'])) { echo $userdata['email']; } ?> </span>
                <!-- Une fois renseigné, l'email ne peut pas être changé car il s'agit de l'identifiant -->
            </div> <br>
			<div class="input-field col s12">
			  <label for="nom">Nom</label>  <br>
			  <input id="nom" name="nom" type="text" class="validate" value="<?php if(!empty($userdata['nom'])) { echo $userdata['nom']; } ?>">
			</div> <br>
            <div class="input-field col s12">
                <label for="prenom">Prénom</label>  <br>
                <input id="prenom" name="prenom" type="text" class="validate" value="<?php if(!empty($userdata['prenom'])) { echo $userdata['prenom']; } ?>">
            </div> <br>
            <div class="input-field col s12">
                <!-- pour le moment, le format de la date de naissance n'est pas intuitif mais il sera changé -->
                <label for="datenaissance"> Date de naissance (format "1980-12-31") </label> <br>
                <input id="datenaissance" name="datenaissance" type="date" class="validate" value="<?php if(!empty($userdata['datenaissance'])) { echo $userdata['datenaissance']; } ?>">
            </div> <br>
            <div class="input-field col s12">
                <label for="adresse"> Adresse </label> <br>
                <input id="adresse" name="adresse" type="date" class="validate" value="<?php if(!empty($userdata['adresse'])) { echo $userdata['adresse']; } ?>">
            </div> <br>
			<div class="input-field col s12">
				<button class="btn waves-effect waves-light light-blue darken-4" type="submit"> Modifier </button>
			</div>
		</form>
</div> <br>

<a href='<?php echo $GLOBALS['ep_dynamic_url']; ?> 	'> Retour à la page principale  </a>