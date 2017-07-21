<?php
// Réaliser la page membre : 
// affichage sous forme de tableau HTML l'ensemble de la table membre en BDD
// faites en sorte de pouvoir modifier et supprimer un membre


require_once("../inc/init.inc.php");
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}

//-------- SUPPRESSION -------------//
if(isset($_GET['msg']) && $_GET['msg'] == "supprimer")
{
	executeRequete("delete from membre where id_membre=$_GET[id_membre]");
	header("Location:gestion_membre.php");
}
//------- MODIFICATION -------------//
if(!empty($_POST))
{
	foreach($_POST as $indice => $valeur)
	{
		$_POST[$indice] = htmlEntities(addSlashes($valeur));
	}
	// Exercice : executez une requete d'insertion permettant d'inserer un produit dans la base
	executeRequete("REPLACE INTO membre(id_membre,pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse)VALUES('$_POST[id_membre]', '$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
	$contenu .= '<div class="validation">Le membre a bien été enregistré</div>';
	$_GET['msg'] = 'afficher';
}

//---- LIENS PRODUITS ----//
$contenu .= '<a href="?msg=modifier">Modifier les membres</a><br>';
$contenu .= '<a href="?msg=afficher">afficher les membres</a><br><br><hr><br>';
//-------------------------------------------------- Affichage ---------------------------------------------------------//

if(isset($_GET['msg']) && $_GET['msg'] == 'afficher')
{
$contenu .= '<h1> Voici les membres inscrit au site </h1>';
	$resultat = executeRequete("SELECT * FROM membre");
	$contenu .= "Nombre de membre(s) : " . $resultat->num_rows;
	$contenu .= "<table style='border-color:black' border=1> <tr>";
	while($colonne = $resultat->fetch_field())
	{    
		echo '<th>' . $colonne->name . '</th>';
	}
	$contenu .= '<th> modifier </th>';
	$contenu .= '<th> Supprimer </th>';
	$contenu .= "</tr>";
	while ($membre = $resultat->fetch_assoc())
	{
		$contenu .= '<tr>';
		foreach ($membre as $information)
		{
			$contenu .= '<td>' . $information . '</td>';
		}
		$contenu .= "<td><a href='gestion_membre.php?msg=modifier&&id_membre=" . $membre['id_membre'] . "'> X </a></td>";
		$contenu .= "<td><a href='gestion_membre.php?msg=supprimer&&id_membre=" . $membre['id_membre'] . "' onclick='return(confirm(\"Etes-vous sûr de vouloir supprimer ce membre?\"));'> X </a></td>";
		$contenu .= '</tr>';
	}
	$contenu .= '</table><br><br><hr>';
}
	
require_once("../inc/haut.inc.php");
echo $contenu;
	
if(isset($_GET['msg']) && $_GET['msg'] == 'modifier')
{
	if(isset($_GET['id_membre']))
	{
		$resultat = executeRequete("SELECT * FROM membre WHERE id_membre=$_GET[id_membre]"); // on recupere les informations sur l'article à modifier
		$membre_actuel = $resultat->fetch_assoc(); // on rends les informations exploitable afin de les présaisir dans les cases du formulaire.
	}
	$id_membre = (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] : '';
	$pseudo = (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : '';
	$mdp = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : '';
	$nom = (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : '';
	$prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : '';
	$email = (isset($membre_actuel['email'])) ? $membre_actuel['email'] : '';
	$civilite = (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] : '';
	$ville = (isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : '';
	$cp = (isset($membre_actuel['code_postal'])) ? $membre_actuel['code_postal'] : '';
	$adresse = (isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';
	
	echo '<br><h1> Formulaire membre </h1>
			<form method="post" enctype="multipart/form-data" action="">
			
		<input type="hidden" id="id_membre" name="id_membre" value="' . $id_membre . '" />
		
		<label for="pseudo">Pseudo</label><br>
		<input type="text" id="pseudo" name="pseudo" value="' . $pseudo . '" /><br><br>

		<label for="mdp">Mot de passe</label><br>
		<input type="text" id="mdp" name="mdp" value="' . $mdp . '" /><br><br>

		<label for="nom">Nom</label><br>
		<input type="text" id="nom" name="nom" value="' . $nom . '" /><br><br>

		<label for="prenom">Prénom</label><br>
		<input type="text" id="prenom" name="prenom" value="' . $prenom . '" /><br><br>
		
		<label for="email">Email</label><br>
		<input type="email" id="email" name="email" value="' . $email . '" /><br><br>
		
		<label for="civilite">Civilité</label><br>
		<input type="radio" name="civilite" value="m"'; if($civilite == 'm') echo ' checked '; elseif(empty($civilite) && !isset($_POST['public'])) echo 'checked'; echo '/>Homme
		<input type="radio" name="civilite" value="f"'; if($civilite == 'f') echo ' checked '; echo '/>Femme<br><br>
		
		<label for="ville">Ville</label><br>
		<input type="text" id="ville" name="ville" value="' . $ville . '" /><br><br>
		
		<label for="code_postal">Code postal</label><br>
		<input type="text" id="code_postal" name="code_postal" value="' . $cp . '" /><br><br>
		
		<label for="adresse">Adresse</label><br>
		<input type="text" id="adresse" name="adresse" value="' . $adresse . '" /><br><br>
		
		<input type="submit" value="'; echo ucfirst($_GET['msg']) . ' du membre"/>
	</form>';
}
	
	
	
	
	
	
	