CREATE DATABASE Final;
USE Final;

-- Table des membres
CREATE TABLE Final_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    date_de_naissance DATETIME,
    genre VARCHAR(20),
    email VARCHAR(50),
    ville VARCHAR(50),
    mdp VARCHAR(20),
    image_profil VARCHAR(100) 
);

-- Table des catégories d'objets
CREATE TABLE Final_categorie_objet(
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

-- Table des objets
CREATE TABLE Final_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES Final_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES Final_membre(id_membre)
);

-- Table des images des objets
CREATE TABLE Final_image_objet(
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(100),
    FOREIGN KEY (id_objet) REFERENCES Final_objet(id_objet)
);

-- Table des emprunts
CREATE TABLE Final_emprunt(
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATETIME,
    date_retour DATETIME,
    FOREIGN KEY (id_objet) REFERENCES Final_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES Final_membre(id_membre)
);

-- Insertion des membres
INSERT INTO Final_membre (nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice Dupont', '1990-05-15', 'Féminin', 'alice@email.com', 'Paris', 'mdp123', 'alice.jpg'),
('Bob Martin', '1985-08-22', 'Masculin', 'bob@email.com', 'Lyon', 'mdp456', 'bob.jpg'),
('Charlie Legrand', '1995-03-10', 'Non-binaire', 'charlie@email.com', 'Marseille', 'mdp789', 'charlie.jpg'),
('Diana Roy', '1988-11-30', 'Féminin', 'diana@email.com', 'Bordeaux', 'mdp101', 'diana.jpg');

-- Insertion des catégories
INSERT INTO Final_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO Final_objet (nom_objet, id_categorie, id_membre) VALUES
-- Alice (id_membre=1)
('Séchoir à cheveux', 1, 1), ('Miroir de maquillage', 1, 1), ('Perceuse', 2, 1), ('Scie électrique', 2, 1),
('Clé à molette', 3, 1), ('Cric hydraulique', 3, 1), ('Mixeur', 4, 1), ('Robot culinaire', 4, 1),
('Pinceau de maquillage', 1, 1), ('Ponceuse', 2, 1),

-- Bob (id_membre=2)
('Lisseur', 1, 2), ('Pince à épiler', 1, 2), ('Marteau', 2, 2), ('Tournevis', 2, 2),
('Jack de voiture', 3, 2), ('Trousse à outils', 3, 2), ('Poêle antiadhésive', 4, 2), ('Couteau de chef', 4, 2),
('Masque capillaire', 1, 2), ('Scie sauteuse', 2, 2),

-- Charlie (id_membre=3)
('Épilateur électrique', 1, 3), ('Brosse à cheveux', 1, 3), ('Visseuse', 2, 3), ('Niveau à bulle', 2, 3),
('Clé dynamométrique', 3, 3), ('Compresseur', 3, 3), ('Cocotte-minute', 4, 3), ('Grille-pain', 4, 3),
('Palette de fard à paupières', 1, 3), ('Étau', 2, 3),

-- Diana (id_membre=4)
('Rasoir électrique', 1, 4), ('Crème hydratante', 1, 4), ('Perforateur', 2, 4), ('Pince coupante', 2, 4),
('Outil de diagnostic voiture', 3, 4), ('Cric mécanique', 3, 4), ('Machine à café', 4, 4), ('Fouet électrique', 4, 4),
('Bain de bouche', 1, 4), ('Ruban à mesurer', 2, 4);

-- Insertion des images des objets (1 image par objet)
INSERT INTO Final_image_objet (id_objet, nom_image) VALUES
(1, 'sechoir.jpg'), (2, 'miroir.jpg'), (3, 'perceuse.jpg'), (4, 'scie.jpg'),
(5, 'cle_molette.jpg'), (6, 'cric.jpg'), (7, 'mixeur.jpg'), (8, 'robot.jpg'),
(9, 'pinceau.jpg'), (10, 'ponceuse.jpg'), (11, 'lisseur.jpg'), (12, 'pince.jpg'),
(13, 'marteau.jpg'), (14, 'tournevis.jpg'), (15, 'jack.jpg'), (16, 'trousse.jpg'),
(17, 'poele.jpg'), (18, 'couteau.jpg'), (19, 'masque.jpg'), (20, 'scie_sauteuse.jpg'),
(21, 'epilateur.jpg'), (22, 'brosse.jpg'), (23, 'visseuse.jpg'), (24, 'niveau.jpg'),
(25, 'cle_dyno.jpg'), (26, 'compresseur.jpg'), (27, 'cocotte.jpg'), (28, 'grille_pain.jpg'),
(29, 'palette.jpg'), (30, 'etau.jpg'), (31, 'rasoir.jpg'), (32, 'creme.jpg'),
(33, 'perforateur.jpg'), (34, 'pince_coupante.jpg'), (35, 'diagnostic.jpg'), (36, 'cric_meca.jpg'),
(37, 'cafe.jpg'), (38, 'fouet.jpg'), (39, 'bain_bouche.jpg'), (40, 'ruban.jpg');

-- Insertion des emprunts (10 emprunts)
INSERT INTO Final_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2023-10-01 14:00:00', '2023-10-08 14:00:00'),  -- Bob emprunte le séchoir d'Alice
(3, 4, '2023-10-02 10:30:00', '2023-10-09 10:30:00'),  -- Diana emprunte la perceuse d'Alice
(5, 3, '2023-10-03 16:45:00', '2023-10-10 16:45:00'),  -- Charlie emprunte la clé à molette d'Alice
(7, 2, '2023-10-04 09:15:00', '2023-10-11 09:15:00'),  -- Bob emprunte le mixeur d'Alice
(11, 1, '2023-10-05 13:20:00', '2023-10-12 13:20:00'),  -- Alice emprunte le lisseur de Bob
(13, 4, '2023-10-06 11:00:00', '2023-10-13 11:00:00'),  -- Diana emprunte le marteau de Bob
(17, 3, '2023-10-07 15:30:00', '2023-10-14 15:30:00'),  -- Charlie emprunte la poêle de Bob
(21, 4, '2023-10-08 08:45:00', '2023-10-15 08:45:00'),  -- Diana emprunte l'épilateur de Charlie
(25, 1, '2023-10-09 17:00:00', '2023-10-16 17:00:00'),  -- Alice emprunte la clé dynamométrique de Charlie
(31, 3, '2023-10-10 12:10:00', '2023-10-17 12:10:00');  -- Charlie emprunte le rasoir de Diana

UPDATE Final_emprunt SET date_retour = '2030-12-01 14:00:00';

CREATE VIEW v_emprunts_en_cours AS
SELECT o.nom_objet, i.nom_image,e.date_emprunt,
    CASE 
        WHEN e.date_retour > NOW() THEN e.date_retour 
        ELSE NULL 
    END AS date_retour,
    m.nom AS emprunteur
FROM Final_emprunt e
JOIN Final_objet o ON e.id_objet = o.id_objet
JOIN Final_membre m ON e.id_membre = m.id_membre
LEFT JOIN Final_image_objet i ON o.id_objet = i.id_objet;

CREATE VIEW v_emprunts AS
SELECT 
    o.nom_objet,
    i.nom_image,
    e.date_emprunt,
    e.date_retour,
    m.nom AS emprunteur
FROM Final_emprunt e
JOIN Final_objet o ON e.id_objet = o.id_objet
JOIN Final_membre m ON e.id_membre = m.id_membre
LEFT JOIN Final_image_objet i ON o.id_objet = i.id_objet;

CREATE VIEW v_objets_empruntes_detailles AS
SELECT 
    o.nom_objet,
    i.nom_image,
    e.date_emprunt,
    CASE 
        WHEN e.date_retour > NOW() THEN e.date_retour 
        ELSE NULL 
    END AS date_retour,
    m.nom AS emprunteur,
    c.nom_categorie,
    o.id_categorie
FROM Final_emprunt e
JOIN Final_objet o ON e.id_objet = o.id_objet
JOIN Final_membre m ON e.id_membre = m.id_membre
LEFT JOIN Final_image_objet i ON o.id_objet = i.id_objet
JOIN Final_categorie_objet c ON o.id_categorie = c.id_categorie;


<<<<<<< HEAD
CREATE OR REPLACE TABLE Final_sous_image(
    id_sous_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_image_principale INT,
    nom_sous_image VARCHAR(100),
    FOREIGN KEY (id_image_principale) REFERENCES Final_image_objet(id_image) 
);

-- Insertion de sous-images avec id_objet et id_image_principale
INSERT INTO Final_sous_image (id_objet, id_image_principale, nom_sous_image) VALUES
(1, 1, 'sechoir_vue_arriere.jpg'),
(1, 1, 'sechoir_bouton_zoom.jpg'),
(3, 3, 'perceuse_cote.jpg'),
(3, 3, 'perceuse_detail_poignee.jpg'),
(7, 7, 'mixeur_lame.jpg'),
(8, 8, 'robot_accessoires.jpg'),
(13, 13, 'marteau_manche.jpg'),
(17, 17, 'poele_fond.jpg'),
(20, 20, 'scie_sauteuse_vue_dessus.jpg'),
(21, 21, 'epilateur_accessoires.jpg'),
(25, 25, 'cle_dyno_detail.jpg'),
(27, 27, 'cocotte_interieur.jpg'),
(31, 31, 'rasoir_dos.jpg'),
(35, 35, 'diagnostic_ecran.jpg'),
(38, 38, 'fouet_detail_grille.jpg');

=======
>>>>>>> efa28aa (v2.1Estelle)
