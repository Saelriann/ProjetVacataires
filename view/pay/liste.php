<h1> Liste des rémunérations </h1>
<br/>
<table class="details bordered" align="center">
	<th> Nom </th>
	<th> Prénom </th>
	<th> Date </th>
	<th> Rémunération </th>
	<?php
    foreach ($paydata as $line) {
	    echo '<tr> <td>'.$line['nom'].'</td>';
	    echo '<td>'.$line['prenom'].'</td>';
	    echo '<td> '.$line['dateremuneration'].' </td>';
	    echo '<td> '.$line['montantremuneration'].'</td>';
	    echo '</tr>'; 
	  }
?>
</table>


<a href="<?php $GLOBALS['ep_dynamic_url']; ?>?params=pay/add"> Inscrire un paiement </a>

</center>