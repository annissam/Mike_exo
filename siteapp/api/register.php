<?php
    echo "Annissa";

    class Personne{
        public $nom ="";
        public $prenom="";
        public $poste="";


        function _construct($nom, $prenom){
            $this->nom=$nom;
            $this->prenom =$prenom;
        }
        public function emploi($sonEmploi){

            $this->poste = $sonEmploi;

        }
    }

$Annissa = new Personne();
$Annissa->prenom ="Annissa";
$Annissa->nom ="Mekiri";

echo $Annissa-> nom;

// $Annissa = new Personne("")


?>
