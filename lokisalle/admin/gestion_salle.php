<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
//debug($_POST);
//----------SUPPRESSION ------------------//
if (isset($_GET ['action']) &&$_GET ['action'] == 'suppression')
{
	$contenu.= '<div class="validation">Suppression du salle : '.$_GET['id_salle'] . '</div>';
	executeRequete("DELETE FROM salle WHERE id_salle ='$_GET[id_salle]'");
	$_GET['action']='affichage';
}
//--------- ENREGISTREMENT SALLE ----//
if(!empty($_POST))
{
	$photo_bdd = "";
	if(!empty($_FILES['photo']['name']))
	{
		debug($_FILES);
		$nom_photo = $_POST['categorie'] . '_' .$_FILES ['photo']['name'];
		$photo_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE. "/photo/$nom_photo";
		copy($_FILES['photo']['tmp_name'],$photo_dossier);
	}
	foreach ($_POST as $indice => $valeur)
	{
		$_POST[$indice] = htmlEntities(addSlashes ($valeur));
	}
	executeRequete("REPLACE INTO
salle(titre,description,photo,pays,ville,adresse,cp,capacite,categorie)VALUES('$_POST[capacite]','$_POST[categorie]','$_POST[titre]','$_POST[description]','$_POST[photo]','$_POST[pays]','$_POST[ville]','$photo_bdd','$_POST[adresse]','$_POST[capacite]')");
}
//----------------LIEN SALLE--------------------
$contenu .='<a href="?action=affichage"> Affichage des salle</a><br>';
$contenu .='<a href="?action=ajout">Ajout d\'une salle </a><br><br><hr><br>';

//-------------------AFFICHAGE SALLE----------
if(isset($_GET['action']) && $_GET ['action'] == 'affichage')
{
	$resultat = executeRequete("SELECT * FROM salle");

	$contenu .='<h2>Affichage des salle </h2>';
	$contenu .='Nombre de salle disponible : '.$resultat -> num_rows;
	$contenu .='<table border ="1" cellpadding ="5"<tr>';

	while($colonne = $resultat->fetch_field())
	 {
		 $contenu .= '<th>' . $colonne->name .'</th>';
	 }
	 $contenu .= '<th>Modification</th>';
	 $contenu .= '<th>Suppression</th>';
	 $contenu .= '</th>';

	 while($ligne = $resultat ->fetch_assoc())
	 {
		 $contenu .= '<tr>';
		 foreach ($ligne as $indice => $information)
		 {
			 	if ($indice == "photo")
				{
					$contenu .= '<td><img src="'. $information . '"width ="70"
					height ="70"></td>';
			 	}
				else
				{
				$contenu .='<td>' .$information . '</td>';

				}
		}



		$contenu .='<td><a href="?action=modification&id_salle=' .$ligne[
		'id_salle'] . '"><img src="../inc/img/edit.png"></a></td>';
		$contenu .='<td><a href="?action=suppression&id_salle=' .$ligne[
		'id_salle'] . '"OnClick="return(confirm(\'En êtes vous certain?\'));"><img src="../inc/img/delete.png"></a></td>';
		$contenu .='</tr>';

	}
	$contenu .='</table><br><hr><br>';
}

require_once("../inc/haut.inc.php");
echo $contenu;

if(isset($_GET['action']) && ($_GET['action'] =='ajout' ||$_GET['action'] =='modification'))
{
	if(isset($_GET['id_produit']))
	{
		$resultat = executeRequete("SELECT* FROM salle WHERE id_salle =$_GET[id_salle]");
		$produit_actuel =$resultat->fetch_assoc(); // on rend les informations exploitable afin de les présaisir an les cases du formulaire.
	}

$id_salle = (isset($salle_actuel['id_salle'])) ? $salle_actuel['id_salle'] : '';
$titre = (isset($salle_actuel['titre'])) ? $salle_actuel['titre'] : '';
$description = (isset($salle_actuel['description'])) ? $salle_actuel['description'] : '';
$photo = (isset($salle_actuel['photo'])) ? $salle_actuel['photo'] : '';
$pays = (isset($salle_actuel['pays'])) ? $salle_actuel['pays'] : '';
$ville = (isset($salle_actuel['ville'])) ? $salle_actuel['ville'] : '';
$adresse = (isset($salle_actuel['adresse'])) ? $salle_actuel['adresse'] : '';
$cp = (isset($salle_actuel['cp'])) ? $salle_actuel['cp'] : '';
$capacite = (isset($salle_actuel['capacite'])) ? $salle_actuel['capacite'] : '';
$categorie = (isset($salle_actuel['categorie'])) ? $salle_actuel['categorie'] : '';

echo '<h1>Formulaire salle</h1>
	<form method="post" enctype="multipart/form-data" action="">

		<input type="hidden" id="id_salle" name="id_salle" value="' . $id_salle . '">

		<label for="titre">Titre</label><br>
		<input type="text" id="titre" name="titre" value="' . $titre . '"><br>
		<br>
		<label for="description">Description</label><br>
		<textarea id="description" name="description">' . $description . '</textarea><br>
		<br>
		<label for="pays">Pays</label><br>
		<input type="text" id="pays" name="pays" value="' .$pays . '"><br>
		<br>
		<label for="ville">ville</label><br>
		<input type="text" id="ville" name="ville" value="' .$ville . '"><br>
		<br>
		<label for="cp">Cp</label><br><br>
		<input type="text" id="cp" name="cp" value="' .$cp . '"><br>
		<br>
		<label for="photo">Photo</label><br>
		<input type="file" id="photo" name="photo" ><br><br>';
		if(!empty($photo))
		{
			echo '<i>Vous pouvez uploader une nouvelle photo si vous souhaitez la changer</i><br>';
			echo '<img src="'. $photo .'" width="90" height="90"><br>';
		}
		echo '
		<input type="hidden" name="photo_actuelle" id="photo_actuelle" id="photo_actuelle" value="'.$photo.'"><br>

		<label for="capacite">capacite</label><br>
		<input type="text" id="capacite" name="capacite" value="' . $capacite . '"><br>
		<br>
		<label for="categorie">categorie</label><br>
		<input type="text" id="categorie" name="categorie" value="' . $categorie . '"><br>
		<br>
		<input type="submit" value="'; echo ucfirst($_GET['action']).' de salle">
	</form>';
}
require_once("../inc/bas.inc.php");
