<h1> Liste des cours </h1>

<!-- <h2> Tri </h2>
<div>
	<select id="selection">
	  <option value="m" selected>Par matière</option> 
	  <option value="f">Par formation</option>
	  <option value="e">Par enseignant</option>
	</select>
</div>

<div class="matiere-form" id="matieref">
            <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>course/parMatiere" method="post" class="col s12">
                <div class="input-field col s12">
                    <label for="matiere">Par matière : </label> <br>
                    <select>

                    </select>
                </div>
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
                </div>
            </form>
        </div>

<div class="formation-form" id="formationf">
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>course/parFormation" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="formation"> Par formation : </label> <br>
                 <select>

                </select>

            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light light-blue darken-4" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
<br/>

<br/>
<h2> Liste </h2> -->
<table class="table" align="center">
	<th> Matière </th>
	<th> Horaires </th>
	<th> Salle &#38; Batiment </th>
	<th> Enseignant </th>
	<th> Type </th>
<?php
    foreach ($coursedata as $line) {
    echo '<tr>
      <td>'.$line['matiere'].' ('.$line['niveau']." ".$line['formation'].')</td>
      <td>'.$line['datecours'].' ~ '.$line['heuredebutcours'].' - '.$line['heurefincours'].'</td>
      <td>'.$line['salle']." - ".$line['batiment'].'</td>
      <td>'.$line['enseignant'].'</td>
      <td>'.$line['type'].'</td>
    </tr>'; 
  }
?>
</table>
</center>


<script type="text/javascript">
/*  window.onload = function() {
  var m = document.getElementById('matieref');
  var f = document.getElementById('formationf');
  var e = document.getElementById('enseignantf');
  var b = document.getElementById('selection');
	m.style.display = 'none';
 	f.style.display = 'none';
 	e.style.display = 'none';
  b.onclick = function() {
  	m.style.display = 'none';
  	f.style.display = 'none';
 	  e.style.display = 'none';
  	if (v=="m")  {
      m.style.display = "block";
  	} else if (v=="f") {
  		f.style.display = 'block';
  	} else if (v=="e") {
  		e.style.display = 'block';
  	}
}*/
</script>
