<?php
//----------------- BDD
$mysqli = new Mysqli("localhost", "root", "", "lokisalle");
$mysqli->set_charset("utf8");
if($mysqli->connect_error)die("Un probleme est survenu lors de la tentative de connexion de la BDD : " . $mysqli->connect_error);

//----------------- SESSION
session_start();

//----------------- CHEMIN
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "htdocs/lokisalle/");
define("URL", 'http://localhost/lokisalle/');

//----------------- VARIABLES
$contenu = '';

//----------------- AUTRES INCLUSIONS
require_once("fonctions.inc.php");
