document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.choix');

    const choisiaffDivs = document.querySelectorAll('.choisiaff');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = button.getAttribute('data-target');

            choisiaffDivs.forEach(div => {
                div.style.display = 'none';
            });

            const targetDiv = document.getElementById(targetId);
            if (targetDiv) {
                targetDiv.style.display = 'block';
            }
        });
    });


    const resetButton = document.getElementById('resetbdd');
    const suprimerButton = document.getElementById('supr_all');

    resetButton.addEventListener('click', function () {
        const xhr = new XMLHttpRequest();
        console.log("click");
        xhr.open('POST', './bdd/bdd_res.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Base de données réinitialisée avec succès.');
                alert("La base de donnée a été réinitialisée avec succès.");
            }
        };
        xhr.send();
    });

    suprimerButton.addEventListener('click', function () {
        const xhr = new XMLHttpRequest();
        console.log("click");
        xhr.open('POST', './bdd/bdd_supr.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Base de données supprimée avec succès.');
                alert("La base de donnée a été supprimée avec succès.");
            }
        };
        xhr.send();
    });
});
