créez une classe representant une personne. Elle doit avoir les propretés nom, prenom et adresse tout les propriete doivent etre private, ainsi qu'un constructeur et un destructeur en public. Une methode getpersonne() doit retourner les coordonnées complètes de la personne.Une methode setadresse() doit permettre de mofidier l'adresse de la personne.Créez des objets personnes,et utilisez l'ensemble des methodes.

<?php
class Personne{
    private $nom;
    private $prenom;
    private $adresse;
}
$this->nom=$nom;
$this->prenom=prenom;
$this->setAdress($jordanAdress;);
}

public function setAdress($newAdresse){
    $this->adresse = $newAdresse;
}

public function getPersonne(){
    echo "Nom".$this->nom."</br>";
    echo "Prenom".$this->prenom."</br>";
    echo "Adresse".$this->adresse."</br>";
}

public function __destruct(){
    echo "User delete";
}
}
$Mike = new Personne("Mike", "Sylvestre","1 rue Paolo Ucello, 77400")
$Mike ->getPersonne();
 ?>
