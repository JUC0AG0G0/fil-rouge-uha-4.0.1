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
    // echo "La connexion a bien été établie";
} catch (PDOException $e) {
    // echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

if (isset($_POST["ajouterc"])) {
    $nom = $_POST['nom'];
    $creation = $_POST['creation'];
    $fondateur = $_POST['fondateur'];
    $pays = $_POST['pays'];

    // Emplacement des fichiers de destination
    $logoDestination = './img/logo_marque/';
    $videoDestination = './video/marques/';

    // Vérifie si le fichier "logo" a été soumis
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logoFileName = $nom . '.' . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION); // Renomme le fichier avec le nom du formulaire
        $logoTempFile = $_FILES['logo']['tmp_name'];
        $logoFilePath = $logoDestination . $logoFileName;
    } else {
        // echo "Erreur : Le fichier du logo n'a pas été correctement soumis.";
        exit;
    }

    // Vérifie si le fichier "video" a été soumis
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $videoFileName = $nom . '.' . pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION); // Renomme le fichier avec le nom du formulaire
        $videoTempFile = $_FILES['video']['tmp_name'];
        $videoFilePath = $videoDestination . $videoFileName;
    } else {
        // echo "Erreur : Le fichier de la vidéo n'a pas été correctement soumis.";
        exit;
    }

    // Vérifiez si les répertoires de destination existent, sinon, créez-les
    if (!file_exists($logoDestination)) {
        mkdir($logoDestination, 0777, true);
    }
    if (!file_exists($videoDestination)) {
        mkdir($videoDestination, 0777, true);
    }

    // Affichez des messages de débogage pour vérifier les valeurs
    // echo "Nom: " . $nom . "<br>";
    // echo "Année de création: " . $creation . "<br>";
    // echo "Fondateur: " . $fondateur . "<br>";
    // echo "Pays d'origine: " . $pays . "<br>";

    // echo "Nom du fichier du logo: " . $logoFileName . "<br>";
    // echo "Nom du fichier de la vidéo: " . $videoFileName . "<br>";

    // Déplacez les fichiers téléchargés vers les répertoires de destination
    if (move_uploaded_file($logoTempFile, $logoFilePath) && move_uploaded_file($videoTempFile, $videoFilePath)) {
        // echo "Fichiers téléchargés avec succès.<br>";
        // Les fichiers ont été téléchargés avec succès, ajoutez maintenant les données à la base de données
        $sql = "INSERT INTO `ApiConstructeur`(`nom`, `creation`, `fondateur`, `pays`) VALUES (:nom, :creation, :fondateur, :pays)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':creation', $creation);
        $stmt->bindParam(':fondateur', $fondateur);
        $stmt->bindParam(':pays', $pays);


        try {
            $stmt->execute();
            // echo "Constructeur ajouté avec succès.";
        } catch (PDOException $e) {
            // echo "Erreur lors de l'ajout du constructeur : " . $e->getMessage();
        }
    } else {
        // echo "Erreur lors du téléchargement des fichiers.";
    }
}

if (isset($_POST["ajouterv"])) {
    $nomv = $_POST['nomv'];
    $descriptionv = $_POST['descriptionv'];
    $constructeurv = $_POST['constructeurv'];
    $productionv = $_POST['productionv'];
    $imagev = $_POST['imagev'];

    $sql = "INSERT INTO `ApiVoitures`(`nom`, `description`, `constructeur`, `production`, `image`) VALUES (:nomv, :descriptionv, :constructeurv, :productionv, :imagev)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nomv', $nomv);
    $stmt->bindParam(':descriptionv', $descriptionv);
    $stmt->bindParam(':constructeurv', $constructeurv);
    $stmt->bindParam(':productionv', $productionv);
    $stmt->bindParam(':imagev', $imagev);

    try {
        $stmt->execute();
        // echo "Constructeur ajouté avec succès.";
    } catch (PDOException $e) {
        // echo "Erreur lors de l'ajout du constructeur : " . $e->getMessage();
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
    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Nom :</h2>
        <input type="text" name="nom" />

        <h2>Année de création :</h2>
        <input type="number" name="creation" min="1000" max="9999" />

        <h2>Fondateur :</h2>
        <input type="text" name="fondateur" />

        <h2>Pays d'origine :</h2>
        <select name="pays">
            <?php foreach ($payscontinent as $pays) : ?>
                <option value="<?php echo $pays['nom_pays']; ?>"><?php echo $pays['nom_pays']; ?></option>
            <?php endforeach; ?>
        </select>

        <h2>Logo :</h2>
        <input type="file" name="logo" accept=".svg" />

        <h2>Video :</h2>
        <input type="file" name="video" accept=".mp4" />

        <br><br>

        <input type="submit" name="ajouterc" value="Ajouter ce constructeur"/>
    </form>

    <h1>Ajout de Voiture</h1>
    <form method="POST" action="">
        <h2>Nom :</h2>
        <input type="text" name="nomv" required />

        <h2>Description :</h2>
        <input type="text" name="descriptionv" required />

        <h2>Constructeur :</h2>
        <select name="constructeurv" required>
            <?php foreach ($constructeurs as $constructeur) : ?>
                <option value="<?php echo $constructeur['id']; ?>"><?php echo $constructeur['nom']; ?></option>
            <?php endforeach; ?>
        </select>

        <h2>Production :</h2>
        <input type="number" name="productionv" min="1" required />

        <h2>Image :</h2>
        <input type="url" name="imagev" required />

        <input type="submit" name="ajouterv" value="Ajouter"/>
    </form>
</body>
</html>
