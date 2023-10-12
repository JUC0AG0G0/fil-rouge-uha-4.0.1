<?php

    
    $bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules','Fil_Rouge_Jules_Conrneille','1234');  

    $pdoStat = $bdd->prepare('SELECT * FROM ApiVoitures ORDER BY nom ASC');

    $excuteIsOk = $pdoStat->execute();

    $voitures = $pdoStat->fetchAll();


    $constructeur = $bdd->prepare('SELECT * FROM ApiConstructeur ORDER BY nom ASC');

    $excuteIsOk = $constructeur->execute();

    $constructeur = $constructeur->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test 8</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">

</head>
<body>

<style>
    body{
        background-color: gray;
    }

</style>


<h1>Liste des Voitures</h1>

<ul>


    <?php foreach($voitures as $voitures): ?>
        <li>

            <?= $voitures['id'] ?> <?= $voitures['nom'] ?> <?= $voitures['description'] ?> <?= $voitures['constructeur'] ?> <?= $voitures['production'] ?> <img src="<?= $voitures['image'] ?>" style="heigth : 150px; width : 450px;" > 

        </li>
    
    <?php endforeach ?>

</ul>

<h1>Liste des construteur</h1>

<ul>


    <?php foreach($constructeur as $constructeur): ?>
        <li>

            <?= $constructeur['id'] ?> <?= $constructeur['nom'] ?> <?= $constructeur['creation'] ?> <?= $constructeur['fondateur'] ?> <?= $constructeur['pays'] ?> <img src="./img/drapeau_svg/<?= $constructeur['pays'] ?>.svg" style="heigth : 150px; width : 50px;" >

        </li>
    
    <?php endforeach ?>

</ul>

    
</body>
</html>