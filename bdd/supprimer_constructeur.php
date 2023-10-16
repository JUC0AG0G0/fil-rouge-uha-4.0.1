<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "Fil_Rouge_Jules_Conrneille";
$mot_de_passe = "1234";
$base_de_donnees = "fil_rouge_401_Corneille_Jules";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['supprimer'])) {
    // Récupérer l'ID de la voiture à supprimer depuis le formulaire
    $idASupprimer = $_POST['suppr_voiture'];

    // Préparation de la requête SQL de suppression
    $requete = "DELETE FROM ApiVoitures WHERE constructeur = ?";
    $requete = "DELETE FROM ApiConstructeur WHERE id = ?";


    // Préparation de la requête
    if ($stmt = $connexion->prepare($requete)) {
        // Liaison des paramètres
        $stmt->bind_param("i", $idASupprimer);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "L'entrée avec l'ID $idASupprimer a été supprimée avec succès.";
        } else {
            echo "Échec de la suppression : " . $stmt->error;
        }

        // Fermeture du statement
        $stmt->close();
    } else {
        echo "Échec de la préparation de la requête : " . $connexion->error;
    }
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
