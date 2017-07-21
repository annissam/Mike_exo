<?php
    class Humain{

        private $nom;
        private $prenom;
        private $age;
        private $sexe;

        public function __construct($new_nom, $new_prenom, $new_age = 23, $new_sexe = "Homme"){

            $error = "<h1>";

            if(strlen($new_nom) <= 20 && strlen($new_nom) > 1)
                $this->nom = $new_nom;
            else
                $error .= "Votre nom (".$new_nom.") n'est pas conforme! <br/>";
            if(strlen($new_prenom) <= 20 && strlen($new_prenom) > 1)
                $this->prenom = $new_prenom;
            else
                $error .= "Votre prenom (".$new_prenom.") n'est pas conforme! <br/>";
                
            $this->age = $new_age;
            $this->sexe = $new_sexe;

            echo $error."</h1>";
        }

        public function carteDidentite(){
            $this->getNom();
            $this->getPrenom();
            $this->getAge();
            $this->getSexe();
        }

        // GETTER => AFFICHER
        public function getNom(){
            echo "Nom : ".$this->nom."<br/>";
        }
        public function getPrenom(){
            echo "Prenom : ".$this->prenom."<br/>";
        }
        public function getAge(){
            echo "Age : ".$this->age."<br/>";
        }
        public function getSexe(){
            echo "Sexe : ".$this->sexe."<br/>";
        }

        // SETTER = MODIFIER
        public function setNom($new_nom){
            $this->nom = $new_nom;
        }
        public function setPrenom($new_prenom){
            $this->prenom = $new_prenom;
        }
        public function setAge($new_age){
            $this->age = $new_age;
        }
        public function setSexe($new_sexe){
            $this->sexe = $new_sexe;
        }

    }

    $Mike = new Humain("Sylvestre", "Mike", 30, "HOMME");
    $Cedric = new Humain("NgonangNgonangNgonangNgonang", "Cedric", 16, "homme");
    $Mike->carteDidentite();
    $Cedric->setAge(18);
    $Cedric->carteDidentite();