-- Suppression des tables dans l'ordre inverse des dépendances
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS chara;
DROP TABLE IF EXISTS anime;

-- Table des animes
CREATE TABLE anime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    genre VARCHAR(50),
    release DATE
);

-- Table des personnages
CREATE TABLE chara (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(70) NOT NULL,
    lastname VARCHAR(70),
    age INT,
    anime_id INT NOT NULL,
    FOREIGN KEY (anime_id) REFERENCES anime(id)
);

-- Table des commentaires (corrigée selon tes instructions)
CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author VARCHAR(70) NOT NULL,
    content VARCHAR(300) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    likes ENUM('like', 'dislike'),
    chara_id INT NOT NULL,
    FOREIGN KEY (chara_id) REFERENCES chara(id)
);

-- Insertion d'animes
INSERT INTO anime (name, genre, release) VALUES
('One Piece', 'Aventure', '1999-10-20'),
('JoJo''s Bizarre Adventure', 'Action', '2012-10-06'),
('Sugar Sugar Rune', 'Magie', '2005-07-02');

-- Insertion de personnages
INSERT INTO chara (firstname, lastname, age, anime_id) VALUES
('Zoro', 'Roronoa', 21, 1),
('Dio', 'Brando', 119, 2),
('Chocolat', 'Meilleure', 13, 3),
('Luffy', 'Monkey D.', 19, 1),
('Jonathan', 'Joestar', 20, 2);

-- Insertion de commentaires
INSERT INTO comment (author, content, likes, chara_id) VALUES
('NamiFan', 'C\'est pas crédible que Zoro utilise autant de sabres !', 'dislike', 1),
('StandUser42', 'Dio est un méchant iconique, j''adore.', 'like', 2),
('SweetLover', 'Chocolat est adorable et forte !', 'like', 3),
('LuffyFan', 'Le roi des pirates en devenir !', 'like', 4),
('HistoryNerd', 'Jonathan a une morale incroyable mais c\'est tout.', 'dislike', 5),
('ZoroFan2', 'Le sens de l’orientation de Zoro est légendaire 😂', 'like', 1);
