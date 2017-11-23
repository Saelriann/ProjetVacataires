    <h1> Formulaire d'enregistrement </h1>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $message) {
            echo "<span class='alert alert-danger'>" . $message[0] . "</span><br/>";
        }
    }
    if (!empty($result)) {
        if ($result == 1) {
            echo "<span class='alert alert-success'> Enregistrement réussi - Veuillez vous connecter pour accéder au profil </span>";
        }
    }

    ?>
    <br/>
    <div class="user-form">
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>register" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="email">Email</label> <br>
                <input id="email" name="email" type="text" class="validate" value="<?php if (isset($_POST['email'])) {
                    echo $post['email'];
                } ?>">
            </div>
            <div class="input-field col s12">
                <label for="password">Mot de passe</label> <br>
                <input id="password" name="mdp" type="password" class="validate" value="">
            </div>
            <div class="input-field col s12">
                <label for="password">Confirmation du mot de passe</label> <br>
                <input id="password" name="passwordverify" type="password" class="validate" value="">
            </div>
            <div class="input-field col s12">
                <label for="nom"> Nom </label> <br>
                <input id="nom" name="nom" type="text" class="validate" value="<?php if (isset($_POST['nom'])) {
                    echo $post['nom'];
                } ?>">
            </div>
            <div class="input-field col s12">
                <label for="prenom"> Prénom </label> <br>
                <input id="prenom" name="prenom" type="text" class="validate" value="<?php if (isset($_POST['prenom'])) {
                    echo $post['prenom'];
                } ?>">
            </div>
            <div class="input-field col s12">
                <!-- pour le moment, le format de la date de naissance n'est pas intuitif mais il sera changé -->
                <label for="datenaissance"> Date de naissance (format "1980-12-31") </label> <br>
                <input id="datenaissance" name="datenaissance" type="date" class="validate"
                       value="<?php if (isset($_POST['datenaissance'])) {
                           echo $post['datenaissance'];
                       } ?>">
            </div>
            <div class="input-field col s12">
                <label for="adresse"> Adresse </label> <br>
                <input id="adresse" name="adresse" type="date" class="validate"
                       value="<?php if (isset($_POST['adresse'])) {
                           echo $post['adresse'];
                       } ?>">
            </div>

            <!-- pour le moment, vacataire par défaut lorsqu'on s'enregistre -->
            <input hidden name="poste" value="1">
            <!--
            <div class="input-field col s12">
                <label for="location"> Poste </label> <br>
                <select class="form-field" name="poste">
                    <?php
/*                    $request = "SELECT * FROM poste";
                    $sql_results = $db->prepare($request);
                    $sql_results->execute($request);
                    while ($row = $sql_results->fetch(PDO::FETCH_OBJ)) {
                        echo "<option value=".$row['idposte']."/>".$row['intituleposte']."</option>";
                    }
                    */?>
                </select>
            </div>
            -->
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light light-blue darken-4" type="submit">S'enregistrer</button>
            </div>
        </form>
    </div>