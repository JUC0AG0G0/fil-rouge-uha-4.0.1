document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.choix');
    const choisiaffDivs = document.querySelectorAll('.choisiaff');

    function hideChoisiaffDivs() {
        choisiaffDivs.forEach(div => {
            div.style.display = 'none';
        });
    }

    // Écoutez les clics sur les boutons
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = button.getAttribute('data-target');

            hideChoisiaffDivs();

            const targetDiv = document.getElementById(targetId);
            if (targetDiv) {
                targetDiv.style.display = 'block';
            }
        });
    });

    // Réinitialisation de la base de données
    const resetButton = document.getElementById('resetbdd');
    resetButton.addEventListener('click', function () {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/bdd_res.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send();
    });



    // Suppression de la base de données
    const supprimerButton = document.getElementById('supr_all');
    supprimerButton.addEventListener('click', function () {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/bdd_supr.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("La base de données a été supprimée avec succès.");
                location.reload();
            }
        };
        xhr.send();
    });
    

    // Suppression d'une voiture
    const supprimerVButton = document.querySelector('[name="supprimerv"]');
    supprimerVButton.addEventListener('click', function (e) {
        e.preventDefault();

        const supprVoitureSelect = document.getElementById('suppr_voiture');
        const selectedOption = supprVoitureSelect.options[supprVoitureSelect.selectedIndex];

        const idASupprimer = selectedOption.value;
        const nomVoitureASupprimer = selectedOption.getAttribute('data-name');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/supprimer_voiture.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("La voiture " + nomVoitureASupprimer + " a été supprimée avec succès.");
                location.reload();
            }
        };

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("supprimerv=true&suppr_voiture=" + idASupprimer);
    });


    // Suppression d'un constructeur
    const supprimerCButton = document.querySelector('[name="supprimerc"]');
    supprimerCButton.addEventListener('click', function (e) {
        e.preventDefault();

        const supprConstructeurSelect = document.getElementById('suppr_constructeur');
        const selectedOption = supprConstructeurSelect.options[supprConstructeurSelect.selectedIndex];

        const idASupprimer = selectedOption.value;
        const nomConstructeurASupprimer = selectedOption.getAttribute('data-name');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/supprimer_constructeur.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Le constructeur " + nomConstructeurASupprimer + " a été supprimé avec succès.");
                location.reload();

            }
        };

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("supprimerc=true&suppr_constructeur=" + idASupprimer);
    });


    // Ajout d'une voiture
    const addvForm = document.querySelector('[name="ajouterv"]');
    addvForm.addEventListener('click', function (e) {
        e.preventDefault();
    
        const nomv = document.querySelector('input[name="nomv"]').value;
        const descriptionv = document.querySelector('input[name="descriptionv"]').value;
        const constructeurv = document.querySelector('select[name="constructeurv"]').value;
        const productionv = document.querySelector('input[name="productionv"]').value;
        const imagev = document.querySelector('input[name="imagev"]').value;


        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/ajouter_voiture.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("La voiture a été ajoutée avec succès.");
            }
        };
    
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("ajouterv=true&nomv=" + nomv + "&descriptionv=" + descriptionv + "&constructeurv=" + constructeurv + "&productionv=" + productionv + "&imagev=" + imagev);
    });


});
