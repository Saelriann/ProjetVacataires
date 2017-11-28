<h1> Liste des cours </h1>

<h2> Tri </h2>
<div>
	<select id="selection">
	  <option value="m" selected>Par matière</option> 
	  <option value="f">Par formation</option>
	  <option value="e">Par enseignant</option>
	</select>
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


<div class="enseignant-form" id="enseignantf">
        <form action="<?php echo $GLOBALS['ep_dynamic_url']; ?>course/parEnseignant" method="post" class="col s12">
            <div class="input-field col s12">
                <label for="enseignant">Par enseignant : </label> <br>
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

<h2> Liste </h2>
<table class="table" align="center">
	<th> Matière </th>
	<th> Horaires </th>
	<th> Salle &#38; Batiment </th>
	<th> Enseignant </th>
	<th> Type </th>
	<?php for ($i=0; $i < count($coursedata); $i++): ?>
	<tr>
		<td> <?php echo $coursedata[$i]['matiere']; ?> </td>
		<td> <?php echo $coursedata[$i]['horaire']; ?> </td>
		<td> <?php echo $coursedata[$i]['salle']; ?> </td>
		<td> <?php echo $coursedata[$i]['enseignant']; ?> </td>
		<td> <?php echo $coursedata[$i]['type']; ?> </td>
	</tr>
	<?php endfor;?>
</table>
</center>


<script type="text/javascript">
  window.onload = function() {
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
  	if (v=="m") {
  		document.write('
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
  			');
  	} else if (v=="f") {
  		f.style.display = 'block';
  	} else if (v=="e") {
  		e.style.display = 'block';
  	}
}
</script>
