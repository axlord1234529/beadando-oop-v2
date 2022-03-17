CREATE DATABASE `beadando`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `beadando`;

CREATE TABLE `felhasznalok` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `csaladi_nev` varchar(45) NOT NULL default '',
  `uto_nev` varchar(45) NOT NULL default '',
  `bejelentkezes` varchar(12) NOT NULL default '',
  `jelszo` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`)
)
ENGINE = MYISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `uzenet` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `subject` varchar(130) NOT NULL,
  `message` text NOT NULL,
  `lakhely` varchar(40) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `felhasznalok` (`id`,`csaladi_nev`,`uto_nev`,`bejelentkezes`,`jelszo`) VALUES 
 (1,'Családi_1','Utónév_1','Login1',sha1('login1'));
