<?php
/*require_once("inc/init.inc.php");
if(!internauteEstConnecte())// si le membre n'est pas connecté, il ne doit pas avoir accés à la page profil
{
	header("location:connexion.php");
}
// Exercice : Afficher sur la pagfe profil, le pseudo, email, ville, code postal, adresse du membre connecté en passant par le fichier $_SESSION
//debug($_SESSION);// dès lors que le session_start est inscrit, les sessions sont disponible sur toutes les pages du site

$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p><br>';
$contenu .= '<div class="cadre"><h2>Voici vos informations de profil</h2>';
$contenu .= '<p> Votre email est : ' . $_SESSION['membre']['email'] . '<br>';
$contenu .= 'Votre ville est : ' . $_SESSION['membre']['ville'] . '<br>';
$contenu .= 'Votre code postal est : ' . $_SESSION['membre']['code_postal'] . '<br>';
$contenu .= 'Votre adresse est : ' . $_SESSION['membre']['adresse'] . '</p></div><br>';
$contenu .= '<a href="fiche_produit.php?id_produit='.
require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");
*/
//suppression du compte utilisateur

require_once("inc/init.inc.php");
if(!internauteEstConnecte())// si le membre n'est pas connecté, il ne doit pas avoir accés à la page profil
{
	header("location:connexion.php");
}
// Exercice : Afficher sur la pagfe profil, le pseudo, email, ville, code postal, adresse du membre connecté en passant par le fichier $_SESSION
//debug($_SESSION);// dès lors que le session_start est inscrit, les sessions sont disponible sur toutes les pages du site

$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p><br>';
$contenu .= '<div class="cadre"><h2>Voici vos informations de profil</h2>';
$contenu .= '<p> Votre email est : ' . $_SESSION['membre']['email'] . '<br>';

require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");
 ?>
