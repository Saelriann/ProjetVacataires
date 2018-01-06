<?php 
if(!empty($errors)) {
	echo "<span class='alert alert-danger'>".$errors."</span><br/>";
}
else {

echo '<h1> Liste de vos documents </h1> <br/>
<table class="details bordered" align="center">
	<th> Document </th>
	';
	foreach ($docdata as $line) echo '<tr> <td> <a href="uploaded/'.$line['libelledocument'].'">'.$line['libelledocument'].'</a> </td> </tr>';	
} 
?>

</table>

<a href="<?php $GLOBALS['ep_dynamic_url']; ?>?params=doc/add"> Ajouter un document </a>
</center>