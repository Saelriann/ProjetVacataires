    <h1> Formulaire de création d'un cours </h1>

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

    <!--
  idmatiere int(11) NOT NULL,
  idsalle int(11) NOT NULL,
  idtype int(11) NOT NULL,
  enseignant varchar(255) NOT NULL,
  PRIMARY KEY (idcours)
) ENGINE=InnoDB;
    -->
    <br/>
    <div class="user-form">
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>register" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="datecours">Date du cours</label> <br>
                <input id="datecours" name="datecours" type="date" class="validate" value="<?php if (isset($_POST['datecours'])) { echo $post['datecours']; } ?>">
            </div>
            <div class="input-field col s12">
                <label for="heuredebutcours">Heure de début</label> <br>
                <input id="heuredebutcours" name="heuredebutcours" type="time" class="validate" value="<?php if (isset($_POST['heuredebutcours'])) { echo $post['heuredebutcours']; } ?>">
            </div>
            <div class="input-field col s12">
                <label for="heurefincours"> Heure de fin</label> <br>
                <input id="heurefincours" name="heurefincours" type="time" class="validate" value="<?php if (isset($_POST['heurefincours'])) { echo $post['heurefincours']; } ?>">
            </div>

<!--
            <div class="input-field col s12">
                <label for="nom"> Matière </label> <br>
                <input id="nom" name="nom" type="text" class="validate" value="<?php if (isset($_POST['nom'])) { echo $post['nom']; } ?>">
            </div>
            <div class="input-field col s12">
                <label for="nom"> Type </label> <br>
                <input id="nom" name="nom" type="text" class="validate" value="<?php if (isset($_POST['nom'])) { echo $post['nom']; } ?>">
            </div>
            <div class="input-field col s12">
                <label for="prenom"> Salle </label> <br>
                <input id="prenom" name="prenom" type="text" class="validate" value="<?php if (isset($_POST['prenom'])) { echo $post['prenom']; } ?>">
            </div>
-->

            <div class="input-field col s12">
                <label for="enseignant"> Enseignant </label> <br>
                <select class="form-field" name="enseignant">
                    <?php
                    $request = "SELECT * FROM utilisateur WHERE poste=1";
                    $sql_results = $db->prepare($request);
                    $sql_results->execute($request);
                    while ($row = $sql_results->fetch(PDO::FETCH_OBJ)) {
                        echo "<option value=".$row['email']."/>".$row['prenom']." ".$row['nom']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
    <br>
    <a href='<?php echo $GLOBALS['ep_dynamic_url']; ?> 	'> Retour à la page principale </a>