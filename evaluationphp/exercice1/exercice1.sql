-- -- Structure de la table `users`
-- --
--
--  CREATE DATABASE IF NOT EXISTS usersarticles;
--
--  USE usersarticles;
--
--  CREATE TABLE users(
--    id int(10) NOT NULL AUTO_INCREMENT,
--    firstname varchar(20) NOT NULL,
--    lastname varchar(20) NOT NULL,
--    email varchar(255) NOT NULL,
--    role enum('auteur','admin') NOT NULL DEFAULT 'users',
--  )ENGINE=InnoDB;
--
--
--
--  -- Structure de la table `articles`
--  --
--  CREATE TABLE articles(
--    id int(10) NOT NULL AUTO_INCREMENT,
--    title VARCHAR(25) NOT NULL,
--    content varchar(255) NOT NULL,
--    picture varchar(255) NOT NULL DEFAULT '0',
--    date_publish datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
--    id_user int(25) NOT NULL DEFAULT '0',
--   )ENGINE=InnoDB;




------------------------------------------------------------------

-- Requete SQL permettant d'afficher un articles


SELECT id FROM users WHERE id IN(10);
