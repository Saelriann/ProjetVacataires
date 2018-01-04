    <h1> Formulaire de modification d'une formation </h1>

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
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>training/modify/<?php echo $trainingdata['id']; ?>" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="responsableFormation"> Responsable formation </label> <br>
                <select class="form-field" name="responsable">
                    <?php 
                    foreach ($alldata['responsableFormation'] as $line) {
                        echo "<option value=".$line['email'];
                        if ($line['email']==$trainingdata['responsableFormation']['email']) echo " selected ";
                        echo ">".$line['prenom']." ".$line['nom']."</option>"; 
                    }
                    ?>
                </select>
            </div>
            <div class="input-field col s12">
                <label for="secretaireFormation"> Secrétaire formation </label> <br>
                <select class="form-field" name="secretaire">
                    <?php 
                    foreach ($alldata['secretaireFormation'] as $line) {
                        echo "<option value=".$line['email'];
                        if ($line['email']==$trainingdata['secretaireFormation']['email']) echo " selected ";
                        echo ">".$line['prenom']." ".$line['nom']."</option>"; 
                    }
                    ?>
                </select>
            </div>

            <div class="input-field col s12">
                <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
            </div>

        </form>
    </div>