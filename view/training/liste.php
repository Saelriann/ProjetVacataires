<h1> Liste des formations </h1>
<br/>
<table class="details bordered" align="center">
	<th> Code </th>
	<th> Nom formation </th>
	<th> Responsable </th>
	<th> Secrétaire </th>
	<?php for ($i=0; $i < count($trainingdata); $i++): ?>
	<tr>
		<td> <?php echo $trainingdata[$i]['idformation']; ?> </td>
		<td> <?php echo $trainingdata[$i]['nomformation']; ?> </td>
		<td> <a href="mailto:<?php echo $trainingdata[$i]['responsable'] ?>"> <?php echo $trainingdata[$i]['prenomResponsable'].' '.$trainingdata[$i]['nomResponsable']; ?> </a> </td>
		<td> <a href="mailto:<?php echo $trainingdata[$i]['secretaire'] ?>"> <?php echo $trainingdata[$i]['prenomSecretaire'].' '.$trainingdata[$i]['nomSecretaire']; ?> </a> </td>
	</tr>
	<?php endfor;?>
</table>
</center>