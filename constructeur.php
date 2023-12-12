<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Constructeurs et Voitures</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/continent.css">
</head>
<body>
    <img class="world_map" src="./img/36479.svg">
    <div class="noir"></div>
    <a href="./index.php">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>
    <div class="scroller">
        <?php


        $urleuropearabeworld = $_GET['arabworld'];
        $urleuropecontinentaleurope = $_GET['continentaleurope'];
        $urleuropeasiaoceania = $_GET['asiaoceania'];
        $urleuropeasiaoceania = $_GET['europecentralasia'];
        $urleuropeasiaoceania = $_GET['latinamericacaribbean'];
        $urleuropeasiaoceania = $_GET['northamerica'];
        $urleuropeasiaoceania = $_GET['subsaharanafrica'];
        
      
        $bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

        // Récupération de la liste des constructeurs par pays
        $constructeurQuery = $bdd->prepare('SELECT * FROM ApiConstructeur ORDER BY pays, nom ASC');
        $constructeurQuery->execute();
        $constructeurs = $constructeurQuery->fetchAll();


        $currentCountry = "";

        foreach ($constructeurs as $constructeur) {
            if ($constructeur['pays'] != $currentCountry) {
                if ($currentCountry != "") {
                    echo '</div><hr></div>';
                }
                $currentCountry = $constructeur['pays'];

                // Recherche du lien du drapeau du pays dans la table ApiContinent
                $drapeauQuery = $bdd->prepare('SELECT drapeaupays FROM ApiContinent WHERE nom_pays = ?');
                $drapeauQuery->execute([$currentCountry]);
                $drapeau = $drapeauQuery->fetch();

                echo '<div class="partie">';
                echo '<div class="pays"><img src="' . htmlspecialchars($drapeau['drapeaupays'], ENT_QUOTES, 'UTF-8') . '" class="imgpays"><h1 class="txtpays">' . $constructeur['pays'] . '</h1></div>';
                echo '<div class="marques">';
            }

            echo '<a href="./template_marque.php?id=' . $constructeur['id'] . '"><div class="boutondiv">';
            echo '<img src="./img/logo_marque/' . htmlspecialchars($constructeur['nom'], ENT_QUOTES, 'UTF-8') . '.svg" class="logoimg">';
            echo '</div></a>';
        }

        if ($currentCountry != "") {
            echo '</div><hr></div>';
        }
        ?>
    </div>
</body>
</html>
