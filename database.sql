-- Active: 1749736097128@@localhost@3306@anime_chara_blog


--table des personnages
DROP TABLE IF EXISTS chara;
DROP TABLE IF EXISTS anime;
CREATE TABLE chara (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(70) NOT NULL,
    lastname VARCHAR(70),
    age INT
);

CREATE TABLE anime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(70) NOT NULL,
    genre VARCHAR(70),
    year DATE
);

CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    date DATETIME,
    likes INT, 
    author VARCHAR(40),
    charaID INT,
    FOREIGN KEY (charaID) REFERENCES chara(id) ON DELETE CASCADE
);

INSERT INTO chara (firstname,lastname,age) VALUES 
("Zoro", "Roronoa", 21),
("Dio", "Brando", 119),
("Chocolat", "Meilleure ", 13);

INSERT INTO anime (name,genre,year) VALUES 
("Zoro", "Roronoa", 21),
("Dio", "Brando", 119),
("Chocolat", "Meilleure ", 13);

