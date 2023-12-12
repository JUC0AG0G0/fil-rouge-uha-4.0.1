<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>America</title>
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

            $serveur = DB_SERVER;
            $utilisateur = DB_USER;
            $mot_de_passe = DB_PASSWORD;
            $base_de_donnees = DB_NAME;

            $bdd = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees.'', $utilisateur, $mot_de_passe);

            $constructeurQuery = $bdd->prepare('SELECT DISTINCT c.id, c.nom, c.pays, ac.drapeaupays FROM ApiConstructeur c
                JOIN ApiContinent ac ON c.pays = ac.id
                WHERE ac.latinamericacaribbean = 1 OR ac.northamerica = 1
                ORDER BY c.pays ASC, c.nom ASC');
            $constructeurQuery->execute();
            $marques = $constructeurQuery->fetchAll();

            $countriesPerPage = 2;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $startBrand = ($currentPage - 1) * $countriesPerPage;
            $endBrand = $startBrand + $countriesPerPage;

            for ($i = $startBrand; $i < $endBrand; $i++) {
                if ($i < count($marques)) {
                    $currentBrand = $marques[$i];
            
                    $paysQuery = $bdd->prepare('SELECT nom_pays FROM ApiContinent WHERE id = ?');
                    $paysQuery->execute([$currentBrand['pays']]);
                    $paysData = $paysQuery->fetch();
            
                    $nomPays = $paysData['nom_pays'];
            
                    echo '<div class="partie">';
                    echo '<div class="pays"><img src="' . htmlspecialchars($currentBrand['drapeaupays'], ENT_QUOTES, 'UTF-8') . '" class="imgpays"><h1 class="txtpays">' . htmlspecialchars($nomPays, ENT_QUOTES, 'UTF-8') . '</h1></div>';
                    echo '<div class="marques">';
                    
                    echo '<a href="./template_marque.php?id=' . $currentBrand['id'] . '"><div class="boutondiv">';
                    echo '<img src="./img/logo_marque/' . htmlspecialchars($currentBrand['nom'], ENT_QUOTES, 'UTF-8') . '.svg" class="logoimg">';
                    echo '</div></a>';
            
                    echo '</div><hr></div>';
                }
            }

            $previousPage = $currentPage - 1;
            $nextPage = $currentPage + 1;
        ?>
    </div>
    <div class="pageb">
        <?php
            if ($previousPage > 0) {
                echo '<a href="?page=' . $previousPage . '" class="button_pagination" ><img src="./img/img_admin/fleche-gauche.png" class="pagecontrol" ></a>';
            }

            if ($endBrand < count($marques)) {
                echo '<a href="?page=' . $nextPage . '" class="button_pagination" ><img src="./img/img_admin/fleche-droite.png" class="pagecontrol" ></a>';
            }
        ?>
    </div>
</body>
</html>
