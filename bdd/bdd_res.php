<?php
$serveur = "localhost";
$utilisateur = "Fil_Rouge_Jules_Conrneille";
$mot_de_passe = "jesaispasquoimettreenmotdepasse";
$base_de_donnees = "fil_rouge_401_Corneille_Jules";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifiez la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Exemple d'API à partir de JSONPlaceholder
$api_constructeur = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
$api_voitures = 'https://filrouge.uha4point0.fr/V2/car/voitures';


// Récupérez les données de l'API
$constructeur = file_get_contents($api_constructeur);
$voitures = file_get_contents($api_constructeur);


if (($constructeur !== false) or ($voitures !== false)) {
    $data_constructeur = json_decode($constructeur, true);
    $data_voitures = json_decode($voitures, true);

    foreach ($data_constructeur as $entry) {
        $id = $connexion->real_escape_string($entry['id']);
        $nom = $connexion->real_escape_string($entry['nom']);
        $creation = $connexion->real_escape_string($entry['creation']);
        $fondateur = $connexion->real_escape_string($entry['fondateur']);
        $usines = $connexion->real_escape_string($entry['usines']);
        $pays = $connexion->real_escape_string($entry['pays']);

        // echo '<div><span> nom : </span><span>' . htmlspecialchars($entry->nom, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> Creation : </span><span>' . htmlspecialchars($entry->creation, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> Fondateur : </span><span>' . htmlspecialchars($entry->fondateur, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> id : </span><span>' . htmlspecialchars($entry->id, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> pays : </span><span>' . htmlspecialchars($entry->pays, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        
        $sql = "INSERT INTO ApiConstructeur posts (id, nom, creation, fondateur, pays) VALUES ('$id', '$nom', '$creation', '$fondateur', '$pays')";
        
        if ($connexion->query($sql) === true) {
            echo "Données constructeur insérées avec succès dans la base de données.<br>";
        } else {
            echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
        }
    }
    foreach ($data_voitures as $entry) {

        $nom = $connexion->real_escape_string($entry['nom']);
        $description = $connexion->real_escape_string($entry['description']);
        $id = $connexion->real_escape_string($entry['id']);
        $constructeur = $connexion->real_escape_string($entry['constructeur']);
        $production = $connexion->real_escape_string($entry['production']);
        $image = $connexion->real_escape_string($entry['image']);

        // echo '<div><span> nom : </span><span>' . htmlspecialchars($entry->nom, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> description : </span><span>' . htmlspecialchars($entry->description, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> id : </span><span>' . htmlspecialchars($entry->id, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> constructeur : </span><span>' . htmlspecialchars($entry->constructeur, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
        // echo '<div><span> production : </span><span>' . htmlspecialchars($entry->production, ENT_QUOTES, 'UTF-8') . '</span></div><br>';


        $sql = "INSERT INTO ApiVoitures posts (nom, description, constructeur, production, image) VALUES ('$nom', '$description', '$id', '$constructeur', '$production', '$image')";
        
        if ($connexion->query($sql) === true) {
            echo "Données voitures insérées avec succès dans la base de données.<br>";
        } else {
            echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
        }
    }
} else {
    echo "Erreur lors de la récupération des données de l'API.";
}

$connexion->close();
?>