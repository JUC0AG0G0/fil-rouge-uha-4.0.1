<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 5</title>
    <link rel="stylesheet" type="text/css" href="./css/test5.css">
</head>
<body>
    <h1>Liste de Voitures</h1>
    <div id="voitures"></div>

    <script>
        async function getVoitures() {
            try {
                const response = await fetch('https://filrouge.uha4point0.fr/V2/car/voitures');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Erreur lors de la récupération des données :', error);
            }
        }
        const id = new URLSearchParams(window.location.search).get('id');

        async function afficherVoitures() {
            const voitures = await getVoitures();

            if (voitures) {
                const voituresDiv = document.getElementById('voitures');
                voitures.filter(voiture => voiture.constructeur == id).forEach(voiture =>{
                    const voitureDiv = document.createElement('div');
                    voitureDiv.innerHTML = `
                    <div class="case">
                        <a href="#" class="div-link" data-target="${voiture.id}">
                            <img src="${voiture.image}" class="imgcase" style="height: 200px; width: 300px;">
                        </a>
                    </div>
                    <hr>
                    `;
                    voituresDiv.appendChild(voitureDiv);
                });
            }
        }

        afficherVoitures().then(_ => {
            const divLinks = document.querySelectorAll('.div-link');
            const divs = document.querySelectorAll('.div-container');

            console.log(divLinks)

        divLinks.forEach((divLink) => {
            divLink.addEventListener('click', (e) => {
                console.log("click")
                e.preventDefault();

                divs.forEach((div) => {
                    div.style.display = 'none';
                });

                const targetDivId = divLink.getAttribute('data-target');
                const targetDiv = document.getElementById(targetDivId);

                targetDiv.style.display = 'block';
            });
        });
        });;
    </script>



    <script>
        async function getVoitures() {
            try {
                const response = await fetch('https://filrouge.uha4point0.fr/V2/car/voitures');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Erreur lors de la récupération des données :', error);
            }
        }

        async function afficherVoitures() {
            const voitures = await getVoitures();

            if (voitures) {
                const voituresDiv = document.getElementById('voitures');
                voitures.filter(voiture => voiture.constructeur == id).forEach(voiture =>{
                    const voitureDiv = document.createElement('div');
                    voitureDiv.innerHTML = `
                    <div class="div-container" id="${voiture.id}">
                        <div>
                            <span>
                                Nom : 
                            </span>
                            <span>
                                ${voiture.nom}
                            </span>
                        </div>
                        <br>
                        <div>
                            <span>
                                Année :
                            </span>
                            <span>
                                ${voiture.description}
                            </span>
                        </div>
                        <br>
                        <div>
                            <span>
                                Production :
                            </span>
                            <span>
                                ${voiture.production}
                            </span>
                        </div>
                    </div>
                    `;
                    voituresDiv.appendChild(voitureDiv);
                });
            }
        }

        afficherVoitures().then(_ => {
            const divLinks = document.querySelectorAll('.div-link');
            const divs = document.querySelectorAll('.div-container');

            console.log(divLinks)

        divLinks.forEach((divLink) => {
            divLink.addEventListener('click', (e) => {
                console.log("click")
                e.preventDefault();

                divs.forEach((div) => {
                    div.style.display = 'none';
                });

                const targetDivId = divLink.getAttribute('data-target');
                const targetDiv = document.getElementById(targetDivId);

                targetDiv.style.display = 'block';
            });
        });
        });
    </script>

    <script>
        

        
    </script>  



</body>
</html>