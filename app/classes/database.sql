CREATE DATABASE youdemy;
USE youdemy;
CREATE TABLE IF NOT EXISTS Tag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50)
);
CREATE TABLE IF NOT EXISTS  user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) ,
    fullName VARCHAR(255),
    password VARCHAR(255),
    role enum("etudiant","enseignant","admin"),
    banned boolean DEFAULT false,
    active boolean DEFAULT true
);
CREATE TABLE IF NOT EXISTS  Categorie(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50)
);
CREATE TABLE IF NOT EXISTS  cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    enseignant_id INT,
    categorie_id INT(100),
    contenu_type ENUM('texte', 'video'),
    contenu TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id),
    FOREIGN KEY (enseignant_id) REFERENCES User(id)
);
CREATE TABLE IF NOT EXISTS  cours_tag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT,
    tag_id INT,
    FOREIGN KEY (cours_id) REFERENCES Cours(id),
    FOREIGN KEY (tag_id) REFERENCES Tag(id)

);
CREATE TABLE IF NOT EXISTS  etudiant_cours(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT,
    etudiant_id INT,
    FOREIGN KEY (cours_id) REFERENCES Cours(id),
    FOREIGN KEY (etudiant_id) REFERENCES user(id)
);
