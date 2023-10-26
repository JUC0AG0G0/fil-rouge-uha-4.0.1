<?php

require_once './config.php';

// Utilisation des constantes pour se connecter à la base de données
$serveur = DB_SERVER;
$utilisateur = DB_USER;
$mot_de_passe = DB_PASSWORD;
$base_de_donnees = DB_NAME;


$bdd = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees.'', $utilisateur, $mot_de_passe);

$api_voitures = $bdd->prepare('SELECT * FROM ApiVoitures ORDER BY nom ASC');

$excuteIsOk = $api_voitures->execute();

$voitures = $api_voitures->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode($voitures);


?>