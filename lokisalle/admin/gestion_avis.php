<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
//debug($_POST);
//----------SUPPRESSION ------------------//
if (isset($_GET ['action']) &&$_GET ['action'] == 'suppression')
{
	$contenu.= '<div class="validation">Suppression du salle : '.$_GET['id_avis'] . '</div>';
	executeRequete("DELETE FROM avis WHERE id_avis ='$_GET[id_avis]'");
	$_GET['action']='affichage';
}
//--------- ENREGISTREMENT SALLE ----//
if(!empty($_POST))
{
	// $photo_bdd = "";
	// if(!empty($_FILES['photo']['name']))
	// {
	// 	debug($_FILES);
	// 	$nom_photo = $_POST['categorie'] . '_' .$_FILES ['photo']['name'];
	// 	$photo_bdd = URL . "photo/$nom_photo";
	// 	$photo_dossier = RACINE_SITE. "/photo/$nom_photo";
	// 	copy($_FILES['photo']['tmp_name'],$photo_dossier);
	// }
	// foreach ($_POST as $indice => $valeur)
	// {
	// 	$_POST[$indice] = htmlEntities(addSlashes ($valeur));
	// }
	//Exercice : executez une requete d'insertion permettant d'inserer un produit dans la
	executeRequete("REPLACE INTO
	avis(id_avis,id_membre,id_salle,commentaire,note,date_enregistrement)VALUES('$_POST[id_avis]','$_POST[id_membre]','$_POST[id_salle]','$_POST[commentaire]','$_POST[note]','$_POST[date_enregistrement]')");
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



		$contenu .='<td><a href="?action=modification&id_avis=' .$ligne[
		'id_avis'] . '"><img src="../inc/img/edit.png"></a></td>';
		$contenu .='<td><a href="?action=suppression&id_avis=' .$ligne[
		'id_avis'] . '"OnClick="return(confirm(\'En êtes vous certain?\'));"><img src="../inc/img/delete.png"></a></td>';
		$contenu .='</tr>';

	}
	$contenu .='</table><br><hr><br>';
}

require_once("../inc/haut.inc.php");
echo $contenu;

if(isset($_GET['action']) && ($_GET['action'] =='ajout' ||$_GET['action'] =='modification'))
{
	if(isset($_GET['id_avis']))
	{
		$resultat = executeRequete("SELECT* FROM avis WHERE id_avis =$_GET[id_avis]");
		$avis_actuel =$resultat->fetch_assoc(); // on rend les informations exploitable afin de les présaisir an les cases du formulaire.
	}

$id_avis = (isset($avis_actuel['id_avis'])) ? $avis_actuel['id_avis'] : '';
$id_membre = (isset($avis_actuel['id_membre'])) ? $avis_actuel['id_membre'] : '';
$id_salle = (isset($avis_actuel['id_salle'])) ? $avis_actuel['id_salle'] : '';
$commentaire = (isset($avis_actuel['commentaire'])) ? $avis_actuel['commentaire'] : '';
$note = (isset($avis_actuel['note'])) ? $avis_actuel['note'] : '';
$date_enregistrement = (isset($avis_actuel['date_enregistrement'])) ? $avis_actuel['date_enregistrement'] : '';

}



// echo '<h1>Formulaire salle</h1>
// 	<form method="post" enctype="multipart/form-data" action="">
//
// 		<input type="hidden" id="id_salle" name="id_salle" value="' . $id_salle . '">
//
// 		<label for="date_arrivee">Date_arrivee</label><br>
// 		<input type="text" id="date_arrivee" name="titre" value="' . $titre . '"><br>
// 		<br>
// 		<label for="date_depart">Date_depart</label><br>
// 		<textarea id="date_depart" name="date_depart">' . $date_depart . '</textarea><br>
// 		<br>
// 		<label for="prix">Prix</label><br>
// 		<input type="text" id="prix" name="prix" value="' .$prix . '"><br>
// 		<br>
// 		<label for="etat">Etat</label><br>
// 		<input type="text" id="etat" name="etat" value="' .$etat . '"><br>
// 		<br>
//
// 		<input type="submit" value="'; echo ucfirst($_GET['action']).' de salle">
// 	</form>';
require_once("../inc/bas.inc.php");
?>
