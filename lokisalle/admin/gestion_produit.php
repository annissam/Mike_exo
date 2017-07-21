<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
//debug($_POST);
//----------SUPPRESSION ------------------//
if (isset($_GET ['action']) &&$_GET ['action'] == 'suppression')
{
	$contenu.= '<div class="validation">Suppression du produit : '.$_GET['id_produit'] . '</div>';
	executeRequete("DELETE FROM produit WHERE id_produit ='$_GET[id_produit]'");
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
	produit(id_sproduit,date_arrivee ,date_depart ,prix ,etat)VALUES('$_POST[id_salle]','$_POST[date_arrivee]','$_POST[date_depart]','$_POST[prix]','$_POST[etat]')");
}
//----------------LIEN SALLE--------------------
$contenu .='<a href="?action=affichage"> Affichage des produit</a><br>';
$contenu .='<a href="?action=ajout">Ajout d\'une salle </a><br><br><hr><br>';

//-------------------AFFICHAGE SALLE----------
if(isset($_GET['action']) && $_GET ['action'] == 'affichage')
{
	$resultat = executeRequete("SELECT * FROM produit");

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

if(isset($_GET['action']) && ($_GET['action'] =='ajout' ||($_GET['action'] =='modification')))
{
	if(isset($_GET['id_salle']))
	{
		$resultat = executeRequete("SELECT* FROM produit WHERE id_produit =$_GET[id_salle]");
		$salle_actuel =$resultat->fetch_assoc(); // on rend les informations exploitable afin de les présaisir an les cases du formulaire.
	}

$id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : '';
$date_arrivee = (isset($salle_actuel['date_arrivee'])) ? $produit_actuel['date_arrivee'] : '';
$date_depart = (isset($salle_actuel['date_depart'])) ? $produit_actuel['date_depart'] : '';
$prix = (isset($produit_actuel['prix'])) ? $produit_actuel['prix'] : '';
$etat = (isset($produit_actuel['etat'])) ? $produit_actuel['etat'] : '';


echo '<h1>Formulaire salle</h1>
	<form method="post" enctype="multipart/form-data" action="">
		<label for="id_produit">Salle</label><br>
		<input type="hidden" id="id_produit" name="id_produit" value="' . $id_produit . '">

		<label for="date_arrivee">Date arrivee</label><br>
		<input type="date" id="date_arrivee" name="date_arrivee" value="' . $date_arrivee . '"><br>
		<br>

		<label for="date_depart">Date depart</label><br>
		<input type="date" name="date_depart">' . $date_depart . '</textarea><br>
		<br>

		<label for="prix">Prix</label><br>
		<input type="text" id="prix" name="prix" value="' .$prix . '"><br>
		<br>

		<label for="etat">Etat</label><br>
		<input type="text" id="etat" name="etat" value="' .$etat . '"><br>
		<br>

		<input type="submit" value="'; echo ucfirst($_GET['action']).' de salle">
	</form>';
}
require_once("../inc/bas.inc.php");
