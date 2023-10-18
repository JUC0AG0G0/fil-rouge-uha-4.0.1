<?php
$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

$api_voitures = $bdd->prepare('SELECT * FROM ApiVoitures ORDER BY nom ASC');

$excuteIsOk = $api_voitures->execute();

$voitures = $api_voitures->fetchAll();

header('Content-Type: application/json');

echo json_encode($voitures);


?>