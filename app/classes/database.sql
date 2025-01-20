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
    image_path varchar(255),
    contenu TEXT DEFAULT NULL,
    video_url varchar(255) DEFAULT NULL,
    status ENUM('En Attente','Accepte','Refuse') DEFAULT "En Attente",
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

CREATE VIEW CoursView AS
SELECT c.*,u.fullName 
FROM cours c
JOIN user u ON c.enseignant_id = u.id;
CREATE VIEW CoursViewAdmin AS
SELECT c.*,u.fullName 
FROM cours c
JOIN user u ON c.enseignant_id = u.id;
------

select count(*) as totalCours from cours;
select count(c.id) as totalCours,ca.titre,(SELECT COUNT(*) FROM categorie) AS totalCategorie from cours c inner join categorie ca on c.categorie_id = ca.id GROUP BY c.categorie_id LIMIT 3;
select count(*) as totalInscription,  cours.titre from etudiant_cours e inner join cours on cours.id = e.cours_id
group by cours_id ORDER by totalInscription desc limit 1;
select count(*) as totalInscription,  cours.titre, u.fullName from etudiant_cours e inner join cours on cours.id = e.cours_id inner join user u on cours.enseignant_id = u.id
group by cours_id ORDER by totalInscription desc limit 3;


--------Teacher

SELECT u.fullName, COUNT(e.id) AS totalInscriptions FROM etudiant_cours e INNER JOIN cours c ON c.id = e.cours_id INNER JOIN user u ON c.enseignant_id = u.id where enseignant_id=9 GROUP BY c.enseignant_id ORDER BY totalInscriptions DESC;


SELECT count(*) from cours where enseignant_id = 9 group by enseignant_id;