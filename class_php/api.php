<?php
    require "crud.php"; // Chargement de la class crud.php
    $mydb = new Crud("localhost", "root", "", "projetapp"); // Création de l'instance mydb
    if(empty($_POST))
        $post = $mydb->read( array("*"), "posts", array("1"=>"1") ); // Execusion de la function read (Select)
    else{
        if($_POST["type"] == "Select")
            $post = $mydb->read( array("*"), "posts", array("id"=>$_POST["id_post"]) ); // Execusion de la function read (Select)
        elseif($_POST["type"] == "Update"){
            unset($_POST["type"]);
            $id = $_POST["id_post"];
            unset($_POST["id_post"]);
            $post = $mydb->update( $_POST, "posts", array("id"=>$id));
        }elseif($_POST["type"] == "Delete"){
            $id = $_POST["type"] == "Delete"{
                $_post =$mydb->delete ("posts", arrayy("id"=>$id));
            }
        }
    }
    echo json_encode($post); // Affichage du tableau php en format json
