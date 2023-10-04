-- Création de la table ApiConstructeur
CREATE TABLE ApiConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    creation INT NOTNULL,
    fondateur VARCHAR(255) NOTNULL,
    pays VARCHAR(50)NOTNULL
);

-- Création de la table UsinesConstructeur
CREATE TABLE UsinesConstructeur(
    id INT AUTOINCREMENT,
    id_constructeurs INT NOTNULL,
    usines VARCHAR(255) NOTNULL
);

-- Création de la table ApiVoitures
CREATE TABLE ApiVoitures(
    nom VARCHAR(255) NOTNULL,
    description VARCHAR(255) NOTNULL,
    id INT AUTOINCREMENT,
    constructeur INT NOTNULL,
    production INT NOTNULL,
    image VARCHAR(255) NOTNULL
);


-- Insertion de données dans la table ApiConstructeur
INSERT INTO ApiConstructeur (nom, creation, fondateur, pays)
VALUES ('Renault', 1899, 'Fernand et Marcel Renault', 'France');



-- Insertion de données dans la table UsinesConstructeur
INSERT INTO UsinesConstructeur (id_constructeurs, usines)
VALUES (1, 'Palencia');

-- Insertion de données dans la table ApiVoitures
INSERT INTO ApiVoitures (nom, description, constructeur, production, image)
VALUES ('Megane 3', '2008 - 2016', 1, 400000,'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Renault_Mégane_Paris_Deluxe_ENERGY_TCe_115_Start_%26_Stop_eco²_%28III%2C_2._Facelift%29_–_Frontansicht%2C_13._Juli_2014%2C_Ratingen.jpg/2560px-Renault_Mégane_Paris_Deluxe_ENERGY_TCe_115_Start_%26_Stop_eco²_%28III%2C_2._Facelift%29_–_Frontansicht%2C_13._Juli_2014%2C_Ratingen.jpg');
