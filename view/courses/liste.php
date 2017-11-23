<h1> Liste des matières </h1>
<br/>
<table class="details bordered" align="center">
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