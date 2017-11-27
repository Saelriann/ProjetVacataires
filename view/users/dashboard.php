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
</center>