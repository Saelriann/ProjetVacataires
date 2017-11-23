<h1> Mot de passe oublié </h1> <br>

<?php 
if(!empty($errors)) {
	foreach($errors as $message) {
		echo "<span class='alert alert-danger'>".$message[0]."</span><br/>";
	}
}
if (!empty($result)) {
	if($result == 1) {
		echo "<span class='alert alert-success'> Demande envoyée </span>";
	}
}

?>
<img src="../images/workinprogress.png" alt="workinprogress">
<br>
Fonctionnalité à venir ...
<br>
<!--
<div class="user-form"> 
	<div class="row">
		<form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>login/forgot" method="post" class="col s12">
		  <div class="input-field col s12">
		  	  <label for="email">Entrez votre adresse email : </label> <br>
			  <input id="email" name="email" type="text" class="validate" value="<?php if(isset($_POST['email'])) { echo $post['email']; } ?>">
			</div>
			<div class="input-field col s12">
				<button class="btn waves-effect waves-light light-blue darken-4" type="submit"> Envoyer </button>
			</div> <br>
		</form>
	</div>
</div>
-->