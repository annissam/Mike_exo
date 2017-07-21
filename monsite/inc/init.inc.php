<?php
//----------------- BDD
$mysqli = new Mysqli("localhost", "root", "", "monsite");
if($mysqli->connect_error)die("Un problème est survenu lors de la tentative de connexion à la BDD : " . $mysqli->connect_error);

//----------------- SESSION
session_start(); // on ouvre et on crée une session

//----------------- CHEMIN
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/monsite/");
define("URL", 'http://localhost/monsite/');

//----------------- VARIABLES
$contenu = '';

//----------------- AUTRES INCLUSIONS
require_once("fonctions.inc.php");



