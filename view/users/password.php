<h1> Changement de mot de passe </h1> <br>

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
    <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>dashboard/password" method="post" class="col s12">
        <div class="input-field col s12">
            <label for="password">Nouveau mot de passe </label> <br>
            <input  id="password" name="mdp" type="password" class="validate" value="">
        </div> <br>
        <div class="input-field col s12">
            <label for="password">Confirmation </label> <br>
            <input  id="password" name="passwordverify" type="password" class="validate" value="">
        </div> <br>
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light light-blue darken-4" type="submit"> Modifier </button>
        </div>
    </form>
</div> 