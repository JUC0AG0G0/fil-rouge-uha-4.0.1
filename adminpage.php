<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './bdd/config.php';

// Utilisation des constantes pour se connecter à la base de données
$serveur = DB_SERVER;
$utilisateur = DB_USER;
$mot_de_passe = DB_PASSWORD;
$base_de_donnees = DB_NAME;

try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd_exist = true; // La connexion a réussi, donc la base de données existe
} catch (PDOException $e) {
    $bdd_exist = false;
}

if (!$bdd_exist) {
    echo "Erreur de connexion à la base de données. Veuillez vérifier vos informations de connexion.";
    echo '<button class="choix" id="resetbdd" data-target="res_bdds"><div><h2>Renitialiser la BDD</h2></div></button>';
    echo '<script src="./Js/adminpage.js"></script>';
    exit;
}

$conn = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);


$constructeurQuery = $bdd->prepare('SELECT id, nom FROM ApiConstructeur ORDER BY nom ASC');
$constructeurQuery->execute();
$constructeurs = $constructeurQuery->fetchAll();

$voitureQuery = $bdd->prepare('SELECT id, nom FROM ApiVoitures ORDER BY nom ASC');
$voitureQuery->execute();
$voitures = $voitureQuery->fetchAll();

$payscontinentQuery = $bdd->prepare('SELECT nom_pays FROM ApiContinent ORDER BY nom_pays ASC');
$payscontinentQuery->execute();
$payscontinent = $payscontinentQuery->fetchAll();





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

    if (move_uploaded_file($logoTempFile, $logoFilePath) && move_uploaded_file($videoTempFile, $videoFilePath)) {

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


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/adminpage.css">
    <script src="./Js/adminpage.js"></script>
</head>
<body>
    

    <div class="bc" ></div>
    <div class="worldmap" >
    </div>
    <div class="noir">
    </div>

    <a href="./index.php">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>

    <div class="main" >
        <?php if ($bdd_exist) : ?>
            <div class="menu" >
                <button class="choix" data-target="addc" >    
                    <div>
                        <h2>Ajouter un constructeur</h2>
                    </div>
                </button>
                <button class="choix" data-target="addv" >    
                    <div>
                        <h2>Ajouter une voiture</h2>
                    </div>
                </button>
                <button class="choix" data-target="supprc" >    
                    <div>
                        <h2>Suprimer un constructeur</h2>
                    </div>
                </button>
                <button class="choix" data-target="supprv">    
                    <div>
                        <h2>Suprimer une voiture</h2>
                    </div>
                </button>
                <button class="choix" data-target="upc" >    
                    <div>
                        <h2>Modifier un constructeur</h2>
                    </div>
                </button>
                <button class="choix" data-target="upv">    
                    <div>
                        <h2>Modifier une voiture</h2>
                    </div>
                </button>
                <button class="choix" id="supr_all" data-target="supprimer_bdd" >    
                    <div>
                        <h2>Suprimer toute la BDD</h2>
                    </div>
                </button>
                <button class="choix" id="resetbdd" data-target="res_bdd">    
                    <div>
                        <h2>Renitialiser la BDD</h2>
                    </div>
                </button>
            </div>


            
            <div class="choisi">
                <div class="choisiaff" id="addc" >
                    <div class="formulaire" >
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

                            <input type="submit" name="ajouterc" value="Ajouter ce constructeur" class="buttonf" />
                        </form>
                    </div>
                </div>
                <div class="choisiaff" id="addv">
                    <div class="formulaire">
                        <form id="ajoutVoitureForm" method="POST" action="">
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

                            <br><br>

                            <input type="submit" name="ajouterv" value="Ajouter" class="buttonf" />
                        </form>
                    </div>
                </div>



                <div class="choisiaff" id="supprc" >
                    <div class="formulaire" >
                        <form method="post" action="">
                            <h2>Constructeur à supprimer :</h2>
                            <select id="suppr_constructeur" name="suppr_constructeur">
                                <?php foreach ($constructeurs as $constructeur) : ?>
                                    <option value="<?php echo $constructeur['id']; ?>" data-name="<?php echo $constructeur['nom']; ?>"><?php echo $constructeur['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            
                            <br><br>

                            <input type="submit" name="supprimerc" value="Supprimer" class="buttonf" />
                        </form>
                    </div>
                </div>
                <div class="choisiaff" id="supprv">
                    <div class="formulaire">
                        <form method="post" action="">

                            <h2>Voiture à supprimer :</h2>
                            <select id="suppr_voiture" name="suppr_voiture">
                                <?php foreach ($voitures as $voiture) : ?>
                                    <option value="<?php echo $voiture['id']; ?>" data-name="<?php echo $voiture['nom']; ?>"><?php echo $voiture['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            
                            <br><br>

                            <input type="submit" name="supprimerv" value="Supprimer" class="buttonf" />

                        </form>
                    </div>
                </div>


                <div class="choisiaff" id="upc" >
                    <div class="formulaire" >
                        <form method="post" action="./bdd/modifier_constructeur.php">
                            <h2>Constructeur à modifier :</h2>
                            <select id="constructeurSelect" name="constructeurId">
                                <?php foreach ($constructeurs as $constructeur) : ?>
                                    <option value="<?php echo $constructeur['id']; ?>"><?php echo $constructeur['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button type="button" id="chargerConstructeur" class="buttonf" >Charger le constructeur</button>

                            <h2>Année de création :</h2>
                            <input type="number" name="creation" id="creation" min="1000" max="9999" />

                            <h2>Fondateur :</h2>
                            <input type="text" name="fondateur" id="fondateur" />

                            <h2>Pays d'origine :</h2>
                            <select name="pays" id="pays">
                                <?php foreach ($payscontinent as $pays) : ?>
                                    <option value="<?php echo $pays['nom_pays']; ?>"><?php echo $pays['nom_pays']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <br><br>

                            <input type="submit" name="modifier_constructeur" value="Modifier le constructeur" class="buttonf" />
                        </form>

                        <script>
                            document.getElementById("chargerConstructeur").addEventListener("click", function() {
                                const selectElement = document.getElementById("constructeurSelect");
                                const selectedId = selectElement.value;

                                if (selectedId) {
                                    const xhr = new XMLHttpRequest();
                                    xhr.open("GET", `./bdd/recuperer_constructeur.php?id=${selectedId}`, true);
                                    xhr.onload = function() {
                                        if (xhr.status === 200) {
                                            const data = JSON.parse(xhr.responseText);

                                            document.getElementById("creation").value = data.creation;
                                            document.getElementById("fondateur").value = data.fondateur;
                                            document.getElementById("pays").value = data.pays;
                                        }
                                    };
                                    xhr.send();
                                }
                            });
                        </script>

                    </div>
                </div>
                <div class="choisiaff" id="upv">
                    <div class="formulaire">
                        <form method="post" action="./bdd/modifier_voiture.php">
                            <h2>Voiture à modifier :</h2>
                            <select id="voitureSelect" name="voitureId">
                                <?php foreach ($voitures as $voiture) : ?>
                                    <option value="<?php echo $voiture['id']; ?>"><?php echo $voiture['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button type="button" id="chargerVoiture" class="buttonf" >Charger la voiture</button>

                            <h2>Description :</h2>
                            <input type="text" name="descriptionupv" id="descriptionupv" required />

                            <h2>Constructeur :</h2>
                            <select name="constructeurupv" id="constructeurupv"  required>
                                <?php foreach ($constructeurs as $constructeur) : ?>
                                    <option value="<?php echo $constructeur['id']; ?>"><?php echo $constructeur['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <h2>Production :</h2>
                            <input type="number" name="productionupv" id="productionupv" min="1" required />

                            <h2>Image :</h2>
                            <input type="url" name="imageupv" id="imageupv" required />

                            <br><br>

                            <input type="submit" name="modifier_voiture" value="Modifier la voiture" class="buttonf" />
                        </form>

                        <script>
                            document.getElementById("chargerVoiture").addEventListener("click", function() {
                                const selectElement = document.getElementById("voitureSelect");
                                const selectedId = selectElement.value;

                                if (selectedId) {
                                    const xhr = new XMLHttpRequest();
                                    xhr.open("GET", `./bdd/recuperer_voiture.php?idupv=${selectedId}`, true);
                                    xhr.onload = function() {
                                        if (xhr.status === 200) {
                                            const data = JSON.parse(xhr.responseText);

                                            document.getElementById("descriptionupv").value = data.description;
                                            document.getElementById("constructeurupv").value = data.constructeur;
                                            document.getElementById("productionupv").value = data.production;
                                            document.getElementById("imageupv").value = data.image;
                                        }
                                    };
                                    xhr.send();
                                }
                            });
                        </script>
                    </div>
                </div>


                <div class="choisiaff" id="supprimer_bdd">
                    <div class="imgch"  >
                        <img src="./img/img_admin/supprimer-la-base-de-donnees.png" class="logo_admin" style="filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);" >
                        <h2>
                            La base de donnée a été supprimer
                        </h2>
                    </div>
                </div>
                <div class="choisiaff" id="res_bdd">
                    <div class="imgch" >
                        <img src="./img/img_admin/reset-base-de-donnees.png" class="logo_admin" style=" filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);" >
                        <h2>
                            La base de donnée a été rénitialisé avec les données des API
                        </h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>