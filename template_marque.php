<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>template_marque</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/template_marque.css">
</head>
<body>
    <div class="bc">
    <!-- <iframe class="bc" src="https://www.youtube.com/embed/A4Wrgh9XCkc?autoplay=1&loop=1&playlist=A4Wrgh9XCkc" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
        <video class="bc"  autoplay loop muted>
            <source  src="./video/marques/BMW.mp4" type="video/mp4">
        </video>
    </div>


    <div class="select">
        <div class="boite">
            <div class="case">
                <a href="#" class="div-link" data-target="div1">


                        <?php
                            // Appel API pour obtenir les données de la marque
                            $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                            $ch = curl_init($api_url);
                            $options = [
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER => [
                                    'Authorization: Bearer ' . $api_key // Assurez-vous d'avoir une variable $api_key définie avec votre clé d'API.
                                ]
                            ];
                            curl_setopt_array($ch, $options);
                            $response = curl_exec($ch);
                            if ($response === false) {
                                echo 'Erreur lors de la requête cURL : ' . curl_error($ch);
                            } else {
                                $decoded_data = json_decode($response);
                                if ($decoded_data === null) {
                                    echo 'Erreur lors du décodage des données JSON.';
                                } else {
                                    foreach ($decoded_data as $item) {
                                        if ($item->id === 2) {
                                            $nom = $item->nom;
                                            // Supprimez le point inutile dans le chemin de l'image
                                            echo '<img src="./img/logo_marque/' . $nom . '.svg" class="imgcase" style="filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);">';
                                        }
                                    }
                                }
                            }
                            curl_close($ch);
                        ?>


                </a>
            </div>
        </div>
    </div>

    <div class="info">
        <div class="logopays">
            <div class="logodescri">
                <?php
                    // Appel API pour obtenir les données de la marque
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    $options = [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => [
                            'Authorization: Bearer ' . $api_key // Assurez-vous d'avoir une variable $api_key définie avec votre clé d'API.
                        ]
                    ];
                    curl_setopt_array($ch, $options);
                    $response = curl_exec($ch);
                    if ($response === false) {
                        echo 'Erreur lors de la requête cURL : ' . curl_error($ch);
                    } else {
                        $decoded_data = json_decode($response);
                        if ($decoded_data === null) {
                            echo 'Erreur lors du décodage des données JSON.';
                        } else {
                            foreach ($decoded_data as $item) {
                                if ($item->id === 2) {
                                    $nom = $item->nom;
                                    // Supprimez le point inutile dans le chemin de l'image
                                    echo '<img src="./img/logo_marque/' . $nom . '.svg" class="logodescription">';
                                }
                            }
                        }
                    }
                    curl_close($ch);
                ?>
            </div>
            <div class="Pays">
                <?php
                    // Appel API pour obtenir le pays d'origine de la marque
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    $options = [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => [
                            'Authorization: Bearer ' . $api_key // Assurez-vous d'avoir une variable $api_key définie avec votre clé d'API.
                        ]
                    ];
                    curl_setopt_array($ch, $options);
                    $response = curl_exec($ch);
                    if ($response === false) {
                        echo 'Erreur lors de la requête cURL : ' . curl_error($ch);
                    } else {
                        $decoded_data = json_decode($response);
                        if ($decoded_data === null) {
                            echo 'Erreur lors du décodage des données JSON.';
                        } else {
                            foreach ($decoded_data as $item) {
                                if ($item->id === 2) {
                                    $pays = $item->pays;
                                    // Supprimez le point inutile dans le chemin de l'image
                                    echo '<img src="./img/drapeau_svg/' . $pays . '.svg" class="paysorigine">';
                                    echo '<p class="nompays">' . $pays . '</p>';
                                }
                            }
                        }
                    }
                    curl_close($ch);
                ?>
            </div>
            <hr class="ligne">
        </div>
        <div>
            <div class="div-container" id="div1">
                
                <?php
                    // Appel API pour obtenir les détails de la marque
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    $options = [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => [
                            'Authorization: Bearer ' . $api_key
                        ]
                    ];
                    curl_setopt_array($ch, $options);
                    $response = curl_exec($ch);
                    if ($response === false) {
                        echo 'Erreur lors de la requête cURL : ' . curl_error($ch);
                    } else {
                        $decoded_data = json_decode($response);
                        if ($decoded_data === null) {
                            echo 'Erreur lors du décodage des données JSON.';
                        } else {
                            foreach ($decoded_data as $item) {
                                if ($item->id === 2) {
                                    echo '<div><span> Marque : </span><span>' . $item->nom . '</span></div><br>';
                                    echo '<div><span> Creation : </span><span>' . $item->creation . '</span></div><br>';
                                    echo '<div><span> Fondateur : </span><span>' . $item->fondateur . '</span></div><br>';
                                    echo '<div><span> Usines : </span>';
                                    foreach ($item->usines as $usine) {
                                        echo '<span>' . $usine . '</span> ';
                                    }
                                    echo '</div><br>';
                                    break;
                                }
                            }
                        }
                    }
                    curl_close($ch);
                ?>
            </div>
        </div>
    </div>

    <script>
        const divLinks = document.querySelectorAll('.div-link');
        const divs = document.querySelectorAll('.div-container');

        divLinks.forEach((divLink) => {
            divLink.addEventListener('click', (e) => {
                e.preventDefault();

                divs.forEach((div) => {
                    div.style.display = 'none';
                });

                const targetDivId = divLink.getAttribute('data-target');
                const targetDiv = document.getElementById(targetDivId);

                targetDiv.style.display = 'block';
            });
        });
    </script>

    <a href="./europe.php">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>

</body>
</html>
