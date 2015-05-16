CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO users (username, password) VALUES ('admin', 'password');

CREATE TABLE posts (
    id INTEGER AUTO_INCREMENT,
    headline VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    ispage BOOLEAN NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE comments (
    id INTEGER AUTO_INCREMENT,
    commentator VARCHAR(255) NOT NULL,
    comment VARCHAR(1000) NOT NULL,
    date DATETIME NOT NULL,
    post_id INTEGER NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);