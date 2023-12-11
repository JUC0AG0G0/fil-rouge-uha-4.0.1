<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './config.php';

$serveur = DB_SERVER;
$utilisateur = DB_USER;
$mot_de_passe = DB_PASSWORD;
$base_de_donnees = DB_NAME;

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

if (isset($_POST['ajouterv'])) {
    $nomVoiture = $_POST['nomv'];
    $descriptionVoiture = $_POST['descriptionv'];
    $constructeurVoiture = $_POST['constructeurv'];
    $productionVoiture = $_POST['productionv'];
    $imageVoiture = $_POST['imagev'];

    $requete = "INSERT INTO ApiVoitures (nom, description, constructeur, production, image) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $connexion->prepare($requete)) {
        $stmt->bind_param("sssds", $nomVoiture, $descriptionVoiture, $constructeurVoiture, $productionVoiture, $imageVoiture);

        if ($stmt->execute()) {
            echo "La voiture a été ajoutée avec succès.";
        } else {
            echo "Échec de l'ajout de la voiture : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Échec de la préparation de la requête : " . $connexion->error;
    }
}

$connexion->close();
?>
