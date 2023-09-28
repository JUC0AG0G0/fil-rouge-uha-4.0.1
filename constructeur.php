<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>constructeurs</title>
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
            $api_url = 'https://filrouge.uha4point0.fr/V2/car/constructeurs';
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json_data = curl_exec($ch);
            $response_data = json_decode($json_data);
            if (is_array($response_data)) {
                $marquesParPays = [];
                foreach ($response_data as $item) {
                    $pays = $item->pays;
                    $marque = '<a href="./template_marque.php?id=' . $item->id . '"><div class="boutondiv"><img src="./img/logo_marque/' . $item->nom . '.svg" class="logoimg"></div></a>';
                    if (!isset($marquesParPays[$pays])) {
                        $marquesParPays[$pays] = $marque;
                    } else {
                        $marquesParPays[$pays] .= $marque;
                    }
                }
                foreach ($marquesParPays as $pays => $marques) {
                    echo '<div class="partie"><div class="pays"><img src="./img/drapeau_svg/' . $pays . '.svg" class="imgpays"><h1 class="txtpays">' . $pays . '</h1></div><div class="marques">' . $marques . '</div><hr></div>';
                }
            }

            curl_close($ch);
        ?>
    </div>
</body>
</html>