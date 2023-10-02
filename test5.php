<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 5</title>
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
                        <div id="${voiture.nom}">
                        <img src="${voiture.image}" alt="${voiture.nom}" width="200">
                        </div>
                        <hr>
                    `;
                    voituresDiv.appendChild(voitureDiv);
                });
            }
        }

        afficherVoitures();
    </script>

</body>
</html>