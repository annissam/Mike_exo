
//Ecrivez une classe representant une ville. elle doit avoir les propriétés nom et departement (private) et une methode affichant " la ville x est dans le departement Y ". Créez des objets ville, affectez leur propriétés, et utilisez la methode d'affichage. Ne pas oubliier les drivate

<?php
class Ville{
    private $nom; //on annonce les Variables
    private $departement;

public function __construct($nom, $departement){
    $this->nom = $nom;
    $this->departement = $departement;
}

public function infoVille(){
    $this->getNom();
    $this->getDepartement();
}

// GETTER = AFFICHER
public function getNom(){ // ça te permet d'afficher une phrase grace aux variables $nom et $departement
    echo "La ville de ".$this->nom.", ";
}
public function getDepartement(){
    echo "est dans le departement du ".$this->departement."<br/>";
}
// GETTER = MODIFIER
public function setnom($nom){
    $this->nom = $nom;
}
public function setdepartement($departement){
    $this->nom = $departement;
}
}

$pierrefitte = new Ville("Pierrefitte-sur-Seine", "93");// Pierrefitte-sur-Seine = $nom , 93 = $departement
$paris = new Ville("Paris", "75");
$pierrefitte->infoVille();
$paris->infoVille();

 ?>
