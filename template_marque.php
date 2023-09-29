<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info constructeurs</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/template_marque.css">
</head>
<body>
    <div class="bc">
        <video class="bc" autoplay loop muted>
            <?php
                $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $numid = $_GET['id'];
                $json_data = curl_exec($ch);
                $response_data = json_decode($json_data);
                if (is_array($response_data)){
                    foreach ($response_data as $item) {
                        if($item->id == $numid){
                            $videoSource = './video/marques/'.$item->nom.'.mp4';
                            echo '<source src="' . htmlspecialchars($videoSource, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">';
                        }
                    }
                }
                curl_close($ch);
            ?>
        </video>
    </div>

    <div class="select">
        <div class="boite">
            <div class="case">
                <a href="#" class="div-link" data-target="div1">
                    <?php
                        $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                        $ch = curl_init($api_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $numid = $_GET['id'];
                        $json_data = curl_exec($ch);
                        $response_data = json_decode($json_data);
                        if (is_array($response_data)){
                            foreach ($response_data as $item) {
                                if($item->id == $numid){
                                    $logoPath = './img/logo_marque/' . $item->nom . '.svg';
                                    echo '<img src="' . htmlspecialchars($logoPath, ENT_QUOTES, 'UTF-8') . '" class="imgcase" style="filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);">';
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
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $numid = $_GET['id'];
                    $json_data = curl_exec($ch);
                    $response_data = json_decode($json_data);
                    if (is_array($response_data)){
                        foreach ($response_data as $item) {
                            if($item->id == $numid){
                                $logoPath = './img/logo_marque/' . $item->nom . '.svg';
                                echo '<img src="' . htmlspecialchars($logoPath, ENT_QUOTES, 'UTF-8') . '" class="logodescription">';
                            }
                        }
                    }
                    curl_close($ch);
                ?>
            </div>
            <div class="Pays">
                <?php
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $numid = $_GET['id'];
                    $json_data = curl_exec($ch);
                    $response_data = json_decode($json_data);
                    if (is_array($response_data)){
                        foreach ($response_data as $item) {
                            if($item->id == $numid){
                                $pays = $item->pays;
                                $flagPath = './img/drapeau_svg/' . $pays . '.svg';
                                echo '<img src="' . htmlspecialchars($flagPath, ENT_QUOTES, 'UTF-8') . '" class="paysorigine">';
                                echo '<p class="nompays">' . htmlspecialchars($pays, ENT_QUOTES, 'UTF-8') . '</p>';
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
                    $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
                    $ch = curl_init($api_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $numid = $_GET['id'];
                    $json_data = curl_exec($ch);
                    $response_data = json_decode($json_data);
                    if (is_array($response_data)){
                        foreach ($response_data as $item) {
                            if($item->id == $numid){
                                echo '<div><span> Marque : </span><span>' . htmlspecialchars($item->nom, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                                echo '<div><span> Creation : </span><span>' . htmlspecialchars($item->creation, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                                echo '<div><span> Fondateur : </span><span>' . htmlspecialchars($item->fondateur, ENT_QUOTES, 'UTF-8') . '</span></div><br>';
                                echo '<div><span> Usines : </span>';
                                foreach ($item->usines as $usine) {
                                    echo '<span>' . htmlspecialchars($usine, ENT_QUOTES, 'UTF-8') . '</span> ';
                                }
                                echo '</div><br>';
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

    <a href="./constructeur.php">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>

</body>
</html>
