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




#################################################################################################################################################

// creation des tables

#################################################################################################################################################


#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################


// Créer la table ApiConstructeur si elle n'existe pas
$create_table_constructeur_query = "CREATE TABLE IF NOT EXISTS ApiConstructeur (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    creation VARCHAR(4),   /* Utilisation du type de données VARCHAR(4) pour la colonne 'creation' */
    fondateur VARCHAR(255),
    pays VARCHAR(255)
)";
if ($connexion->query($create_table_constructeur_query) === true) {
    echo "Table ApiConstructeur créée.<br>";
} else {
    echo "Erreur lors de la création de la table ApiConstructeur : " . $connexion->error . "<br>";
}


#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################


// Créer la table UsinesConstructeur si elle n'existe pas
$create_table_usinesconstructeur_query = "CREATE TABLE IF NOT EXISTS UsinesConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usines VARCHAR(255) NOT NULL
)";
if ($connexion->query($create_table_usinesconstructeur_query) === true) {
    echo "Table usine Constructeur créée.<br>";
} else {
    echo "Erreur lors de la création de la table usine Constructeur : " . $connexion->error . "<br>";
}



#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################

// Créer la table ApiContinent si elle n'existe pas
$create_table_ApiContinent_query = "CREATE TABLE IF NOT EXISTS ApiContinent (
    nom_pays VARCHAR(255) NOT NULL,
    drapeaupays VARCHAR(255) NOT NULL,
    arabworld BOOLEAN NOT NULL,
    centraleuropeandthebaltics BOOLEAN NOT NULL,
    eastasiapacific BOOLEAN NOT NULL,
    euroarea BOOLEAN NOT NULL,
    europecentralasia BOOLEAN NOT NULL,
    europeanunion BOOLEAN NOT NULL,
    highincome BOOLEAN NOT NULL,
    latinamericacaribbean BOOLEAN NOT NULL,
    owincome BOOLEAN NOT NULL,
    lowermiddleincome BOOLEAN NOT NULL,
    middleeastnorthafrica BOOLEAN NOT NULL,
    northamerica BOOLEAN NOT NULL,
    oecdmembers BOOLEAN NOT NULL,
    subsaharanafrica BOOLEAN NOT NULL,
    uppermiddleincome BOOLEAN NOT NULL
)";
if ($connexion->query($create_table_ApiContinent_query) === true) {
    echo "Table ApiContinent créée.<br>";
} else {
    echo "Erreur lors de la création de la table ApiContinent : " . $connexion->error . "<br>";
}



#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################


// Créer la table LinkUsines si elle n'existe pas
$create_table_linkusines_query = "CREATE TABLE IF NOT EXISTS LinkUsines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_constructeurs INT NOT NULL,
    idusines INT NOT NULL,
    FOREIGN KEY (id_constructeurs) REFERENCES ApiConstructeur(id),
    FOREIGN KEY (idusines) REFERENCES UsinesConstructeur(id)
)";
if ($connexion->query($create_table_linkusines_query) === true) {
    echo "Table LinkUsines créée.<br>";
} else {
    echo "Erreur lors de la création de la table LinkUsines : " . $connexion->error . "<br>";
}



#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################

// Créer la table ApiVoitures si elle n'existe pas
$create_table_apivoiture_query = "CREATE TABLE IF NOT EXISTS ApiVoitures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    constructeur INT NOT NULL,
    production INT NOT NULL,
    image VARCHAR(500) NOT NULL,
    FOREIGN KEY (constructeur) REFERENCES ApiConstructeur(id)
)";
if ($connexion->query($create_table_apivoiture_query) === true) {
    echo "Table ApiVoitures créée.<br>";
} else {
    echo "Erreur lors de la création de la table ApiVoitures :  " . $connexion->error . "<br>";
}




#################################################################################################################################################

// Recuperation des données des api

#################################################################################################################################################


// Exemple d'API à partir de JSONPlaceholder
$api_constructeur = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
$api_voitures = 'https://filrouge.uha4point0.fr/V2/car/voitures';
$apipayscontinent = 'https://data.enseignementsup-recherche.gouv.fr/api/explore/v2.1/catalog/datasets/curiexplore-pays/records?limit=-1';

// Récupérez les données de l'API
$constructeur = file_get_contents($api_constructeur);
$voitures = file_get_contents($api_voitures);
$continentpays = file_get_contents($apipayscontinent);

if ($constructeur !== false && $voitures !== false && $continentpays !== false) {
    $data_constructeur = json_decode($constructeur, true);
    $data_voitures = json_decode($voitures, true);
    $data_continentpays = json_decode($continentpays, true);
    

#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################

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


#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################

    foreach ($data_continentpays['results'] as $entry) {
        $nom_pays = $connexion->real_escape_string($entry['name_fr']);
        $drapeaupays = $connexion->real_escape_string($entry['flag']);
        $arabworld = $entry['arab_world'];
        $centraleuropeandthebaltics = $entry['central_europe_and_the_baltics'];
        $eastasiapacific = $entry['east_asia_pacific'];
        $euroarea = $entry['euro_area'];
        $europecentralasia = $entry['europe_central_asia'];
        $europeanunion = $entry['european_union'];
        $highincome = $entry['high_income'];
        $latinamericacaribbean = $entry['latin_america_caribbean'];
        $owincome = $entry['low_income'];
        $lowermiddleincome = $entry['lower_middle_income'];
        $middleeastnorthafrica = $entry['middle_east_north_africa'];
        $northamerica = $entry['north_america'];
        $oecdmembers = $entry['oecd_members'];
        $subsaharanafrica = $entry['sub_saharan_africa'];
        $uppermiddleincome = $entry['upper_middle_income'];

        $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, centraleuropeandthebaltics, eastasiapacific, euroarea, europecentralasia, europeanunion, highincome, latinamericacaribbean, owincome, lowermiddleincome, middleeastnorthafrica, northamerica, oecdmembers, subsaharanafrica, uppermiddleincome) 
                VALUES ('$nom_pays', '$drapeaupays', $arabworld, $centraleuropeandthebaltics, $eastasiapacific, $euroarea, $europecentralasia, $europeanunion, $highincome, $latinamericacaribbean, $owincome, $lowermiddleincome, $middleeastnorthafrica, $northamerica, $oecdmembers, $subsaharanafrica, $uppermiddleincome)";

        if ($connexion->query($sql) === true) {
            echo "Données continent insérées avec succès dans la base de données.<br>";
        } else {
            echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
        }
    }



    // foreach ($data_continentpays as $entry) {
    //     $id = $connexion->real_escape_string($entry['id']);
    //     $nom = $connexion->real_escape_string($entry['nom']);
    //     $creation = $connexion->real_escape_string($entry['creation']);
    //     $fondateur = $connexion->real_escape_string($entry['fondateur']);
    //     $pays = $connexion->real_escape_string($entry['pays']);

    //     // Vérifiez si l'ID existe déjà dans la table ApiConstructeur
    //     $existing_query = "SELECT id FROM ApiConstructeur WHERE id = '$id'";
    //     $existing_result = $connexion->query($existing_query);

    //     if ($existing_result->num_rows == 0) {
    //         $sql = "INSERT INTO ApiConstructeur (id, nom, creation, fondateur, pays) VALUES ('$id', '$nom', '$creation', '$fondateur', '$pays')";

    //         if ($connexion->query($sql) === true) {
    //             echo "Données constructeur insérées avec succès dans la base de données.<br>";
    //         } else {
    //             echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
    //         }
    //     } else {
    //         echo "L'entrée avec l'ID $id existe déjà dans la table ApiConstructeur.<br>";
    //     }
    // }
    

#################################################################################################################################################

// Remplissage des info des usines

#################################################################################################################################################    

    foreach ($data_constructeur as $entry) {
        $id_constructeur = $connexion->real_escape_string($entry['id']);
        $usines = $entry['usines'];

        foreach ($usines as $usine) {
            $usine = $connexion->real_escape_string($usine);

            $existing_usine_query = "SELECT id FROM UsinesConstructeur WHERE usines = '$usine'";
            $existing_usine_result = $connexion->query($existing_usine_query);

            if ($existing_usine_result->num_rows == 0) {
                $insert_usine_query = "INSERT INTO UsinesConstructeur (usines) VALUES ('$usine')";
                if ($connexion->query($insert_usine_query) === true) {
                    echo "Usine '$usine' ajoutée à la table UsinesConstructeur.<br>";

                    $id_usine = $connexion->insert_id;

                    $insert_link_query = "INSERT INTO LinkUsines (id_constructeurs, idusines) VALUES ('$id_constructeur', '$id_usine')";
                    if ($connexion->query($insert_link_query) === true) {
                        echo "Lien entre le constructeur ID '$id_constructeur' et l'usine ID '$id_usine' ajouté à la table LinkUsines.<br>";
                    } else {
                        echo "Erreur lors de l'ajout du lien dans la table LinkUsines : " . $connexion->error . "<br>";
                    }
                } else {
                    echo "Erreur lors de l'ajout de l'usine dans la table UsinesConstructeur : " . $connexion->error . "<br>";
                }
            } else {
                $row = $existing_usine_result->fetch_assoc();
                $id_usine = $row['id'];

                $insert_link_query = "INSERT INTO LinkUsines (id_constructeurs, idusines) VALUES ('$id_constructeur', '$id_usine')";
                if ($connexion->query($insert_link_query) === true) {
                    echo "Lien entre le constructeur ID '$id_constructeur' et l'usine ID '$id_usine' ajouté à la table LinkUsines.<br>";
                } else {
                    echo "Erreur lors de l'ajout du lien dans la table LinkUsines : " . $connexion->error . "<br>";
                }
            }
        }
    }

    

#################################################################################################################################################

// Ajout des informations dans la table voiture

#################################################################################################################################################

    foreach ($data_voitures as $entry) {
        $id = $connexion->real_escape_string($entry['id']);
        $nom = $connexion->real_escape_string($entry['nom']);
        $description = $connexion->real_escape_string($entry['description']);
        $constructeur = $connexion->real_escape_string($entry['constructeur']);
        $production = $connexion->real_escape_string($entry['production']);
        $image = $connexion->real_escape_string($entry['image']);

        // Vérifiez si l'ID existe déjà dans la table ApiVoitures
        $existing_query = "SELECT id FROM ApiVoitures WHERE id = '$id'";
        $existing_result = $connexion->query($existing_query);

        if ($existing_result->num_rows == 0) {
            $sql = "INSERT INTO ApiVoitures (id, nom, description, constructeur, production, image) VALUES ('$id', '$nom', '$description', '$constructeur', '$production', '$image')";

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
