<h1> Liste des matières </h1>
<br/>
<table class="details bordered" align="center">
	<th> Formation </th>
	<th> Niveau </th>
	<th> Matières </th>
	<?php for ($i=0; $i < count($majordata); $i++): ?>
	<tr>
		<td> <?php echo $majordata[$i]['nomformation']; ?> </td>
		<td> <?php echo $majordata[$i]['niveau']; ?> </td>
		<td> <?php echo $majordata[$i]['intitulematiere']; ?> 
		</td>
	</tr>
	<?php endfor;?>
</table>

</center>

<?php // foreach ($majordata[$i]['listematiere_niveau_formation'] as $key => $value) echo '<li>'.$value.'</li>'; ?> 