
<?php
 ?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Vehicule</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>
	<header>
		<section id="header">
			<div class="container">

				<div id="success" class="alert alert-success hidden">
					<strong>Success!</strong>
					 Formulaire envoyer.
				</div>
				<div id="danger" class="alert alert-danger hidden">
					<strong>Danger!</strong>
					 Indicates a dangerous or potentially negative action.
				</div>
				<div class="col-lg-4 col-lg-offset-4 mt centered" style="width: 100%;margin-left: 0%;">
					<h4>Ajouter un vehicule</h4>
				</header>
				<body>
					<div class="row">
                        <div class="col-lg-push-3 col-lg-9">
    						<form method="post" id="formulaire">
    							<label for="marque">Marque</label>
    							<br>
    							<input type="text" id="marque" value="test" name="marque" maxlength="20" required="required">
    							<br>
    							<br>
    							<label for="modele">Modele</label>
    							<br>
    							<input type="text" id="modele" value="test" name="modele" required="required">
    							<br>
    							<br>
    							<label for="annee">Année</label>
    							<br>
    							<input type="text" id="annee" value="test" name="annee">
    							<br>
    							<br>
    							<label for="couleur">Couleur</label>
    							<br>
    							<input type="text" id="couleur" value="test" name="couleur">
    							<br>
    							<br>
    							<button type="submit" class="btn btn-default">Envoyé</button>
    						</form>
                        </div>
					</div>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                    <script>
                    $( "#formulaire" ).submit(function(event){

                        event.preventDefault();

                        let marque  = $('#marque').val();
                        let modele  = $('#modele').val();
                        let annee   = $('#annee').val();
                        let couleur = $('#couleur').val();

                        $.ajax({
                          url: "traitement.php",
                          type : "POST",
                          data : {
                              marque : marque,
                              modele : modele,
                              annee  : annee,
                              couleur: couleur
                          }
                      }).done(function(resultat) {

                          console.log(resultat)

                      }).fail(function(log) {
                            console.log(log)
                          })

                    });
                    </script>
				</body>
			</html>
