-- Suppression des tables dans l'ordre inverse des dépendances
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS chara;
DROP TABLE IF EXISTS anime;

-- Table des animes
CREATE TABLE anime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    genre VARCHAR(50),
    released DATE,
    poster VARCHAR(150)
);

-- Table des personnages
CREATE TABLE chara (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(70) NOT NULL,
    lastname VARCHAR(70),
    age INT,
    picture VARCHAR(150),
    animeID INT NOT NULL,
    FOREIGN KEY (animeID) REFERENCES anime(id)
);

-- Table des commentaires (corrigée selon tes instructions)
CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author VARCHAR(70) NOT NULL,
    content VARCHAR(300) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    likes ENUM('like', 'dislike'),
    charaID INT NOT NULL,
    FOREIGN KEY (charaID) REFERENCES chara(id)
);

-- Insertion d'animes
INSERT INTO anime (name, genre, released, poster) VALUES
('One Piece', 'Aventure', '1999-10-20','public\img\one_piece.png'),
('JoJo\'s Bizarre Adventure', 'Action', '2012-10-06', 'public\img\jojo.jpg'),
('Sugar Sugar Rune', 'Magie', '2005-07-02', 'public\img\sugar_sugar_rune.jpg'),
('JoJo\'s Bizarre Adventure', 'Action', '2012-10-06', 'public\img\jojo.jpg'),
('Sugar Sugar Rune', 'Magie', '2005-07-02', 'public\img\sugar_sugar_rune.jpg'),
('JoJo\'s Bizarre Adventure', 'Action', '2012-10-06', 'public\img\jojo.jpg'),
('One Piece', 'Aventure', '1999-10-20', 'public\img\one_piece.png'),
('Sugar Sugar Rune', 'Magie', '2005-07-02', 'public\img\sugar_sugar_rune.jpg');

-- Insertion de personnages
INSERT INTO chara (firstname, lastname, age, picture, animeID) VALUES
('Zoro', 'Roronoa', 21, 'public\img\zoro.jpg', 1),
('Dio', 'Brando', 119,'public\img\Dio.png', 2),
('Chocolat', 'Meilleure', 13,'public\img\Chocolat.jpg', 3),
('Luffy', 'Monkey D.', 19,'public\img\Luffy.jpg', 1),
('Jonathan', 'Joestar', 20,'public\img\Joestar.jpg', 2);

-- Insertion de commentaires
INSERT INTO comment (author, content, likes, charaID) VALUES
('NamiFan', 'C\'est pas crédible que Zoro utilise autant de sabres !', 'dislike', 1),
('StandUser42', 'Dio est un méchant iconique, j\'adore.', 'like', 2),
('SweetLover', 'Chocolat est adorable et forte !', 'like', 3),
('LuffyFan', 'Le roi des pirates en devenir !', 'like', 4),
('HistoryNerd', 'Jonathan a une morale incroyable mais c\'est tout.', 'dislike', 5),
('ZoroFan2', 'Le sens de l’orientation de Zoro est légendaire 😂', 'like', 1);
