<?php
// Établissez une connexion à votre base de données
$serveur = "localhost";
$utilisateur = "Fil_Rouge_Jules_Conrneille";
$mot_de_passe = "1234";
$base_de_donnees = "fil_rouge_401_Corneille_Jules";

try {
    $conn = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["suppr_constructeur"])) {
        $constructeur_id = $_POST["suppr_constructeur"];

        // Supprimez la ligne correspondant à l'ID sélectionné
        $sql = "DELETE FROM LinkUsines WHERE id_constructeurs = :id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $constructeur_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Ligne supprimée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la ligne: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["suppr_constructeur"])) {
        $constructeur_id = $_POST["suppr_constructeur"];

        // Supprimez la ligne correspondant à l'ID sélectionné
        $sql = "DELETE FROM ApiVoitures WHERE constructeur = :id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $constructeur_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Ligne supprimée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la ligne: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["suppr_constructeur"])) {
        $constructeur_id = $_POST["suppr_constructeur"];

        // Supprimez la ligne correspondant à l'ID sélectionné
        $sql = "DELETE FROM ApiConstructeur WHERE id = :id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $constructeur_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Ligne supprimée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la ligne: " . $e->getMessage();
        }
    }
}

// Fermez la connexion à la base de données
$conn = null;
?>
