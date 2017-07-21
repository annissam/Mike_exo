<?php
require_once("inc/init.inc.php");
// ------ TRAITEMENT PHP-------------------
if(isset($_GET['action']) && $_GET['action'] == "deconnexion") // si l'internaute demande une deconnexion
{
	session_destroy();// supprime la session
}

if(internauteEstConnecte()) // si l'internaute est d�ja connect�, il n'a rien � faire ici, nous le redirigeons vers son profil. De cette mani�re, nous afficherons le formulaire de connexion uniquement si le membre n'est pas connect�
{
	header("location:profil.php");
}


if($_POST)
{
	$resultat = executeRequete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
	if($resultat->num_rows != 0)
	{
		$membre = $resultat->fetch_assoc();
		if($membre['mdp'] == $_POST['mdp']) // if(password_verify($_POST['mdp'],$membre['mdp']))
		{
			foreach($membre as $indice => $element)
			{
				if($indice != 'mdp')
				{
					$_SESSION['membre'][$indice] = $element;
				}
			}
			header("location:profil.php");
		}
		else{
			$contenu .= '<div class="erreur">Erreur de mot de passe</div>';
		}
	}
	else{
		$contenu .= '<div class="erreur">Erreur de Pseudo</div>';
	}
}

require_once("inc/haut.inc.php");
echo $contenu;
?>

<form method="post" action="">
	<label for="pseudo">Pseudo</label><br>
	<input type="text" id="pseudo" name="pseudo"><br><br>

	<label for="mdp">Mot de passe</label><br>
	<input type="text" id="mdp" name="mdp"><br><br>

	<input type="submit" value="Se connecter">
</form>

<?php
require_once("inc/bas.inc.php");
?>
