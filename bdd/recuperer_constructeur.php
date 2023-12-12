<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './config.php';

// Utilisation des constantes pour se connecter à la base de données
$serveur = DB_SERVER;
$utilisateur = DB_USER;
$mot_de_passe = DB_PASSWORD;
$base_de_donnees = DB_NAME;

$bdd = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees.'', $utilisateur, $mot_de_passe);

if (isset($_GET['id'])) {
    $constructeurId = $_GET['id'];

    // Effectuez une requête pour récupérer les données du constructeur
    $constructeurQuery = $bdd->prepare('SELECT * FROM ApiConstructeur WHERE id = :id');
    $constructeurQuery->bindParam(':id', $constructeurId, PDO::PARAM_INT);
    $constructeurQuery->execute();

    $constructeur = $constructeurQuery->fetch(PDO::FETCH_ASSOC);

    // Retournez les données au format JSON
    header('Content-Type: application/json');
    echo json_encode($constructeur);
} else {
    // Gérez le cas où l'ID du constructeur n'est pas spécifié
    // Vous pouvez renvoyer une réponse d'erreur ou une réponse vide, selon vos besoins.
}
