<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=fil_rouge_401_Corneille_Jules', 'Fil_Rouge_Jules_Conrneille', '1234');

// Récupération de la liste des constructeurs
$constructeurQuery = $bdd->prepare('SELECT id, nom FROM ApiConstructeur ORDER BY nom ASC');
$constructeurQuery->execute();
$constructeurs = $constructeurQuery->fetchAll();

$voitureQuery = $bdd->prepare('SELECT id, nom FROM ApiVoitures ORDER BY nom ASC');
$voitureQuery->execute();
$voitures = $voitureQuery->fetchAll();



?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="icon" type="image/png" href="./img/monkey_narotu.png">
    <link rel="stylesheet" type="text/css" href="./css/adminpage.css">
    <script src="./Js/adminpage.js"></script>
</head>
<body>
    

    <div class="bc" ></div>
    <div class="worldmap" >
    </div>
    <div class="noir">
    </div>

    <a href="./index.php">
        <div class="buttonback">
            <img src="./img/97591.svg" class="imgback" style="height: 80%; width: 80%;">
        </div>
    </a>

    <div class="main" >
        <div class="menu" >
            <button class="choix" data-target="addc" >    
                <div>
                    <h2>Ajouter un constructeur</h2>
                </div>
            </button>
            <button class="choix" data-target="addv" >    
                <div>
                    <h2>Ajouter une voiture</h2>
                </div>
            </button>
            <button class="choix" data-target="supprc" >    
                <div>
                    <h2>Suprimer un constructeur</h2>
                </div>
            </button>
            <button class="choix" data-target="supprv">    
                <div>
                    <h2>Suprimer une voiture</h2>
                </div>
            </button>
            <button class="choix" id="supr_all" data-target="supprimer_bdd" >    
                <div>
                    <h2>Suprimer toute la BDD</h2>
                </div>
            </button>
            <button class="choix" id="resetbdd" data-target="res_bdd">    
                <div>
                    <h2>Renitialiser la BDD</h2>
                </div>
            </button>
        </div>
        <div class="choisi">
            <div class="choisiaff" id="addc" >
                <div class="formulaire" >
                    <form method="addconstructeur" action="">

                        <h2>Nom :</h2>
                        <input type="text" name="nom" />

                        <h2>Année de creation :</h2>
                        <input type="number" name="creation" min="1000" max="9999" />

                        <h2>Fondateur :</h2>
                        <input type="text" name="fondateur" />

                        <h2>Pays d'origine :</h2>
                        <select name="cars">
                            <option value="Allemagne">Allemagne</option>
                            <option value="Angleterre">Angleterre</option>
                            <option value="france">France</option>
                            <option value="Italie">Italie</option>
                        </select>

                        <h2>Usines :</h2>
                        <input type="text" name="usines" />

                        <h2>Logo :</h2>
                        <input type="file" name="logo" accept=".svg" />

                        <h2>Video :</h2>
                        <input type="file" name="video" accept=".mp4" />

                        <input type="submit" value="Ajouter"/>

                    </form>
                </div>
            </div>
            <div class="choisiaff" id="addv" >
                <div class="formulaire" >
                    <form method="addvoiture" action="">

                        <h2>Nom :</h2>
                        <input type="text" name="nom" />

                        <h2>Année de production :</h2>
                        <input type="text" name="description" />

                        <h2>constructeur :</h2>
                        <select name="constructeur" >
                            <?php foreach ($constructeurs as $constructeur) : ?>
                                <option value="<?php echo $constructeur['id']; ?>"><?php echo $constructeur['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <h2>Nombre de modele produit :</h2>
                        <input type="number" name="production" min="1" />

                        <h2>Image :</h2>
                        <input type="url" name="image"  />

                        <input type="submit" value="Ajouter"/>

                    </form>
                </div>
            </div>
            <div class="choisiaff" id="supprc" >
                <div class="formulaire" >
                    <form method="supprimer_constructeur" action="">
                        <h2>constructeur a supprimer :</h2>
                        <select name="suppr_constructeur" >
                            <?php foreach ($constructeurs as $constructeur) : ?>
                                <option value="<?php echo $constructeur['id']; ?>"><?php echo $constructeur['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" value="Ajouter"/>
                    </form>
                </div>
            </div>
            <div class="choisiaff" id="supprv">
                <div class="formulaire">
                    <form method="post" action="">

                        <h2>Voiture à supprimer :</h2>
                        <select id="suppr_voiture" name="suppr_voiture">
                            <?php foreach ($voitures as $voiture) : ?>
                                <option value="<?php echo $voiture['id']; ?>" data-name="<?php echo $voiture['nom']; ?>"><?php echo $voiture['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" name="supprimer" value="Supprimer"/>
                    </form>
                </div>
            </div>
            <div class="choisiaff" id="supprimer_bdd">
                <div class="imgch"  >
                    <img src="./img/img_admin/supprimer-la-base-de-donnees.png" class="logo_admin" style="filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);" >
                    <h2>
                        La base de donnée a été supprimer
                    </h2>
                </div>
            </div>
            <div class="choisiaff" id="res_bdd">
                <div class="imgch" >
                    <img src="./img/img_admin/reset-base-de-donnees.png" class="logo_admin" style=" filter: brightness(0) invert(1) grayscale(100%) sepia(0%) saturate(0%);" >
                    <h2>
                        La base de donnée a été rénitialisé avec les données des API
                    </h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>