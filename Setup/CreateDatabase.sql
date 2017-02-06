CREATE DATABASE IF NOT EXISTS blog_database;

USE blog_database;

CREATE TABLE IF NOT EXISTS user (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `nickname` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(100) NOT NULL UNIQUE,
    `password_hash` VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS blog_post (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `published` TINYINT(1),
    `posted` DATETIME,
    `updated` DATETIME,
    `title` VARCHAR(500) NOT NULL,
    `slug` VARCHAR(200),
    `blog_text_id` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS blog_post_text (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `short_description` VARCHAR(1000),
    `blog_text` TEXT
);

CREATE TABLE IF NOT EXISTS user_permission (
    `user_id` INT NOT NULL PRIMARY KEY,
    `is_admin` TINYINT(1)
);

CREATE TABLE IF NOT EXISTS user_password_reset (
    `url_code` VARCHAR(40) NOT NULL PRIMARY KEY,
    `user_id` INT NOT NULL,
    `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
