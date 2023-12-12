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

if (isset($_GET['idupv'])) {
    $voitureId = $_GET['idupv'];

    // Effectuez une requête pour récupérer les données du constructeur
    $voitureQuery = $bdd->prepare('SELECT * FROM ApiVoitures WHERE id = :id');
    $voitureQuery->bindParam(':id', $voitureId, PDO::PARAM_INT);
    $voitureQuery->execute();

    $voiture = $voitureQuery->fetch(PDO::FETCH_ASSOC);

    // Retournez les données au format JSON
    header('Content-Type: application/json');
    echo json_encode($voiture);
} else {
    // Gérez le cas où l'ID du constructeur n'est pas spécifié
    // Vous pouvez renvoyer une réponse d'erreur ou une réponse vide, selon vos besoins.
}
