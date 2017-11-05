<h1> Connexion réussie ! </h1>
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
		<td> <?php echo $userdata['datenaissance']; ?> <i> todo : changer le format</i>  </td>
	</tr>
	<tr>
		<td> Adresse : </td>
		<td> <?php echo $userdata['adresse']; ?> </td>
	</tr>
    <tr>
        <td> Poste : </td>
        <td> <i> todo: jointure avec table poste </i> </td>
    </tr>
	
</table>
</center>