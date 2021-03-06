CREATE DATABASE doingsdone
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE doingsdone;
CREATE TABLE users (
                     id INT AUTO_INCREMENT PRIMARY KEY,
                     email VARCHAR(128) NOT NULL UNIQUE,
                     dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                     password CHAR(64) NOT NULL,
                     name VARCHAR(128) NOT NULL
);
CREATE TABLE projects (
                     id INT AUTO_INCREMENT PRIMARY KEY,
                     user_id INT UNSIGNED NOT NULL,
                     content TEXT NOT NULL
);
CREATE TABLE tasks (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT UNSIGNED NOT NULL,
                        project_id INT UNSIGNED NOT NULL,
                        dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        content TEXT NOT NULL,
                        complete INT DEFAULT 0,
                        dt_end TIMESTAMP DEFAULT NULL,
                        url TEXT DEFAULT NULL

);
CREATE FULLTEXT INDEX task_search ON tasks (content)

