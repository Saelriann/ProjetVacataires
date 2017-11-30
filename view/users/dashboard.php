<h1> Profil </h1>
<br/>
<table class="details bordered" align="center">
	<tr>
		<td colspan="2"> <h5> Votre profil </h5> </td>
	</tr>
	<tr>
		<td> Nom : </td>
		<td> <?php echo $userdata['nom']; ?> </td>
	</tr>
	<tr>
		<td> Prénom : </td>
		<td> <?php echo $userdata['prenom']; ?> </td>
	</tr>
	<tr>
		<td> Email : </td>
		<td> <?php echo $userdata['email']; ?> </td>
	</tr>
	<tr>
		<td> Date de naissance : </td>
		<td> <?php echo $userdata['datenaissance']; ?> </td>
	</tr>
	<tr>
		<td> Adresse : </td>
		<td> <?php echo $userdata['adresse']; ?> </td>
	</tr>
    <tr>
        <td> Poste : </td>
        <td> <?php echo $userdata['poste_name']; ?> </td>
    </tr>
	
</table>

<br/>
<br/>
<br/>

<table class="details bordered" align="center">
    <tr>
		<td colspan="2"> <h5> Liste des profils </h5> </td>
	</tr>

    <?php
    // TODO : différencier utilisateurs
    // TODO : lien pour acceder au reste des infos
    foreach ($userdata['userList'] as $row) {
    	$user = $row[0];
    	echo "<tr> <td> $user </td> </tr>";
	}
    ?>
</table>
</center>