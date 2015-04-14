CREATE TABLE User (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO User (username, password) VALUES ('admin', 'password');

CREATE TABLE Article (
    id INTEGER AUTO_INCREMENT,
    headline VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    ispage BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE Comment (
    id INTEGER AUTO_INCREMENT,
    commentator VARCHAR(255) NOT NULL,
    comment VARCHAR(1000) NOT NULL,
    date DATETIME NOT NULL,
    articleid INTEGER NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (articleid) REFERENCES Article(id)
);