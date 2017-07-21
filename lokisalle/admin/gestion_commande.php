
<?php/*
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
//debug($_POST);
//----------SUPPRESSION ------------------//
if (isset($_GET ['action']) &&$_GET ['action'] == 'suppression')
{
	$contenu.= '<div class="validation">Suppression du salle : '.$_GET['id_commande'] . '</div>';
	executeRequete("DELETE FROM commande WHERE id_commande ='$_GET[id_commande]'");
	$_GET['action']='affichage';
}
//--------- ENREGISTREMENT SALLE ----//
if(!empty($_POST))
{
	// if(!empty($_FILES['photo']['name']))
	// {
		// debug($_FILES);
		// $nom_photo = $_POST['categorie'] . '_' .$_FILES ['photo']['name'];
		// $photo_bdd = URL . "photo/$nom_photo";
		// $photo_dossier = RACINE_SITE. "/photo/$nom_photo";
	// 	copy($_FILES['photo']['tmp_name'],$photo_dossier);
	// }
	foreach ($_POST as $indice => $valeur)
	{
		$_POST[$indice] = htmlEntities(addSlashes ($valeur));
	}
	executeRequete("REPLACE INTO
commande(id_commande,id_membre,id_produit,date_enregistrement)VALUES('$_POST[id_commande]','$_POST[id_membre]','$_POST[id_produit]','$_POST[date_enregistrement]')");

//-------------------AFFICHAGE SALLE----------
if(isset($_GET['action']) && $_GET ['action'] == 'affichage')
{
	$resultat = executeRequete("SELECT * FROM commande");

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
		$resultat = executeRequete("SELECT* FROM produit WHERE id_produit =$_GET[id_produit]");
		$produit_actuel =$resultat->fetch_assoc(); // on rend les informations exploitable afin de les présaisir an les cases du formulaire.
	}

$id_commande = (isset($salle_actuel['id_produit'])) ? $salle_actuel['id_produit'] : '';
$id_membre = (isset($salle_actuel['titre'])) ? $salle_actuel['titre'] : '';
$id_produit = (isset($salle_actuel['description'])) ? $salle_actuel['description'] : '';
$prix = (isset($salle_actuel['photo'])) ? $salle_actuel['photo'] : '';
$date_enregistrement = (isset($salle_actuel['pays'])) ? $salle_actuel['pays'] : '';


require_once("../inc/bas.inc.php");
*/
