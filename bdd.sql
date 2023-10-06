DROP DATABASE IF EXISTS fil_rouge_401_Corneille_Jules;

CREATE DATABASE IF NOT EXISTS fil_rouge_401_Corneille_Jules;

USE fil_rouge_401_Corneille_Jules;

-- Création de la table ApiConstructeur
CREATE TABLE ApiConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    creation INT NOT NULL,
    fondateur VARCHAR(255) NOT NULL,
    pays VARCHAR(50) NOT NULL
);

-- Création de la table UsinesConstructeur
CREATE TABLE UsinesConstructeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_constructeurs INT NOT NULL,
    usines VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_constructeurs) REFERENCES ApiConstructeur(id)
);

-- Création de la table ApiVoitures
CREATE TABLE ApiVoitures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    constructeur INT NOT NULL,
    production INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (constructeur) REFERENCES ApiConstructeur(id)
);


-- Insertion de données depuis la première API (constructeurs)
INSERT INTO ApiConstructeur (nom, creation, fondateur, pays)
VALUES
    ('Renault', 1899, 'Fernand et Marcel Renault', 'France'),
    ('BMW', 1916, 'Gustav Otto, Karl Rapp', 'Allemagne'),
    ('Mercedes-Benz', 1926, 'Paul Faimler, Carl Benz et Emil Jellinek-Mercedes', 'Allemagne'),
    ('Vauxhall', 1857, 'inconnu', 'Angleterre'),
    ('Fiat', 1899, 'Giovanni Agnelli', 'Italie'),
    ('Honda', 1948, 'Soichiro Honda et Takeo Fujisawa', 'Japon'),
    ('Tesla', 2003, 'Elon Musk', 'Etats-Unis');

-- Insertion de données des usines pour le constructeur Renault
INSERT INTO UsinesConstructeur (id_constructeurs, usines)
VALUES
    (1, 'Palencia'), (1, 'Douai'), (1, 'Bursa'), (1, 'France'), (1, 'Palencia'), (1, 'Sandouville'), (1, 'Dieppe'),
    (2, 'Melfi'), (2, 'Allemagne'), (2, 'Dingolfing'),
    (3, 'Allemagne'), (3, 'France'),
    (4, 'Angleterre'), (4, 'USA'), (4, 'London City'),
    (5, 'Melfi'), (5, 'Betim'), (5, 'Palencia'), (5, 'Rangaojon'), (5, 'France'), (5, 'Cordoba'), (5, 'Betim'), (5, 'Nanjing'), (5, 'Kurla'), (5, 'Casablanca'),
    (6, 'Tokio'), (6, 'Chine'), (6, 'Inde'), (6, 'Melbourne'),
    (7, 'Berlin'), (7, 'Texas'), (7, 'Chine');

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

