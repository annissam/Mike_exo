<?php
    class Animal{
        private $nom;

        public function deplacement($type){
            echo "Je suis un ".$this->nom." me déplace en ".$type;
        }
    }

    class Aigle extends Animal{

        public $type = "vol";

    }

    $royal = new Aigle();
    $royal->nom = "Aigle royal";
    $royal->deplacement($royal->type);