<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

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
