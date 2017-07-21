<?php
require "formulaire.php";
$mydb = new Post("localhost", "root", "", "voiture");
$post = new Post("localhost", "root", "", "voiture", 1);

    if(!empty($_POST)){
        if(empty($_POST["marque"]))
            echo "Veuillez indiquer la marque du vehicule";
        elseif(empty($_POST["modele"]))
            echo "Veuillez indiquer le modele du vehicule";
        elseif(empty($_POST["annee"]))
            echo "Veuillez indiquer l'annee du vehicule";
        elseif(empty($_POST["nb_porte"]))
            echo "Veuillez indiquer le nombre de porte souhaitez";

        elseif(empty($_POST["couleur"]))
            echo "Veuillez indiquer la couleur du vehicule";
        elseif(empty($_POST["nb_place"]))
            echo "Veuillez indiquer le nombre de place souhaitez";
        else{
            $mydb->create($_POST, "post");
            echo '<ul class="list-group">
                <li class="list-group-item list-group-item-success">Votre modele de voiture a été ajouter</li>
            </ul>';
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Formulaire mysqli</title>
	<style>
		label{float: left; width: 95px; font-style: italic; font-family: Calibri;}
		h1{margin: 0 0 10px 200px; font-family: Calibri;}
	</style>
</head>
	<body>
		<hr>
		<h1>Formulaire voiture</h1>
		<form method="post" action=""><!-- method : comment vont circuler les données ? - action: url de destination -->
			<label for="marque">Marque</label>
			<input type="text" id="marque" name="marque"><br><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
			<br>
			<label for="modele">Modele</label>
			<input type="text" id="modele" name="modele"><br><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
			<br>
			<label for="annee">Annee</label>
			<input type="date" id="annee" name="annee"><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
            <br>
			<br>
			<label for="nb_porte">nb porte</label>
			<input type="number" id="nb_porte" name="nb_porte"><br><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
			<br>
			<label for="couleur">Couleur</label>
			<input type="text" id="couleur" name="couleur"><br><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
			<br><br>
			<label for="nb_place">Nb place</label>
			<input type="text" id="nb_place" name="nb_place"><br><!-- il ne faut surtout pas oublier les name sur le formulaire HTML -->
			<br>
			<input type="submit" value="envoi">
		</form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="scripts/script.js"></script>
	</body>
<html>
