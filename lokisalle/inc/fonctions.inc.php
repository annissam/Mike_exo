<?php
/******************** FONCTIONS MEMBRES *****************/
function executeRequete($req)
{
	global $mysqli; // permet d'avoir accés à la variable $mysqli définie dans l'espace global à l'intérieur de notre fonction (espace local)
	$resultat = $mysqli->query($req);// on execute la requete reçu en argument
	if(!$resultat)
	{
		die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code : " . $req);// si la req échoue, on va mourrir(die) avec le message d'erreur
	}
	return $resultat; // on retourne un objet issu de la classe mysqli_result (en cas de requete SELECT, autre requete : true ou false)
}

//-------------------------------------------------------------
//debug($_POST);
function debug($var, $mode = 1) // cette fonction très pratique nous évitera d'avoir à faire des print_r et var_dump
{
	echo '<div style="background: orange; padding: 5px; float: right; clear: both;">';
	$trace = debug_backtrace();// Fonction prédéfinie retournant un tableau ARRAY contenant des infos tel que la ligne et le fichier où est executé la fonction
	$trace = array_shift($trace); // extrait le première valeur d'un tableau et la retourne.
	echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line]. <hr>";
	if($mode == 1)
	{
		echo "<pre>"; print_r($var); echo "</pre>";
	}
	else
	{
		echo "<pre>"; var_dump($var); echo "</pre>";
	}
	echo '</div>';
}

//-----------------------------------------------
function internauteEstConnecte()
{ // cette fonction m'indique si le membre est connecté. (une fonction retourne toujours false par défault)
 	if(!isset($_SESSION['membre'])) // si la session "membre" est non définie (elle ne peux être que définie si nous sommes passées par la page de connexion avec le bon mdp)
	{
		return false;
	}
	else
	{
		return true;
	}
}

//---------------------------------------------------
function internauteEstConnecteEtEstAdmin()
{ // cette fonction m'indique si le membre est admin
	if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la session membre est définie, nous regardons si il est admin, si c'est le cas, nous retournons true
	{
		return true;
	}
	return false;
}

//---------------- PANIER/COMMANDE/PAIEMENT -------------------//
function creationPanier()
{
	if(!isset($_SESSION['panier']))
	{
		$_SESSION['panier'] = array();
		$_SESSION['panier']['titre'] = array();
		$_SESSION['panier']['id_produit'] = array();
		$_SESSION['panier']['quantite'] = array();
		$_SESSION['panier']['prix'] = array();
	}
}
// Soit le panier n'existe pas, on  le cré, on retourne TRUE
// Soit le panier existe déja, on retourne directement TRUE
//----------------------------------------------
// cette fonction permet d'ajouter un produit dans le panier
function ajouterProduitDansPanier($id_salle,$id_produit,$quantite,$prix)
{// reception d'argument en provenance du panier.php
	creationPanier();
	// nous devons savoir si l'id_produit que l'on souhaite ajouter est déja présent dans la session du panier ou non
	$position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']); // retourne un chiffre si le produit existe
	// debug($position_produit);
	if($position_produit !== false)
	{
		$_SESSION['panier']['quantite'][$position_produit] += $quantite;// nous allons précisement à l'indice de ce produit etnous ajoutons la nouvelle quantité
	}
	else // sinon l'id_produit du produit n'existe pas dans le panier, on ajoute l'id_produit du produit dans un nouvel indice du tableau. les crochets [] permettent de mettre à l'indice suivant
	{
	$_SESSION['panier']['id_salle'][] = $titre;
	$_SESSION['panier']['id_produit'][] = $id_produit;
	$_SESSION['panier']['quantite'][] = $quantite;
	$_SESSION['panier']['prix'][] = $prix;
	}
}

//--------------------------------------------------
function montantTotal()
{
	$total = 0;
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)// tant que $i est inférieur au nombre de produit dans le panier
	{
		$total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on multiplie la quantite par le prix. ex 1*10€ ou 3*10 sans remplacer pour autant la dernière valeur contenu dans la variable $total
	}
	return round($total,2);// prix total pour tous les produits(2 chiffres aprés la virgule maxi)
}
