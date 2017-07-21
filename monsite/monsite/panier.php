<?php
require_once("inc/init.inc.php");
//------ TRAITEMENT PHP-----------//
//-- AJOUT PANIER -----//
if(isset($_POST['ajout_panier']))
{
	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");
	$produit = $resultat->fetch_assoc();
	ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}

debug($_SESSION);
//------------ AFFICHAGE HTML ----------------------//
require_once("inc/haut.inc.php");

echo "<table border='1' style='border-collapse:collapse;' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
if(empty($_SESSION['panier']['id_produit']))
{
	echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		echo "<tr>";
		echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
		echo "</tr>";
	}
	echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . "</td></tr>";
	if(internauteEstConnecte())
	{
		echo '<form method="post" action="">';
		echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
		echo '</form>';
	}
	else
	{
		echo '<tr><td colspan="5">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
	}
	echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
}
echo "</table><br>";
echo "<i>Réglement par chèque uniquement à l'adresse suivante : 45 rue des vieilles tuileries 78950 GAMBAIS</i>";


require_once("inc/bas.inc.php");