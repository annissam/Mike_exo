<?php
    class Voiture{ // Class = Objet

        /*
            public = TOUT les monde peu l'utiliser (Class, Heritage & Instance)
            private = Uniquement la class qui à accee (ex: class Voiture)
        */

        // Variable GLOBAL //
        private $mysqli;

        public function __construct(){ // Lancement a la création de l'instance
            $this->mysqli = new mysqli("localhost", "root", "", "voiture"); // new = Instance -> Recuperer tout les variables et les fonctions public de la class pour les mettre dans une variable.
        }

        public function enregistrer($nombrePorte, $laMarque, $leModele, $lAnnee, $nombrePlace, $laCouleur){

            $this->mysqli->query("INSERT INTO `vehicule`(`nbPorte`, `marque`, `modele`, `annee`, `nbPlace`, `couleur`) VALUES ( '$nombrePorte', '$laMarque', '$leModele', '$lAnnee', '$nombrePlace', '$laCouleur' )");
        }

        public function lecture(){
            $listeVehicule = $this->mysqli->query("SELECT * FROM vehicule");
            $tableauVehicule = $listeVehicule->fetch_all(MYSQLI_ASSOC);
            echo "<pre>";
            print_r($tableauVehicule);
            echo "</pre>";
        }

        public function supprimer($id){
            $this->mysqli->query("DELETE FROM `vehicule` WHERE id = $id");
        }

    }
    $vehicule = new Voiture();
    $vehicule->enregistrer($_POST["nbPorte"], $_POST["marque"], $_POST["modele"], $_POST["annee"], $_POST["nbPlace"], $_POST["couleur"]);
    // $vehicule->supprimer(3);
    // $vehicule->lecture();
?>
    <html>

    <head>
    </head>

    <body>
        <div>
            <form class="form-horizontal">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Ajouter un vehicule</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="marque">Marque du vehicule</label>
                        <div class="col-md-4">
                            <input id="marque" name="marque" type="text" placeholder="Audi" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="modele">Modèle du vehicule</label>
                        <div class="col-md-4">
                            <input id="modele" name="modele" type="text" placeholder="TT" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="annee">Année de creation</label>
                        <div class="col-md-4">
                            <input id="annee" name="annee" type="text" placeholder="2014" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="couleur">Couleur du vehicule</label>
                        <div class="col-md-4">
                            <input id="couleur" name="couleur" type="text" placeholder="Noir" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nbPlace">Nombre de place</label>
                        <div class="col-md-4">
                            <input id="nbPlace" name="nbPlace" type="text" placeholder="4" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nbPorte">Nombre de porte</label>
                        <div class="col-md-4">
                            <input id="nbPorte" name="nbPorte" type="text" placeholder="3" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="envoy">Validation</label>
                        <div class="col-md-4">
                            <button id="envoy" name="envoy" class="btn btn-success">Envoyer</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="script.js"></script>
    </body>

    </html>
