<?php
require_once("inc/init.inc.php");
//debug($_POST);
if($_POST)
{
	//----------- CONTROLES ET ERREURS :
	$erreur = "";
	// contrôle de la taille du pseudo
	if(strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) > 20)
	{
		$erreur .= '<div class="erreur">Erreur de taille de pseudo</div>';
	}
	// contrôle du format(pseudo)
	if(!preg_match('#^[a-zA-Z0-9-_.]+$#', $_POST['pseudo']))
	{
		$erreur .= '<div class="erreur">Erreur format/caractère pseudo</div>';
	}
	/*
		preg_match() est une fonction prédéfinie permettant de gérer les expressions régulières, elle est toujours entouré de dieze afin de préciser des options : 
		"^" indique le début de la chaine / sinon la chaine pourrait commencer par autre chose
		"$" indique la fin de la chaine / sinon la cahine pourrait terminer par autre chose
		"+" est la pour dire que les lettres autorisés peuvent apparaitres plusoeurs fois / sinon on pourrait avoir qu'une seul fois la lettre B par exemple
	*/
	// contrôle de la disponibilité du pseudo
	$result = executeRequete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'"); // selection du pseudo dans notre BDD
	if($result->num_rows >= 1)
	{
		$erreur .= '<div class="erreur">Pseudo indisponible !</div>'; // les pseudo est déja reservé!
	}
	// ----- VALIDATION ET INSCRIPTION DU MEMBRE
	if(empty($erreur))
	{
		// executez une requete d'insertion en BDD, afficher un message lorsqu'un membre est bien inscrit, et faites des tests de controles
		//$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // cryptage du mdp
		executeRequete("INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse)VALUES('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
		$contenu .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
	}
	$contenu .= $erreur;
}
require_once("inc/haut.inc.php");
echo $contenu;
?>

<form method="post" action="">
	<label for="pseudo">Pseudo</label><br>
	<input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{3,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>
	
	<label for="mdp">Mot de passe</label><br>
	<input type="password" id="mdp" name="mdp" required="required"><br><br>
	
	<label for="nom">Nom</label><br>
	<input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>
	
	<label for="prenom">Prénom</label><br>
	<input type="text" id="prenom" name="prenom" placeholder="votre prenom"><br><br>
	
	<label for="email">Email</label><br>
	<input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
	
	<label for="civilite">Civilité</label><br><BR>
	<input type="radio" name="civilite" id="civilite" value="m" checked>Homme
	<input type="radio" name="civilite" id="civilite" value="f">Femme<br><br>
	
	<label for="ville">Ville</label><br>
	<input type="text" id="ville" name="ville" placeholder="votre ville" pattern="[a-zA-Z0-9-_.]{3,20}" title="caractères acceptés : a-zA-Z0-9-_."><br><br>
	
	<label for="code_postal">Code Postal</label><br>
	<input type="text" id="code_postal" name="code_postal" placeholder="votre code postal" pattern="[0-9]{5}" title="caractères acceptés : 0-9"><br><br>
	
	<label for="adresse">Adresse</label><br>
	<textarea type="text" id="adresse" name="adresse" placeholder="votre adresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."></textarea><br><br>
	
	<input type="submit" name="inscription" value="S'inscrire">
</form>

<?php
require_once("inc/bas.inc.php");
?>