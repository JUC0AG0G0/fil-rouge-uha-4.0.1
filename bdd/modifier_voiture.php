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

$voitureQuery = $bdd->prepare('SELECT id, nom FROM ApiVoitures ORDER BY nom ASC');
$voitureQuery->execute();
$voitures = $voitureQuery->fetchAll();

if (isset($_POST["modifier_voiture"])) {
    $voitureId = $_POST['voitureId'];
    $description = $_POST['descriptionupv'];
    $constructeur = $_POST['constructeurupv'];
    $production = $_POST['productionupv'];
    $image = $_POST['imageupv'];

    // Requête SQL pour mettre à jour la voiture
    $sql = "UPDATE ApiVoitures SET description = :description, constructeur = :constructeur, production = :production, image = :image WHERE id = :voitureId";
    
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':constructeur', $constructeur);
    $stmt->bindParam(':production', $production);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':voitureId', $voitureId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        // La mise à jour a réussi, redirigez l'utilisateur vers une page de confirmation ou ailleurs.
    } catch (PDOException $e) {
        // La mise à jour a échoué, gérez l'erreur, par exemple, renvoyez un message d'erreur.
        echo "Erreur lors de la mise à jour de la voiture : " . $e->getMessage();
    }
    header('Location: ../adminpage.php'); // Redirigez vers la même page
    exit; // Assurez-vous de quitter le script pour éviter l'exécution continue
}
?>
