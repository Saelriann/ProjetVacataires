
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
	for ($i=0; $i < count($coursedata); $i++) {
		echo '<tr>
				<td>'.$coursedata[$i]['matiere'].'</td>
				<td>'.$coursedata[$i]['horaire'].'</td>
				<td>'.$coursedata[$i]['salle'].'</td>
				<td>'.$coursedata[$i]['type'].'</td>
			</tr>';
	}
} 
?>

</table>
</center>
