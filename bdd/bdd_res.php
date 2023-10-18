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

// Création de la table ApiContinent

#################################################################################################################################################

// Créer la table ApiContinent si elle n'existe pas
$create_table_ApiContinent_query = "CREATE TABLE IF NOT EXISTS ApiContinent (
    nom_pays VARCHAR(255) NOT NULL PRIMARY KEY,
    drapeaupays VARCHAR(255) NOT NULL,
    arabworld BOOLEAN NOT NULL,
    continentaleurope BOOLEAN NOT NULL,
    asiaoceania BOOLEAN NOT NULL,
    europecentralasia BOOLEAN NOT NULL,
    latinamericacaribbean BOOLEAN NOT NULL,
    northamerica BOOLEAN NOT NULL,
    subsaharanafrica BOOLEAN NOT NULL


)";
if ($connexion->query($create_table_ApiContinent_query) === true) {
    echo "Table ApiContinent créée.<br>";
} else {
    echo "Erreur lors de la création de la table ApiContinent : " . $connexion->error . "<br>";
}

#################################################################################################################################################

// Création de la table ApiConstructeur

#################################################################################################################################################


// Créer la table ApiConstructeur si elle n'existe pas
$create_table_constructeur_query = "CREATE TABLE IF NOT EXISTS ApiConstructeur (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    creation VARCHAR(4),
    fondateur VARCHAR(255),
    pays VARCHAR(255),
    FOREIGN KEY (pays) REFERENCES ApiContinent(nom_pays)

)";
if ($connexion->query($create_table_constructeur_query) === true) {
    echo "Table ApiConstructeur créée.<br>";
} else {
    echo "Erreur lors de la création de la table ApiConstructeur : " . $connexion->error . "<br>";
}


#################################################################################################################################################

// Création de la table UsinesConstructeur

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

// Création de la table LinkUsines

#################################################################################################################################################


// Créer la table LinkUsines si elle n'existe pas
$create_table_linkusines_query = "CREATE TABLE IF NOT EXISTS LinkUsines (
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

// Création de la table ApiVoitures

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

// Ajout des informations dans la table continentpays

#################################################################################################################################################

    foreach ($data_continentpays['results'] as $entry) {
        $nom_pays = $connexion->real_escape_string($entry['name_fr']);
        $drapeaupays = $connexion->real_escape_string($entry['flag']);
        $arabworld = $entry['arab_world'];
        $continentaleurope = $entry['continental_europe'];
        $asiaoceania = $entry['asia_oceania'];
        $europecentralasia = $entry['europe_central_asia'];
        $latinamericacaribbean = $entry['latin_america_caribbean'];
        $northamerica = $entry['north_america'];
        $subsaharanafrica = $entry['sub_saharan_africa'];

        $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica) 
                VALUES ('$nom_pays', '$drapeaupays', $arabworld, $continentaleurope, $asiaoceania, $europecentralasia, $latinamericacaribbean, $northamerica, $subsaharanafrica)";

        if ($connexion->query($sql) === true) {
            echo "Données continent insérées avec succès dans la base de données. " . $nom_pays . "<br>";
        } else {
            echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
        }
    }


    $nom_pays_angleterre = "Angleterre";
    $drapeau_angleterre = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Flag_of_England.svg/2560px-Flag_of_England.svg.png";
    $arabworld_angleterre = "false";
    $continentaleurope_angleterre = "true";
    $asiaoceania_angleterre = "false";
    $europecentralasia_angleterre = "false";
    $latinamericacaribbean_angleterre = "false";
    $northamerica_angleterre = "false";
    $subsaharanafrica_angleterre = "false";

    $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica) 
    VALUES ('$nom_pays_angleterre', '$drapeau_angleterre', $arabworld_angleterre, $continentaleurope_angleterre, $asiaoceania_angleterre, $europecentralasia_angleterre, $latinamericacaribbean_angleterre, $northamerica_angleterre, $subsaharanafrica_angleterre)";

    if ($connexion->query($sql) === true) {
        echo "Données Angleterre insérées avec succès dans la base de données.<br>";
    } else {
        echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
    }

    $nom_pays_allemagne = "Allemagne";
    $drapeau_allemagne = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Flag_of_Germany.svg/1920px-Flag_of_Germany.svg.png";
    $arabworld_allemagne = "false";
    $continentaleurope_allemagne = "true";
    $asiaoceania_allemagne = "false";
    $europecentralasia_allemagne = "false";
    $latinamericacaribbean_allemagne = "false";
    $northamerica_allemagne = "false";
    $subsaharanafrica_allemagne = "false";

    $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica) 
    VALUES ('$nom_pays_allemagne', '$drapeau_allemagne', $arabworld_allemagne, $continentaleurope_allemagne, $asiaoceania_allemagne, $europecentralasia_allemagne, $latinamericacaribbean_allemagne, $northamerica_allemagne, $subsaharanafrica_allemagne)";

    if ($connexion->query($sql) === true) {
        echo "Données Allemagne insérées avec succès dans la base de données.<br>";
    } else {
        echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
    }

    $nom_pays_japon = "Japon";
    $drapeau_japon = "https://upload.wikimedia.org/wikipedia/en/thumb/9/9e/Flag_of_Japan.svg/1280px-Flag_of_Japan.svg.png";
    $arabworld_japon = "false";
    $continentaleurope_japon = "false";
    $asiaoceania_japon = "true";
    $europecentralasia_japon = "false";
    $latinamericacaribbean_japon = "false";
    $northamerica_japon = "false";
    $subsaharanafrica_japon = "false";

    $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica) 
    VALUES ('$nom_pays_japon', '$drapeau_japon', $arabworld_japon, $continentaleurope_japon, $asiaoceania_japon, $europecentralasia_japon, $latinamericacaribbean_japon, $northamerica_japon, $subsaharanafrica_japon)";

    if ($connexion->query($sql) === true) {
        echo "Données Japon insérées avec succès dans la base de données.<br>";
    } else {
        echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
    }

    $nom_pays_france = "France";
    $drapeau_france = "https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/1280px-Flag_of_France.svg.png";
    $arabworld_france = "false";
    $continentaleurope_france = "true";
    $asiaoceania_france = "false";
    $europecentralasia_france = "false";
    $latinamericacaribbean_france = "false";
    $northamerica_france = "false";
    $subsaharanafrica_france = "false";

    $sql = "INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica) 
    VALUES ('$nom_pays_france', '$drapeau_france', $arabworld_france, $continentaleurope_france, $asiaoceania_france, $europecentralasia_france, $latinamericacaribbean_france, $northamerica_france, $subsaharanafrica_france)";

    if ($connexion->query($sql) === true) {
        echo "Données France insérées avec succès dans la base de données.<br>";
    } else {
        echo "Erreur lors de l'insertion des données : " . $connexion->error . "<br>";
    }




#################################################################################################################################################

// Ajout des informations dans la table constructeur

#################################################################################################################################################

    foreach ($data_constructeur as $entry) {
        $id = $connexion->real_escape_string($entry['id']);
        $nom = $connexion->real_escape_string($entry['nom']);
        $nom = ucfirst($nom);
        $creation = $connexion->real_escape_string($entry['creation']);
        $fondateur = $connexion->real_escape_string($entry['fondateur']);
        $pays = $connexion->real_escape_string($entry['pays']);
        $pays = ucfirst($pays);

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
                        echo "Lien entre le constructeur ID '$id_constructeur' et l'usine ajouté à la table LinkUsines.<br>";
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
                    echo "Lien entre le constructeur ID '$id_constructeur' et l'usine ajouté à la table LinkUsines.<br>";
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