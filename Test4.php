<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>constructeurs</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/test4.css">
</head>
<body>

    <?php
            $api_url = ('https://filrouge.uha4point0.fr/V2/car/constructeurs');
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json_data = curl_exec($ch);
            $response_data = json_decode($json_data);
            if (is_array($response_data)){
            foreach ($response_data as $item) {
                    echo '<a href="./test3.php?id='. $item->id .'"><img src="./img/logo_marque/'. $item->nom .'.svg" class="logoimg">';
                    echo '<p>'. $item->nom .'</p>';
                }
            }
            
            curl_close($ch);
        ?>

        
    </div>
</body>
</html>
