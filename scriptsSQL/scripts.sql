CREATE TABLE IF NOT EXISTS card (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    image VARCHAR(50),
    description VARCHAR(50),
    category VARCHAR(50)
);
INSERT INTO card (name, image, description, category) VALUES ('test','image','desc3','cat');