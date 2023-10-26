<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerique</title>
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
            require_once './bdd/config.php';

            // Utilisation des constantes pour se connecter à la base de données
            $serveur = DB_SERVER;
            $utilisateur = DB_USER;
            $mot_de_passe = DB_PASSWORD;
            $base_de_donnees = DB_NAME;
            
            
            $bdd = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees.'', $utilisateur, $mot_de_passe);

            $constructeurQuery = $bdd->prepare('SELECT DISTINCT pays FROM ApiConstructeur 
            JOIN ApiContinent ON ApiConstructeur.pays = ApiContinent.nom_pays 
            WHERE ApiContinent.northamerica = 1 OR ApiContinent.latinamericacaribbean = 1
            ORDER BY pays ASC');
            $constructeurQuery->execute();
            $pays = $constructeurQuery->fetchAll();

            $countriesPerPage = 2;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $startCountry = ($currentPage - 1) * $countriesPerPage;
            $endCountry = $startCountry + $countriesPerPage;

            for ($i = $startCountry; $i < $endCountry; $i++) {
                if ($i < count($pays)) {
                    $currentCountry = $pays[$i]['pays'];

                    // Recherche du lien du drapeau du pays dans la table ApiContinent
                    $drapeauQuery = $bdd->prepare('SELECT drapeaupays FROM ApiContinent WHERE nom_pays = ?');
                    $drapeauQuery->execute([$currentCountry]);
                    $drapeau = $drapeauQuery->fetch();

                    echo '<div class="partie">';
                    echo '<div class="pays"><img src="' . htmlspecialchars($drapeau['drapeaupays'], ENT_QUOTES, 'UTF-8') . '" class="imgpays"><h1 class="txtpays">' . $currentCountry . '</h1></div>';
                    echo '<div class="marques">';
                    
                    // Afficher les marques pour le pays actuel
                    $constructeurQuery = $bdd->prepare('SELECT * FROM ApiConstructeur WHERE pays = ? ORDER BY nom ASC');
                    $constructeurQuery->execute([$currentCountry]);
                    $marques = $constructeurQuery->fetchAll();

                    foreach ($marques as $constructeur) {
                        echo '<a href="./template_marque.php?id=' . $constructeur['id'] . '"><div class="boutondiv">';
                        echo '<img src="./img/logo_marque/' . htmlspecialchars($constructeur['nom'], ENT_QUOTES, 'UTF-8') . '.svg" class="logoimg">';
                        echo '</div></a>';
                    }

                    echo '</div><hr></div>';
                }
            }

            // Afficher les boutons de pagination
            $previousPage = $currentPage - 1;
            $nextPage = $currentPage + 1;


        ?>
    </div>
    <div class="pageb">
        <?php

        if ($previousPage > 0) {
            echo '<a href="?page=' . $previousPage . '" class="button_pagination" ><img src="./img/img_admin/fleche-gauche.png" class="pagecontrol" ></a>';
        }

        if ($endCountry < count($pays)) {
            echo '<a href="?page=' . $nextPage . '" class="button_pagination" ><img src="./img/img_admin/fleche-droite.png" class="pagecontrol" ></a>';
        }

        ?>

    </div>
</body>
</html>