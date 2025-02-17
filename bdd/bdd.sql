-- Supprimer la base de données si elle existe déjà
DROP DATABASE IF EXISTS fil_rouge_401_Corneille_Jules;

-- Créer une nouvelle base de données
CREATE DATABASE fil_rouge_401_Corneille_Jules;

-- Utiliser la base de données nouvellement créée
USE fil_rouge_401_Corneille_Jules;

-- Créer la table ApiContinent
CREATE TABLE IF NOT EXISTS ApiContinent (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_pays VARCHAR(255) NOT NULL UNIQUE,
    drapeaupays VARCHAR(255) NOT NULL,
    arabworld BOOLEAN NOT NULL,
    continentaleurope BOOLEAN NOT NULL,
    asiaoceania BOOLEAN NOT NULL,
    europecentralasia BOOLEAN NOT NULL,
    latinamericacaribbean BOOLEAN NOT NULL,
    northamerica BOOLEAN NOT NULL,
    subsaharanafrica BOOLEAN NOT NULL
);

-- Créer la table ApiConstructeur
CREATE TABLE IF NOT EXISTS ApiConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    creation VARCHAR(4),
    fondateur VARCHAR(255),
    pays INT,
    FOREIGN KEY (pays) REFERENCES ApiContinent(id)
);

-- Créer la table UsinesConstructeur
CREATE TABLE IF NOT EXISTS UsinesConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usines VARCHAR(255) NOT NULL
);

-- Créer la table LinkUsines avec les colonnes comme clés primaires
CREATE TABLE IF NOT EXISTS LinkUsines (
    id_constructeurs INT NOT NULL,
    idusines INT NOT NULL,
    PRIMARY KEY (id_constructeurs, idusines),
    FOREIGN KEY (id_constructeurs) REFERENCES ApiConstructeur(id),
    FOREIGN KEY (idusines) REFERENCES UsinesConstructeur(id)
);

-- Créer la table ApiVoitures
CREATE TABLE IF NOT EXISTS ApiVoitures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    constructeur INT NOT NULL,
    production INT NOT NULL,
    image VARCHAR(500) NOT NULL,
    FOREIGN KEY (constructeur) REFERENCES ApiConstructeur(id)
);

-- Créer l'utilisateur s'il n'existe pas
CREATE USER IF NOT EXISTS 'Fil_Rouge_Jules_Conrneille'@'db' IDENTIFIED BY '1234';

-- Accorder tous les privilèges à l'utilisateur sur la base de données
GRANT ALL PRIVILEGES ON fil_rouge_401_Corneille_Jules.* TO 'Fil_Rouge_Jules_Conrneille'@'db';

-- Mettre à jour les privilèges
FLUSH PRIVILEGES;


-- Insertion de données depuis la première API (constructeurs)
INSERT INTO ApiContinent (nom_pays, drapeaupays, arabworld, continentaleurope, asiaoceania, europecentralasia, latinamericacaribbean, northamerica, subsaharanafrica)
VALUES
    ('France', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%29.svg/1280px-Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%29.svg.png', 0, 1, 0, 0, 0, 0, 0),
    ('Germany', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Flag_of_Germany.svg/1920px-Flag_of_Germany.svg.png', 0, 1, 0, 0, 0, 0, 0),
    ('United Kingdom', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Flag_of_the_United_Kingdom_%283-5%29.svg/1920px-Flag_of_the_United_Kingdom_%283-5%29.svg.png', 0, 1, 0, 0, 0, 0, 0),
    ('Italy', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Italy.svg/1920px-Flag_of_Italy.svg.png', 0, 1, 0, 0, 0, 0, 0),
    ('Japan', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Flag_of_Japan.svg/1280px-Flag_of_Japan.svg.png', 0, 0, 1, 0, 0, 0, 0),
    ('United States', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Flag_of_the_United_States.svg/1920px-Flag_of_the_United_States.svg.png', 0, 0, 0, 0, 1, 1, 0);

-- Insertion de données depuis la première API (constructeurs)
INSERT INTO ApiConstructeur (nom, creation, fondateur, pays)
VALUES
    ('Renault', '1899', 'Fernand et Marcel Renault', 1),
    ('BMW', '1916', 'Gustav Otto, Karl Rapp', 2),
    ('Mercedes-Benz', '1926', 'Paul Faimler, Carl Benz et Emil Jellinek-Mercedes', 2),
    ('Vauxhall', '1857', 'inconnu', 3),
    ('Fiat', '1899', 'Giovanni Agnelli', 4),
    ('Honda', '1948', 'Soichiro Honda et Takeo Fujisawa', 5),
    ('Tesla', '2003', 'Elon Musk', 6);

-- Insertion de données des usines pour le constructeur 
INSERT INTO UsinesConstructeur (usines)
VALUES
    ('Palencia'), ('Douai'), ('Bursa'), ('France'), ('Palencia'), ('Sandouville'), ('Dieppe'),
    ('Melfi'), ('Allemagne'), ('Dingolfing'),
    ('Allemagne'), ('France'),
    ('Angleterre'), ('USA'), ('London City'),
    ('Melfi'), ('Betim'), ('Palencia'), ('Rangaojon'), ('France'), ('Cordoba'), ('Betim'), ('Nanjing'), ('Kurla'), ('Casablanca'),
    ('Tokio'), ('Chine'), ('Inde'), ('Melbourne'),
    ('Berlin'), ('Texas'), ('Chine');

-- Insertion de données des lien des usines pour le constructeur
INSERT INTO LinkUsines (id_constructeurs, idusines)
VALUES
    (1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7),
    (2, 8), (2, 9), (2, 10),
    (3, 11), (3, 12),
    (4, 13), (4, 14), (4, 15),
    (5, 16), (5, 17), (5, 18), (5, 19), (5, 20), (5, 21), (5, 22), (5, 23), (5, 24), (5, 25),
    (6, 26), (6, 27), (6, 28), (6, 29),
    (7, 30), (7, 31), (7, 32);

-- Insertion de données depuis la deuxième API (voitures)
INSERT INTO ApiVoitures (nom, description, constructeur, production, image)
VALUES
    ('Megane 3', '2008 - 2016', 1, 4000000, 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Renault_M%C3%A9gane_Paris_Deluxe_ENERGY_TCe_115_Start_%26_Stop_eco%C2%B2_%28III%2C_2._Facelift%29_%E2%80%93_Frontansicht%2C_13._Juli_2014%2C_Ratingen.jpg/2560px-Renault_M%C3%A9gane_Paris_Deluxe_ENERGY_TCe_115_Start_%26_Stop_eco%C2%B2_%28III%2C_2._Facelift%29_%E2%80%93_Frontansicht%2C_13._Juli_2014%2C_Ratingen.jpg'),
    ('Renault R3', '1961 - 1962', 1, 2526, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/R3_1.jpg/560px-R3_1.jpg'),
    ('Renault Laguna III', '2007 - 2015', 1, 351384, 'https://upload.wikimedia.org/wikipedia/commons/5/5f/Renault_Laguna_III_Phase_I_front-1.JPG?uselang=fr'),
    ('Fiat Punto III', 'depuis 2005', 5, 1000000, 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Grande_punto_5tuerer.jpg/560px-Grande_punto_5tuerer.jpg'),
    ('Fiat Uno', '1983 - 2013', 5, 11000000, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/1984_Fiat_Uno_70S_%2811599974013%29.jpg/560px-1984_Fiat_Uno_70S_%2811599974013%29.jpg'),
    ('BMW Serie 3 (E21)', '1975 - 1983', 2, 1364039, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/BMW_E21_front_20080331.jpg/560px-BMW_E21_front_20080331.jpg'),
    ('BMW Serie 7', 'depuis 1977', 2, 999999, 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/2016_BMW_7-Series_%28G11%29_sedan%2C_front_view.jpg/560px-2016_BMW_7-Series_%28G11%29_sedan%2C_front_view.jpg'),
    ('Tesla Model 3', '0 - ∞', 7, 1, 'https://www.notebookcheck.biz/fileadmin/Notebooks/News/_nc3/Tesla_Model_3_Offroad_Tuning_Panzer.jpg'),
    ('Tesla Model Y', '0 - ∞', 7, 1, 'https://europe.radioflyer.com/media/catalog/product/m/y/my-first-model-y-inset-profile-side-right-model-633.jpg'),
    ('Tesla Model S', '0 - ∞', 7, 1, 'https://s1.cdn.autoevolution.com/images/news/funny-spacex-parody-features-tesla-model-s-dancing-elon-musk-video-94527_1.jpg'),
    ('Tesla Model X', '0 - ∞', 7, 1, 'https://www.carscoops.com/wp-content/uploads/2023/04/Tesla-Model-X-Danubea.jpg');
