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
ALTER TABLE posts 
ADD COLUMN is_deleted TINYINT(1) DEFAULT 0,

define('DB_HOST', 'localhost');
define('DB_USER', 'blog');
define('DB_PASSWORD', '40>IRnS[');
define('DB_NAME', 'blog');
