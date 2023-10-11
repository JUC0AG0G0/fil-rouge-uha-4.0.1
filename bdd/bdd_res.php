<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$serveur = "localhost";
$utilisateur = "Fil_Rouge_Jules_Conrneille";
$mot_de_passe = "1234";
$base_de_donnees = "fil_rouge_401_Corneille_Jules";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe);

// Vérifiez la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion au serveur MySQL : " . $connexion->connect_error);
}

// Supprimer la base de données si elle existe déjà
$drop_database_query = "DROP DATABASE IF EXISTS $base_de_donnees";
if ($connexion->query($drop_database_query) === true) {
    echo "La base de données existante a été supprimée avec succès.<br>";
} else {
    echo "Erreur lors de la suppression de la base de données existante : " . $connexion->error . "<br>";
}

// Créer une nouvelle base de données
$create_database_query = "CREATE DATABASE $base_de_donnees";
if ($connexion->query($create_database_query) === true) {
    echo "La nouvelle base de données a été créée avec succès.<br>";
} else {
    echo "Erreur lors de la création de la nouvelle base de données : " . $connexion->error . "<br>";
}

// Sélectionnez la base de données nouvellement créée
$connexion->select_db($base_de_donnees);

// Créer la table ApiConstructeur si elle n'existe pas
$create_table_constructeur_query = "CREATE TABLE IF NOT EXISTS ApiConstructeur (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    creation VARCHAR(4),   /* Utilisation du type de données VARCHAR(4) pour la colonne 'creation' */
    fondateur VARCHAR(255),
    pays VARCHAR(255)
)";
if ($connexion->query($create_table_constructeur_query) === true) {
    echo "Table ApiConstructeur créée ou existe déjà.<br>";
} else {
    echo "Erreur lors de la création de la table ApiConstructeur : " . $connexion->error . "<br>";
}

// Créer la table ApiVoitures si elle n'existe pas
$create_table_voitures_query = "CREATE TABLE IF NOT EXISTS ApiVoitures (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    description TEXT,
    id_constructeur INT,
    production VARCHAR(10),
    image VARCHAR(500)  /* Utilisation du type de données VARCHAR(500) pour la colonne 'image' */
)";

if ($connexion->query($create_table_voitures_query) === true) {
    echo "Table ApiVoitures créée ou existe déjà.<br>";
} else {
    echo "Erreur lors de la création de la table ApiVoitures : " . $connexion->error . "<br>";
}

// Exemple d'API à partir de JSONPlaceholder
$api_constructeur = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
$api_voitures = 'https://filrouge.uha4point0.fr/V2/car/voitures';

// Récupérez les données de l'API
$constructeur = file_get_contents($api_constructeur);
$voitures = file_get_contents($api_voitures);

if ($constructeur !== false && $voitures !== false) {
    $data_constructeur = json_decode($constructeur, true);
    $data_voitures = json_decode($voitures, true);

    // Première boucle pour insérer des données de constructeur
    foreach ($data_constructeur as $entry) {
        $id = $connexion->real_escape_string($entry['id']);
        $nom = $connexion->real_escape_string($entry['nom']);
        $creation = $connexion->real_escape_string($entry['creation']);
        $fondateur = $connexion->real_escape_string($entry['fondateur']);
        $pays = $connexion->real_escape_string($entry['pays']);

        // Vérifiez si l'ID existe déjà dans la table ApiConstructeur
        $existing_query = "SELECT id FROM ApiConstructeur WHERE id = '$id'";
        $existing_result = $connexion->query($existing_query);

        if ($existing_result->num_rows == 0) {
            $sql = "INSERT INTO ApiConstructeur (id, nom, creation, fondateur, pays) VALUES ('$id', '$nom', '$creation', '$fondateur', '$pays')";

            if ($connexion->query($sql) === true) {
                echo "Données constructeur insérées avec succès dans la base de données.<br>";
            } else {
                echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
            }
        } else {
            echo "L'entrée avec l'ID $id existe déjà dans la table ApiConstructeur.<br>";
        }
    }

    // Deuxième boucle pour insérer des données de voiture
    foreach ($data_voitures as $entry) {
        $id = $connexion->real_escape_string($entry['id']);
        $nom = $connexion->real_escape_string($entry['nom']);
        $description = $connexion->real_escape_string($entry['description']);
        $id_constructeur = $connexion->real_escape_string($entry['constructeur']);
        $production = $connexion->real_escape_string($entry['production']);
        $image = $connexion->real_escape_string($entry['image']);

        // Vérifiez si l'ID existe déjà dans la table ApiVoitures
        $existing_query = "SELECT id FROM ApiVoitures WHERE id = '$id'";
        $existing_result = $connexion->query($existing_query);

        if ($existing_result->num_rows == 0) {
            $sql = "INSERT INTO ApiVoitures (id, nom, description, id_constructeur, production, image) VALUES ('$id', '$nom', '$description', '$id_constructeur', '$production', '$image')";

            if ($connexion->query($sql) === true) {
                echo "Données voitures insérées avec succès dans la base de données.<br>";
            } else {
                echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
            }
        } else {
            echo "L'entrée avec l'ID $id existe déjà dans la table ApiVoitures.<br>";
        }
    }
} else {
    echo "Erreur lors de la récupération des données de l'API.";
}

$connexion->close();
?>
