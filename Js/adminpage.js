document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez tous les boutons de la classe "choix" et les divs de la classe "choisiaff"
    const buttons = document.querySelectorAll('.choix');
    const choisiaffDivs = document.querySelectorAll('.choisiaff');

    // Fonction pour masquer toutes les divs "choisiaff"
    function hideChoisiaffDivs() {
        choisiaffDivs.forEach(div => {
            div.style.display = 'none';
        });
    }

    // Écoutez les clics sur les boutons
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = button.getAttribute('data-target');

            // Masquer toutes les divs "choisiaff"
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
                alert("La base de données a été réinitialisée avec succès.");
                location.reload(); // Actualiser la page
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
                location.reload(); // Actualiser la page
            }
        };
        xhr.send();
    });

    // Suppression d'une voiture
    const supprimerVButton = document.querySelector('[name="supprimerv"]');
    supprimerVButton.addEventListener('click', function (e) {
        e.preventDefault(); // Empêcher la soumission du formulaire

        const supprVoitureSelect = document.getElementById('suppr_voiture');
        const selectedOption = supprVoitureSelect.options[supprVoitureSelect.selectedIndex];

        const idASupprimer = selectedOption.value;
        const nomVoitureASupprimer = selectedOption.getAttribute('data-name');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './bdd/supprimer_voiture.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("La voiture " + nomVoitureASupprimer + " a été supprimée avec succès.");
                location.reload(); // Actualiser la page
            }
        };

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("supprimerv=true&suppr_voiture=" + idASupprimer);
    });

});
