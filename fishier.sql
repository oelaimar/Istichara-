CREATE TABLE city(
id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(150) NOT NULL
);
CREATE TABLE Lawyer(
id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(150) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
phone VARCHAR(30) NOT NULL UNIQUE,
years_of_experiences INT,
hourly_rate DECIMAL (10,2),
specialization ENUM('Droit pénal', 'Civil', 'Famille', 'Affaires') NOT NULL,
consultation_online bool,
city_id INT,
FOREIGN KEY (city_id) REFERENCES city(id)
);
CREATE TABLE hussier(
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(250) NOT NULL UNIQUE,
    phone VARCHAR(30) NOT NULL UNIQUE,
    years_of_experiences int,
    hourly_rate  DECIMAL(10, 2) ,
    type ENUM('Signification', 'Exécution', 'Constats'),
    city_id INT,
    FOREIGN KEY (city_id) REFERENCES city(id)
    );

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(250) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','client','lawyer','hussier') NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE `lawyer` 
ADD COLUMN `user_id` INT AFTER `id`;

ALTER TABLE `hussier` 
ADD COLUMN `user_id` INT AFTER `id`;

ALTER TABLE `lawyer` 
MODIFY COLUMN `hourly_rate` DECIMAL(10,2) NOT NULL;

ALTER TABLE `hussier` 
MODIFY COLUMN `hourly_rate` DECIMAL(10,2) NOT NULL;

ALTER TABLE `lawyer` 
MODIFY COLUMN `specialization` ENUM('Droit pénal','Civil','Famille','Affaires') NOT NULL;

ALTER TABLE `hussier` 
MODIFY COLUMN `type` ENUM('Signification','Exécution','Constats') NOT NULL;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `client` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `name` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(30),
  `city_id` INT,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`city_id`) REFERENCES `city`(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `demand` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `client_id` INT NOT NULL,
  `lawyer_id` INT,
  `hussier_id` INT,
  `description` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` ENUM('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  FOREIGN KEY (`client_id`) REFERENCES `client`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`lawyer_id`) REFERENCES `lawyer`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`hussier_id`) REFERENCES `hussier`(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `lawyer_id` INT,
  `hussier_id` INT,
  `client_id` INT NOT NULL,
  `day` DATE NOT NULL,
  `horaire` TIME NOT NULL,
  `status` ENUM('pending','accepted','declined') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`lawyer_id`) REFERENCES `lawyer`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`hussier_id`) REFERENCES `hussier`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`client_id`) REFERENCES `client`(`id`) ON DELETE CASCADE
);

ALTER TABLE `lawyer` 
ADD CONSTRAINT `fk_lawyer_user` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE;

ALTER TABLE `hussier` 
ADD CONSTRAINT `fk_hussier_user` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE;

ALTER TABLE `city` 
MODIFY COLUMN `id` INT NOT NULL AUTO_INCREMENT;    


ALTER TABLE lawyer
ADD COLUMN Viewers int;