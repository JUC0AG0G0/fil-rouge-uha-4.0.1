<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>







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
                echo '<div class="partie"><div class="pays"><img src="./img/drapeau_svg/'. $item->pays .'.svg" class="imgpays"><h1 class="txtpays">'. $item->pays .'</h1></div><p>'.$item->nom.'</p>';
                }
            }
        }
        curl_close($ch);
    ?>



</body>
</html>