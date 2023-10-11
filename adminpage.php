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

            </div>
            <div class="choisiaff" id="addv" >

            </div>
            <div class="choisiaff" id=" supprc" >

            </div>
            <div class="choisiaff" id="supprv">

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