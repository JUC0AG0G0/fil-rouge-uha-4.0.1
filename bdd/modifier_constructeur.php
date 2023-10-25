<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

$constructeurQuery = $bdd->prepare('SELECT id, nom FROM ApiConstructeur ORDER BY nom ASC');
$constructeurQuery->execute();
$constructeurs = $constructeurQuery->fetchAll();

$payscontinentQuery = $bdd->prepare('SELECT nom_pays FROM ApiContinent ORDER BY nom_pays ASC');
$payscontinentQuery->execute();
$payscontinent = $payscontinentQuery->fetchAll();

if (isset($_POST["modifier_constructeur"])) {
    $constructeurId = $_POST['constructeurId'];
    $creation = $_POST['creation'];
    $fondateur = $_POST['fondateur'];
    $pays = $_POST['pays'];

    // Effectuez la mise à jour du constructeur dans la base de données en utilisant $constructeurId, $creation, $fondateur, $pays, etc.

    // Redirigez l'utilisateur vers une page appropriée après la modification.
}
