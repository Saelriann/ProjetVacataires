
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
	for ($i=0; $i <count($coursedata); $i++) {
		echo '<tr>
				<td>'.$coursedata[$i]['matiere'].' ('.$coursedata[$i]['niveau']." ".$coursedata[$i]['formation'].')</td>
				<td>'.$coursedata[$i]['datecours'].' ~ '.$coursedata[$i]['heuredebutcours'].' - '.$coursedata[$i]['heurefincours'].'</td>
				<td>'.$coursedata[$i]['salle']." - ".$coursedata[$i]['batiment'].'</td>
				<td>'.$coursedata[$i]['type'].'</td>
			</tr>';
	}
} 
?>

</table>
</center>