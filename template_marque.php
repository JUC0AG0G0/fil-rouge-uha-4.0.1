<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 9</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/template_marque.css">
    <script src="./Js/test9.js"></script>
</head>
<body>
    <div class="bc">
        <video class="bc" autoplay loop muted>
            <?php
                $numid = $_GET['id'];

                require_once './bdd/config.php';

                // Utilisation des constantes pour se connecter à la base de données
                $serveur = DB_SERVER;
                $utilisateur = DB_USER;
                $mot_de_passe = DB_PASSWORD;
                $base_de_donnees = DB_NAME;
                
                
                try {
                    $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

                    $constructeurQuery = $bdd->prepare('SELECT * FROM ApiConstructeur WHERE id = ?');
                    $constructeurQuery->execute([$numid]);
                    $constructeurData = $constructeurQuery->fetch();

                    if ($constructeurData) {
                        $videoSource = './video/marques/' . htmlspecialchars($constructeurData['nom'], ENT_QUOTES, 'UTF-8') . '.mp4';
                        echo '<source src="' . htmlspecialchars($videoSource, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">';
                    }
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
            ?>
        </video>
    </div>

    <div class="select">
        <div class="boite">
            <div class="case">
                <a href="#" class="div-link" data-target="div1">
                    <?php
                        if ($constructeurData) {
                            $logoPath = './img/logo_marque/' . htmlspecialchars($constructeurData['nom'], ENT_QUOTES, 'UTF-8') . '.svg';
                            echo '<img src="' . htmlspecialchars($logoPath, ENT_QUOTES, 'UTF-8') . '" class="imgcase" style="filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);">';
                        }
                    ?>
                </a>
            </div>
        </div>
    </div>

    <div class="info">
        <div class="logopays">
            <div class="logodescri">
                <?php
                    if ($constructeurData) {
                        $logoPath = './img/logo_marque/' . htmlspecialchars($constructeurData['nom'], ENT_QUOTES, 'UTF-8') . '.svg';
                        echo '<img src="' . htmlspecialchars($logoPath, ENT_QUOTES, 'UTF-8') . '" class="logodescription">';
                    }
                ?>
            </div>
            <div class="Pays">
                <?php
                    if ($constructeurData) {
                        $pays = $constructeurData['pays'];

                        // Recherche du lien du drapeau du pays dans la table ApiContinent
                        $drapeauQuery = $bdd->prepare('SELECT drapeaupays FROM ApiContinent WHERE nom_pays = ?');
                        $drapeauQuery->execute([$pays]);
                        $drapeau = $drapeauQuery->fetch();

                        echo '<img src="' . htmlspecialchars($drapeau['drapeaupays'], ENT_QUOTES, 'UTF-8') . '" class="paysorigine">';


                        echo '<p class="nompays">' . htmlspecialchars($pays, ENT_QUOTES, 'UTF-8') . '</p>';
                    }
                ?>
            </div>
            <hr class="ligne">
        </div>
        <div>
            <div class="div-container" id="div1">
                <?php
                    if ($constructeurData) {
                        echo '<div><span> Marque : </span><span>' . htmlspecialchars($constructeurData['nom'], ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                        echo '<div><span> Creation : </span><span>' . htmlspecialchars($constructeurData['creation'], ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                        echo '<div><span> Fondateur : </span><span>' . htmlspecialchars($constructeurData['fondateur'], ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                        
                        $usinesQuery = $bdd->prepare('SELECT u.usines FROM UsinesConstructeur u
                            INNER JOIN LinkUsines lu ON u.id = lu.idusines
                            WHERE lu.id_constructeurs = ?');
                        $usinesQuery->execute([$numid]);
                        $usines = $usinesQuery->fetchAll(PDO::FETCH_COLUMN);
                        
                        if (!empty($usines)) {
                            echo '<div><span> Usines : </span>';
                            echo implode(', ', array_map(function($usine) {
                                return htmlspecialchars($usine, ENT_QUOTES, 'UTF-8');
                            }, $usines));
                            echo '</div><br>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <a href="javascript:history.go(-1);">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>
</body>
</html>
