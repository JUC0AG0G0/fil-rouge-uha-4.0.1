<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

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
