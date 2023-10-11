

document.addEventListener('DOMContentLoaded', function () {


    const resetButton = document.getElementById('res_bdd');
    const suprimerButton = document.getElementById('supr_all');



    resetButton.addEventListener('click', function () {
        const xhr = new XMLHttpRequest();
        console.log("click")
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
        console.log("click")
        xhr.open('POST', './bdd/bdd_supr.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {

                console.log('Base de données supprimer avec succès.');
                alert("La base de donnée a été supprimer avec succès.");
            }
        };
        xhr.send();
    });


});
