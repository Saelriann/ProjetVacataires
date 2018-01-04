<h1> Liste des formations </h1>
<br/>
<table class="details bordered" align="center">
	<th> Code </th>
	<th> Nom formation </th>
	<th> Responsable </th>
	<th> Secrétaire </th>
	<?php
	if(isset($_SESSION['email'])) if($_SESSION["poste"] == 4 ) echo "<th> Modification </th>";

    foreach ($trainingdata as $line) {
	    echo '<tr> <td>'.$line['idformation'].'</td>';
	    echo '<td>'.$line['nomformation'].'</td>';
	    echo '<td> <a href="mailto:'.$line['responsable'].'">'.$line['prenomResponsable'].' '.$line['nomResponsable'].'</a> </td>';
	    echo '<td> <a href="mailto:'.$line['secretaire'].'">'.$line['prenomSecretaire'].' '.$line['nomSecretaire'].'</a> </td>';
	    if(isset($_SESSION['email'])) if($_SESSION["poste"] == 4 ) echo '<td> <a href="'.$GLOBALS['ep_dynamic_url'].'training/modify/'.$line['idformation'].'"> Modifier </a> </td>';
	    echo '</tr>'; 
	  }
?>
</table>
</center>