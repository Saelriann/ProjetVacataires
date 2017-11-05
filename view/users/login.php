<h1> Formulaire de connexion </h1> <br/>

<?php 
if(!empty($errors)) {
	foreach($errors as $message) {
		echo "<span class='alert alert-danger'>".$message[0]."</span><br/>";
	}
}
?>

<div class="user-form"> 
		<form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>login" method="post" class="col s12">
		  <div class="input-field col s12">
              <label for="email">Email</label> <br>
			  <input id="email" name="email" type="text" class="validate" value="<?php if(isset($_POST['email'])) { echo $post['email']; } ?>" autocomplete="off">
			</div>
            <br>
			<div class="input-field col s12">
              <label for="password">Mot de passe</label> <br>
			  <input  id="password" name="password" type="password" class="validate" value="" autocomplete="off">
			</div>
            <br>
			<div class="input-field col s12">
			  <label for="remember">Rester connecté</label>
			  <input id="remember" name="remember" type="checkbox" onclick="validate()" value="0">
			</div> 
			<div class="input-field col s12">
			  <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Connexion</button>
			</div> <br>
			<div class="input-field col s12">
			  <a href='<?php echo $GLOBALS['ep_dynamic_url']; ?>register'> S'enregistrer </a> | <a href='<?php echo $GLOBALS['ep_dynamic_url']; ?>login/forgot'> Mot de passe oublié </a>
			</div>
		  <input id="remember2" type="hidden" name="remember"/>
		</form>
</div>

<script type="text/javascript">
    function validate() {
        if (document.getElementById('remember').checked) {
            $('#remember2').attr('name', '');
        } else {
             $('#remember2').attr('name', 'remember');
        }
    }
</script>
