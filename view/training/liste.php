<h1> Liste des formations </h1>
<br/>
<table class="details bordered" align="center">
	<th> Code </th>
	<th> Nom formation </th>
	<th> Responsable </th>
	<?php for ($i=0; $i < count($trainingdata); $i++): ?>
	<tr>
		<td> <?php echo $trainingdata[$i]['idformation']; ?> </td>
		<td> <?php echo $trainingdata[$i]['nomformation']; ?> </td>
		<td> <?php echo $trainingdata[$i]['responsable']; ?> </td>
	</tr>
	<?php endfor;?>
</table>
</center>