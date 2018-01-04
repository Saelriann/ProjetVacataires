    <h1> Formulaire de création d'un cours </h1>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $message) {
            echo "<span class='alert alert-danger'>" . $message[0] . "</span><br/>";
        }
    }
    if (!empty($result)) {
        if ($result == 1) {
            echo "<span class='alert alert-success'> Enregistrement du cours réussi. </span>";
        }
    }
    ?>
    <br/>
    <div class="user-form">
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>registercourse" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="enseignant"> Vacataire </label> <br>
                <select class="form-field" name="enseignant">
                    <?php foreach ($coursedata['enseignant'] as $line) echo "<option value=".$line['email'].">".$line['prenom']." ".$line['nom']."</option>"; ?>
                </select>
            </div>
             <div class="input-field col s12">
                <label for="idmatiere"> Matière </label> <br>
                <select class="form-field" name="idmatiere">
                    <?php foreach ($coursedata['matiere'] as $line) echo "<option value=".$line['idmatiere']." >".$line['intitulematiere'].' ('.$line['idniveau'].' '.$line['idformation'].')'."</option>"; ?>
                </select>
            </div>
            <div class="input-field col s12">
                <label for="idtype"> Type </label> <br>
                <select class="form-field" name="idtype">
                    <?php foreach ($coursedata['type'] as $line) echo "<option value=".$line['idtype']." >".$line['libelletype']."</option>"; ?>
                </select>    
            </div>
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
            <div class="input-field col s12">
                <label for="idsalle"> Salle </label> <br>
                <select class="form-field" name="idsalle">
                    <?php foreach ($coursedata['numerosalle'] as $line) echo "<option value=".$line['idsalle']." >".$line['codebatiment'].' / '. $line['libellebatiment'].' - '.$line['numerosalle']."</option>"; ?>
                </select>
            </div>

            <div class="input-field col s12">
                <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
            </div>

        </form>
    </div>