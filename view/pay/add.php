<h1> Formulaire de rémunération </h1>

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
    <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>pay/add" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="email"> Vacataire </label> <br>
                <select class="form-field" name="email">
                    <?php foreach ($paydata['vacataire'] as $line) echo "<option value=".$line['email'].">".$line['prenom']." ".$line['nom']."</option>"; ?>
                </select>
            </div>
        <div class="input-field col s12">
            <label for="montantremuneration"> Montant</label> <br>
            <input id="montantremuneration" name="montantremuneration" type="number">
        </div>
        <input hidden id="dateremuneration" name="dateremuneration" value="<?php echo date("y-m-d"); ?>">

        <div class="input-field col s12">
            <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
        </div>

    </form>
</div>