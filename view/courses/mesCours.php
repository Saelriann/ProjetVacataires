
<?php 
if(!empty($errors)) {
	echo "<span class='alert alert-danger'>".$errors."</span><br/>";
}
else {

echo '<h1> Liste de vos cours </h1> <br/>
<table class="details bordered" align="center">
	<th> Matière </th>
	<th> Horaires </th>
	<th> Salle &#38; Batiment </th>
	<th> Type </th>
	';
	foreach ($coursedata as $line) {
		echo '<tr>
			<td>'.$line['matiere'].' ('.$line['niveau']." ".$line['formation'].')</td>
			<td>'.$line['datecours'].' ~ '.$line['heuredebutcours'].' - '.$line['heurefincours'].'</td>
			<td>'.$line['salle']." - ".$line['batiment'].'</td>
			<td>'.$line['type'].'</td>
		</tr>';	
	}
} 
?>

</table>
</center>