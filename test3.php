<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="bc">
        <video class="bc"  autoplay loop muted>
            
            <?php
                $api_url = ('https://filrouge.uha4point0.fr/V2/car/constructeurs');
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $numid = $_GET['id'];
                $json_data = curl_exec($ch);
                $response_data = json_decode($json_data);
                if (is_array($response_data)){
                    foreach ($response_data as $item) {
                        if($item->id == $numid){
                            echo '<source  src="./video/marques/'.$item->nom.'.mp4" type="video/mp4">';
                        }
                    }
                }
                curl_close($ch);
            ?>
        </video>
    </div>


    <?php
        $api_url = ('https://filrouge.uha4point0.fr/V2/car/constructeurs');
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $numid = $_GET['id'];
        $json_data = curl_exec($ch);
        $response_data = json_decode($json_data);
        if (is_array($response_data)){
          foreach ($response_data as $item) {
                if($item->id == $numid){
                 echo "<br><div class='titre'>" . $item->nom . "<br></div>";

            }
        }}
        curl_close($ch);
    ?>



</body>
</html>