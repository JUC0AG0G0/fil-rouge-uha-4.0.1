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

$constructeurQuery = $bdd->prepare('SELECT id, nom FROM ApiConstructeur ORDER BY nom ASC');
$constructeurQuery->execute();
$constructeurs = $constructeurQuery->fetchAll();

$payscontinentQuery = $bdd->prepare('SELECT nom_pays FROM ApiContinent ORDER BY nom_pays ASC');
$payscontinentQuery->execute();
$payscontinent = $payscontinentQuery->fetchAll();

if (isset($_POST["modifier_constructeur"])) {
    $constructeurId = $_POST['constructeurId'];
    $creation = $_POST['creation'];
    $fondateur = $_POST['fondateur'];
    $pays = $_POST['pays'];

    // Requête SQL pour mettre à jour le constructeur
    $sql = "UPDATE ApiConstructeur SET creation = :creation, fondateur = :fondateur, pays = :pays WHERE id = :constructeurId";
    
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':creation', $creation);
    $stmt->bindParam(':fondateur', $fondateur);
    $stmt->bindParam(':pays', $pays);
    $stmt->bindParam(':constructeurId', $constructeurId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        // La mise à jour a réussi, redirigez l'utilisateur vers une page de confirmation ou ailleurs.
    } catch (PDOException $e) {
        // La mise à jour a échoué, gérez l'erreur, par exemple, renvoyez un message d'erreur.
        echo "Erreur lors de la mise à jour du constructeur : " . $e->getMessage();
    }
    header('Location: ../adminpage.php'); // Redirigez vers la même page
    exit; // Assurez-vous de quitter le script pour éviter l'exécution continue

}
