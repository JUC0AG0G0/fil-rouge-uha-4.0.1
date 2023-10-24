<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

$constructeurQuery = $bdd->prepare('SELECT id, nom FROM ApiConstructeur ORDER BY nom ASC');
$constructeurQuery->execute();
$constructeurs = $constructeurQuery->fetchAll();

$voitureQuery = $bdd->prepare('SELECT id, nom FROM ApiVoitures ORDER BY nom ASC');
$voitureQuery->execute();
$voitures = $voitureQuery->fetchAll();

$payscontinentQuery = $bdd->prepare('SELECT nom_pays FROM ApiContinent ORDER BY nom_pays ASC');
$payscontinentQuery->execute();
$payscontinent = $payscontinentQuery->fetchAll();

$serveur = "localhost";
$utilisateur = "Fil_Rouge_Jules_Conrneille";
$mot_de_passe = "1234";
$base_de_donnees = "fil_rouge_401_Corneille_Jules";

try {
    $conn = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "La connexion a bien été établie";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

if (isset($_POST["ajouterc"])) {
    $nom = $_POST['nom'];
    $creation = $_POST['creation'];
    $fondateur = $_POST['fondateur'];
    $pays = $_POST['cars']; // Utilisez le nom correct du champ de sélection

    $sql = "INSERT INTO `ApiConstructeur`(`nom`, `creation`, `fondateur`, `pays`) VALUES (:nom, :creation, :fondateur, :pays)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':creation', $creation);
    $stmt->bindParam(':fondateur', $fondateur);
    $stmt->bindParam(':pays', $pays);

    try {
        $stmt->execute();
        echo "Constructeur ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du constructeur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test 12</title>
</head>
<body>
    <form method="POST" action="">
        <h2>Nom :</h2>
        <input type="text" name="nom" />

        <h2>Année de création :</h2>
        <input type="number" name="creation" min="1000" max="9999" />

        <h2>Fondateur :</h2>
        <input type="text" name="fondateur" />

        <h2>Pays d'origine :</h2>
        <select name="cars"> <!-- Utilisez le nom correct du champ de sélection -->
            <?php foreach ($payscontinent as $pays) : ?>
                <option value="<?php echo $pays['nom_pays']; ?>"><?php echo $pays['nom_pays']; ?></option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <input type="submit" name="ajouterc" value="Ajouter ce constructeur"/>
    </form>
</body>
</html>
