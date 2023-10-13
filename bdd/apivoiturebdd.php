<?php
$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

$pdoStat = $bdd->prepare('SELECT * FROM ApiVoitures ORDER BY nom ASC');

$excuteIsOk = $pdoStat->execute();

$voitures = $pdoStat->fetchAll();

header('Content-Type: application/json');

echo json_encode($voitures);


?>