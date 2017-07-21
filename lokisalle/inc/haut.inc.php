<!DOCTYPE html>
<html>
	<head>
		<title>Lokisalle</title>
		<link rel="stylesheet" href="\lokisalle\inc\css\style.css">
	</head>
	<body>
		<header>
			<div class="conteneur">
				<span>
					<a href="" title="lokisalle">Lokisalle</a>
				</span>
				<nav>
					<?php
					if(internauteEstConnecteEtEstAdmin())
					{
						echo '<a href="' . URL . 'admin/gestion_membre.php">Gestion des membres</a>';
						echo '<a href="' . URL . 'admin/gestion_produit.php">Gestion des produit</a>';
						echo '<a href="' . URL . 'admin/gestion_salle.php">Gestion des salle</a>';
						echo '<a href="' . URL . 'admin/gestion_avis.php">Gestion des avis</a>';
						echo '<a href="' . URL . 'admin/gestion_commande.php">Gestion des commandes</a>';
					}
					if(internauteEstConnecte())// if et non elseif afin que cette condition s'applique aux membres et aux admin
					{
						echo '<a href="' . URL . 'profil.php">Voir votre profil</a>';
						echo '<a href="' . URL . 'boutique.php">Accés à la boutique</a>';
						echo '<a href="' . URL . 'panier.php">Voir votre panier</a>';
						echo '<a href="' . URL . 'connexion.php?action=deconnexion">Se déconnecter</a>';
					}
					else // visiteur
					{
						echo '<a href="' . URL . 'inscription.php">Inscription</a>';
						echo '<a href="' . URL . 'connexion.php">Connexion</a>';
						echo '<a href="' . URL . 'boutique.php">Accés à la boutique</a>';
						echo '<a href="' . URL . 'panier.php">Voir votre panier</a>';
					}
					// visiteur = 4 liens
					// membre = 4 liens
					// admin = 7 liens
					?>
				</nav>
			</div>
		</header>
		<section>
			<div class="conteneur">
