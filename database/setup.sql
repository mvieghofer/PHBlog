CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE roles (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO roles (name, description, created_at, updated_at) VALUES ('Administrator', 'The administrator of the blog. A user with this role has all rights.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO roles (name, description, created_at, updated_at) VALUES ('Author', 'An author of the blog. A user with this role may write new posts. However administration tasks cannot be performed.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO roles (name, description, created_at, updated_at) VALUES ('User', 'A user of the blog. The only special right of a user with this role is to access the member area and view content limited to registered users.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE TABLE user_roles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
)

CREATE TABLE user_password_reset (
    user_id INT NOT NULL,
    token VARCHAR(32) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)

CREATE TABLE posts (
    id INTEGER AUTO_INCREMENT,
    headline VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    ispage BOOLEAN NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE comments (
    id INTEGER AUTO_INCREMENT,
    commentator VARCHAR(255) NOT NULL,
    comment VARCHAR(1000) NOT NULL,
    date DATETIME NOT NULL,
    post_id INTEGER NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);