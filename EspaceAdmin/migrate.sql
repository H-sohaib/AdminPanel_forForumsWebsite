SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `admin`;

DROP TABLE IF EXISTS `role`;

DROP TABLE IF EXISTS `responsable`;

DROP TABLE IF EXISTS `facture`;

DROP TABLE IF EXISTS `exposants`;

DROP TABLE IF EXISTS `type_offre`;

DROP TABLE IF EXISTS `offre`;

DROP TABLE IF EXISTS `forum`;

DROP TABLE IF EXISTS `entreprise`;

DROP TABLE IF EXISTS `commande`;

DROP TABLE IF EXISTS `archive_commande`;

DROP TABLE IF EXISTS `archive_details_commandes`;

DROP TABLE IF EXISTS `forums_offres`;

-- role table

CREATE TABLE
    role (
        id_role INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        niveau INT,
        description TEXT
    );

-- insert to role table

INSERT INTO
    role (niveau, description)
VALUES (0, 'niveau zero'), (1, 'niveau un'), (2, 'niveau deux'), (3, 'niveau trois');

-- admin table

CREATE TABLE
    admin (
        id_admin INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        id_role INTEGER,
        nom VARCHAR(255) NOT NULL,
        prenom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        PASSWORD VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_role) REFERENCES role(id_role)
    );

-- insert to admin table

INSERT INTO
    admin (
        id_role,
        nom,
        prenom,
        email,
        password
    )
VALUES (
        4,
        'test',
        'test',
        'harraoui.sohaib1@gmail.com',
        '$2y$10$TwmVatVQDo6hvXCrKmi9V.9LToG1mlAPVo6rW3ZTUr9Xynpvn91Cy'
    ), (
        3,
        'test',
        'test',
        'test.test@gmail.com',
        '$2y$10$TwmVatVQDo6hvXCrKmi9V.9LToG1mlAPVo6rW3ZTUr9Xynpvn91Cy'
    );

-- entreprise table

CREATE TABLE
    entreprise (
        id_entreprise INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        secteur VARCHAR(255) NOT NULL,
        ville VARCHAR(255) NOT NULL,
        code_postal INTEGER NOT NULL,
        adresse VARCHAR(255) NOT NULL,
        telephone VARCHAR(255),
        logo VARCHAR(255)
    );

-- insert to entreprise table

INSERT INTO
    entreprise (
        nom,
        secteur,
        ville,
        code_postal,
        adresse
    )
VALUES (
        'test entrepri',
        'test secteur',
        'test ville',
        123456,
        'test adresse'
    );

-- forum table

CREATE TABLE
    forum (
        id_forum INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        lieu VARCHAR(255) NOT NULL,
        date_debut_forum DATE,
        date_fin_forum DATE,
        date_fin_inscription DATE,
        TYPE VARCHAR(255),
        visible BOOLEAN,
        date_creation VARCHAR(255),
        unique_id VARCHAR(255),
        photo VARCHAR(255)
    );

-- forum offre

CREATE TABLE
    offre (
        id_offre INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        prix_unitaire BIGINT,
        visible BOOLEAN,
        disponible BOOLEAN,
        id_type_offre INTEGER,
        FOREIGN KEY (id_type_offre) REFERENCES type_offre(id_type_offre)
    );

CREATE TABLE
    forums_offres (
        id_offre INTEGER,
        id_forum INTEGER,
        FOREIGN KEY (id_offre) REFERENCES offre(id_offre),
        FOREIGN KEY (id_forum) REFERENCES forum(id_forum)
    );

CREATE TABLE
    type_offre (
        id_type_offre INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom_type VARCHAR(255) NOT NULL
    );

INSERT INTO
    type_offre (nom_type)
VALUES ('Type offre 1'), ('Type offre 2'), ('Type offre 3'), ('Type offre 4');

CREATE TABLE
    exposants (
        id_exposants INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prenom VARCHAR(255) NOT NULL,
        fonction VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telephone VARCHAR(255),
        id_entreprise VARCHAR(255) NOT NULL,
        id_commande INTEGER NOT NULL,
        uniqueID VARCHAR(255) NOT NULL
    );

CREATE TABLE
    facture (
        id_facture INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom_facture VARCHAR(255) NOT NULL,
        size VARCHAR(255) NOT NULL,
        description TEXT,
        id_entreprise VARCHAR(255) NOT NULL,
        id_commande INTEGER
    );

CREATE TABLE
    responsable (
        id_responsable INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prenom VARCHAR(255) NOT NULL,
        fonction VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telephone INTEGER,
        PASSWORD VARCHAR(255) NOT NULL,
        verify VARCHAR(25)
    );

CREATE TABLE
    commande (
        id_commande INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        id_entreprise INTEGER,
        id_admin INTEGER,
        statut VARCHAR(255),
        nom_forum VARCHAR(255),
        bon_de_commande VARCHAR(255),
        total VARCHAR(255),
        date_commande DATE,
        bon_de_commande_signee VARCHAR(255)
    );

CREATE TABLE
    archive_commande (
        id_archive_commande INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        statut VARCHAR(255)
    );

CREATE TABLE
    archive_details_commandes (
        id_archive_details_commandes INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,
        id_commande INTEGER
    );

-- CREATE TABLE

--     conference (

--         id_conference INTEGER UNIQUE AUTO_INCREMENT PRIMARY KEY,

--         -- ********************

--     );

SET FOREIGN_KEY_CHECKS = 1;