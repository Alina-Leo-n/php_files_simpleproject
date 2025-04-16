/** команды для создания пользователя sql и таблицы через терминал*/
CREATE DATABASE blog;
CREATE USER 'blog'@'localhost' IDENTIFIED BY '40>IRnS[';
GRANT ALL PRIVILEGES ON blog.* TO 'blog'@'localhost';

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

