<h1> Formulaire d'ajout de documents </h1>

<?php
if (!empty($errors)) {
    foreach ($errors as $message) {
        echo "<span class='alert alert-danger'>" . $message[0] . "</span><br/>";
    }
}
if (!empty($result)) {
    if ($result == 1) {
        echo "<span class='alert alert-success'> Enregistrement réussi. </span>";
    }
}

?>

<br/>
<div class="user-form">
    <form enctype="multipart/form-data" action="<?php echo $GLOBALS['ep_dynamic_url']; ?>doc/add" method="post" class="col s12">
        <div class="input-field col s12">
            <label for="libelledocument"> Intitulé Document</label> <br>
            <input id="libelledocument" name="libelledocument" type="name" value="<?php if (isset($_POST['libelledocument'])) { echo $post['libelledocument']; } ?>">
        </div>
        <div class="input-field col s12">
            <label for="documentblob"> Document</label> <br>
            <input id="documentblob" name="documentblob" type="file">
        </div>
        <input hidden id="email" name="email" value="<?php echo $_SESSION['email'] ?>">

        <div class="input-field col s12">
            <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
        </div>

    </form>
</div>