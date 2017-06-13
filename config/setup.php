<?php
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("CREATE DATABASE IF NOT EXISTS camagru");
    $db->exec("USE camagru");
    $db->exec("CREATE TABLE IF NOT EXISTS `camagru`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`), `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',`tokenCode` varchar(100) NOT NULL) ENGINE = InnoDB;");
    $db->exec("CREATE TABLE IF NOT EXISTS `camagru`.`images` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `path` VARCHAR(255) NOT NULL , `likes` INT NOT NULL , PRIMARY KEY (`id`) , FOREIGN KEY (`user_id`) REFERENCES users(`id`) ) ENGINE = InnoDB;");
    $db->exec("ALTER TABLE `images` ADD INDEX( `user_id`);");
    $db->exec("CREATE TABLE IF NOT EXISTS `camagru`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `commenter_id` INT NOT NULL , `image_id` INT NOT NULL, `message` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`), FOREIGN KEY (`user_id`) REFERENCES users(`id`), FOREIGN KEY (`image_id`) REFERENCES images(`id`), FOREIGN KEY (`commenter_id`) REFERENCES users(`id`)) ENGINE = InnoDB;");
    $db->exec("ALTER TABLE `comments` ADD INDEX( `user_id`);");
    $db->exec("ALTER TABLE `comments` ADD INDEX( `commenter_id`);");

} catch (PDOException $ex) {
    print $ex->getMessage();
    exit(0);
}