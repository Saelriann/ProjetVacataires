<h1> Liste des documents </h1>
<br/>
<table class="details bordered" align="center">
	<th> Nom </th>
	<th> Prénom </th>
	<th> Document </th>
	<?php
    foreach ($docdata as $line) {
	    echo '<tr> <td>'.$line['nom'].'</td>';
	    echo '<td>'.$line['prenom'].'</td>';
	    echo '<td> <a href="uploaded/'.$line['libelledocument'].'">'.$line['libelledocument'].'</a> </td>';
	    echo '</tr>'; 
	  }
?>
</table>

</center>