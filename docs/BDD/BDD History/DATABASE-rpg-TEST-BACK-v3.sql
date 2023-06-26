-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dialogue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A25A6E12CBD` (`dialogue_id`),
  CONSTRAINT `FK_DADD4A25A6E12CBD` FOREIGN KEY (`dialogue_id`) REFERENCES `dialogue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `answer` (`id`, `content`, `dialogue_id`) VALUES
(6,	'Monstre 1 Réponse 1',	5),
(7,	'Monstre 1 Réponse 2',	5),
(8,	'Monstre 1 Réponse 3',	5),
(9,	'Monstre 2 Réponse 1',	6),
(10,	'Monstre 2 Réponse 2',	6),
(11,	'Monstre 2 Réponse 3',	6),
(12,	'Monstre 3 Réponse 1',	7),
(13,	'Monstre 3 Réponse 2',	7),
(14,	'Monstre 3 Réponse 3',	7),
(15,	'Personnage 1 Repos 1 Réponse 1',	8),
(16,	'Personnage 1 Repos 1 Réponse 2',	8),
(17,	'Personnage 1 Repos 1 Réponse 3',	8),
(18,	'Personnage 2 Repos 2 Réponse 1',	9),
(19,	'Personnage 2 Repos 2 Réponse 2',	9),
(20,	'Personnage 2 Repos 2 Réponse 3',	9),
(21,	'Personnage 3 Repos 3 Réponse 1',	10),
(22,	'Personnage 3 Repos 3 Réponse 2',	10),
(23,	'Personnage 3 Repos 3 Réponse 3',	10),
(24,	'Personnage 1 Rencontre 1 Réponse 1',	11),
(25,	'Personnage 1 Rencontre 1 Réponse 2',	11),
(26,	'Personnage 1 Rencontre 1 Réponse 3',	11),
(27,	'Personnage 2 Rencontre 2 Réponse 1',	12),
(28,	'Personnage 2 Rencontre 2 Réponse 2',	12),
(29,	'Personnage 2 Rencontre 2 Réponse 3',	12),
(30,	'Personnage 3 Rencontre 3 Réponse 1',	13),
(31,	'Personnage 3 Rencontre 3 Réponse 2',	13),
(32,	'Personnage 3 Rencontre 3 Réponse 3',	13),
(33,	'Boss 1 Réponse 1',	14),
(34,	'Boss 3 Réponse 1',	16),
(35,	'Boss 3 Réponse 2',	16),
(36,	'Boss 1 Réponse 2',	14),
(37,	'Boss 2 Réponse 1',	15),
(38,	'Boss 2 Réponse 2',	5);

DROP TABLE IF EXISTS `answer_effect`;
CREATE TABLE `answer_effect` (
  `answer_id` int(11) NOT NULL,
  `effect_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`,`effect_id`),
  KEY `IDX_4499AB55AA334807` (`answer_id`),
  KEY `IDX_4499AB55F5E9B83B` (`effect_id`),
  CONSTRAINT `FK_4499AB55AA334807` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4499AB55F5E9B83B` FOREIGN KEY (`effect_id`) REFERENCES `effect` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `answer_effect` (`answer_id`, `effect_id`) VALUES
(6,	3),
(7,	4),
(8,	5),
(9,	3),
(10,	4),
(11,	5),
(12,	3),
(13,	4),
(14,	5),
(15,	3),
(16,	4),
(17,	5),
(18,	3),
(19,	4),
(20,	5),
(21,	3),
(22,	4),
(23,	5),
(24,	3),
(25,	4),
(26,	5),
(27,	3),
(28,	4),
(29,	5),
(30,	3),
(31,	4),
(32,	5),
(33,	6),
(34,	6),
(35,	5),
(36,	6),
(37,	6),
(38,	6);

DROP TABLE IF EXISTS `biome`;
CREATE TABLE `biome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `biome` (`id`, `name`, `difficulty`) VALUES
(1,	'Biome 1',	1),
(2,	'Biome 2',	2);

DROP TABLE IF EXISTS `dialogue`;
CREATE TABLE `dialogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `npc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F18A1C39CA7D6B89` (`npc_id`),
  CONSTRAINT `FK_F18A1C39CA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dialogue` (`id`, `content`, `npc_id`) VALUES
(5,	'Monstre 1 Combat 1 Dialogue',	6),
(6,	'Monstre 2 Combat 2 Dialogue',	7),
(7,	'Monstre 3 Combat 3 Dialogue',	8),
(8,	'Personnage 1 Repos 1 Dialogue',	9),
(9,	'Personnage 2 Repos 2 Dialogue',	11),
(10,	'Personnage 3 Repos 3 Dialogue',	13),
(11,	'Personnage 1 Rencontre 1 Dialogue',	10),
(12,	'Personnage 2 Rencontre 2 Dialogue',	12),
(13,	'Personnage 3 Rencontre 3 Dialogue',	14),
(14,	'Boss 1 Dialogue',	16),
(15,	'Boss 2 Dialogue',	17),
(16,	'Boss 3 Dialogue',	15);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230608114918',	'2023-06-08 14:41:05',	60),
('DoctrineMigrations\\Version20230608114924',	'2023-06-08 14:41:05',	19),
('DoctrineMigrations\\Version20230608115345',	'2023-06-08 14:41:05',	17),
('DoctrineMigrations\\Version20230608115548',	'2023-06-08 14:41:05',	16),
('DoctrineMigrations\\Version20230608115914',	'2023-06-08 14:41:05',	5),
('DoctrineMigrations\\Version20230608115925',	'2023-06-08 14:41:05',	18),
('DoctrineMigrations\\Version20230608120055',	'2023-06-08 14:41:05',	15),
('DoctrineMigrations\\Version20230608120155',	'2023-06-08 14:41:05',	16),
('DoctrineMigrations\\Version20230608120205',	'2023-06-08 14:41:05',	26),
('DoctrineMigrations\\Version20230608120242',	'2023-06-08 14:41:05',	32),
('DoctrineMigrations\\Version20230608120611',	'2023-06-08 14:41:05',	18),
('DoctrineMigrations\\Version20230608120627',	'2023-06-08 14:41:05',	25),
('DoctrineMigrations\\Version20230608121709',	'2023-06-08 14:41:05',	69),
('DoctrineMigrations\\Version20230608121712',	'2023-06-08 14:41:05',	19),
('DoctrineMigrations\\Version20230608130332',	'2023-06-08 15:04:24',	51),
('DoctrineMigrations\\Version20230608130559',	'2023-06-08 15:06:04',	24),
('DoctrineMigrations\\Version20230608132036',	'2023-06-08 15:49:05',	106),
('DoctrineMigrations\\Version20230608132442',	'2023-06-08 15:49:05',	161),
('DoctrineMigrations\\Version20230608132738',	'2023-06-08 15:49:05',	145),
('DoctrineMigrations\\Version20230608132949',	'2023-06-08 15:49:05',	134),
('DoctrineMigrations\\Version20230608133053',	'2023-06-08 15:49:05',	74),
('DoctrineMigrations\\Version20230608133225',	'2023-06-08 15:49:05',	71),
('DoctrineMigrations\\Version20230608133331',	'2023-06-08 15:49:06',	55),
('DoctrineMigrations\\Version20230608133955',	'2023-06-08 15:49:06',	98),
('DoctrineMigrations\\Version20230608134212',	'2023-06-08 15:49:06',	199),
('DoctrineMigrations\\Version20230608134310',	'2023-06-08 15:49:06',	133),
('DoctrineMigrations\\Version20230608134406',	'2023-06-08 15:49:06',	130),
('DoctrineMigrations\\Version20230608134447',	'2023-06-08 15:49:06',	133),
('DoctrineMigrations\\Version20230613092007',	'2023-06-13 11:33:08',	98),
('DoctrineMigrations\\Version20230613093454',	'2023-06-13 11:38:15',	22),
('DoctrineMigrations\\Version20230613093712',	'2023-06-13 11:38:15',	24),
('DoctrineMigrations\\Version20230619114003',	'2023-06-19 13:40:09',	175);

DROP TABLE IF EXISTS `effect`;
CREATE TABLE `effect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `effect` (`id`, `name`, `description`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`) VALUES
(3,	'Bonus de Vie',	'Bonus de Vie Description',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'Malus de Vie',	'Malus de Vie Description',	-1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'Rien',	'Nada Description',	0,	0,	0,	0,	0,	0,	0),
(6,	'Boss Frappe',	'Boss Frappe Description',	-3,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `ending`;
CREATE TABLE `ending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1413D44F71F7E88B` (`event_id`),
  KEY `IDX_1413D44F401B253C` (`event_type_id`),
  CONSTRAINT `FK_1413D44F401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  CONSTRAINT `FK_1413D44F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ending` (`id`, `content`, `event_id`, `event_type_id`) VALUES
(3,	'Event: Départ => Combat',	2,	1),
(4,	'Event: Départ => Rencontre',	2,	3),
(5,	'Event: Départ => Repos',	2,	2),
(6,	'Event: Combat 1 => Combat',	4,	1),
(7,	'Event: Combat 1 => Repos',	4,	2),
(8,	'Event: Combat 1 => Rencontre',	4,	3),
(9,	'Event: Combat 2 => Combat',	5,	1),
(10,	'Event: Combat 2 => Repos',	5,	2),
(11,	'Event: Combat 2 => Rencontre',	5,	3),
(12,	'Event: Combat 3 => Combat',	6,	1),
(13,	'Event: Combat 3 => Repos',	6,	2),
(14,	'Event: Combat 3 => Rencontre',	6,	3),
(15,	'Event: Repos 1 => Combat',	7,	1),
(16,	'Event: Repos 1 => Repos',	7,	2),
(17,	'Event: Repos 1 => Rencontre',	7,	3),
(18,	'Event: Repos 2 => Combat',	8,	1),
(19,	'Event: Repos 2 => Repos',	8,	2),
(20,	'Event: Repos 2 => Rencontre',	8,	3),
(21,	'Event: Repos 3 => Combat',	9,	1),
(22,	'Event: Repos 3 => Repos',	9,	2),
(23,	'Event: Repos 3 => Rencontre',	9,	3),
(24,	'Event: Rencontre 1 => Combat',	10,	1),
(26,	'Event: Rencontre 1 => Repos',	10,	2),
(27,	'Event: Rencontre 1 => Rencontre',	10,	3),
(28,	'Event: Rencontre 2 => Combat',	11,	1),
(29,	'Event: Rencontre 2 => Repos',	11,	2),
(30,	'Event: Rencontre 2 => Rencontre',	11,	3),
(31,	'Event: Rencontre 3 => Combat',	12,	1),
(32,	'Event: Rencontre 3 => Repos',	12,	2),
(33,	'Event: Rencontre 3 => Rencontre',	12,	3),
(34,	'Event: Boss 1 => Fin de Biome',	13,	6),
(35,	'Event: Boss 2 => Fin de Biome',	14,	6),
(36,	'Event: Boss 3 => Fin de Biome',	15,	6),
(37,	'Event: Fin de Biome  => Endgame',	3,	7),
(38,	'Event: Combat 1 => Boss',	4,	5),
(39,	'Event: Combat 2 => Boss',	5,	5),
(40,	'Event: Combat 3 => Boss',	6,	5),
(41,	'Event: Repos 1 => Boss',	7,	5),
(42,	'Event: Repos 2 => Boss',	8,	5),
(43,	'Event: Repos 3 => Boss',	9,	5),
(44,	'Event: Rencontre 1 => Boss',	10,	5),
(45,	'Event: Rencontre 2 => Boss',	11,	5),
(46,	'Event: Rencontre 3 => Boss',	12,	5);

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type_id` int(11) NOT NULL,
  `biome_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA7401B253C` (`event_type_id`),
  KEY `IDX_3BAE0AA7E43A64F9` (`biome_id`),
  CONSTRAINT `FK_3BAE0AA7401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  CONSTRAINT `FK_3BAE0AA7E43A64F9` FOREIGN KEY (`biome_id`) REFERENCES `biome` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event` (`id`, `title`, `description`, `opening`, `picture`, `event_type_id`, `biome_id`) VALUES
(2,	'Départ Biome 1',	'Départ Biome 1 Description',	'Départ Biome 1 Opening',	'https://picsum.photos/100/100',	4,	1),
(3,	'Fin de Biome 1',	'Fin de Biome 1 Description',	'Fin de Biome 1 Opening',	'https://picsum.photos/100/100',	6,	1),
(4,	'Combat 1 Biome 1',	'Combat 1 Biome 1 Description',	'Combat 1 Biome 1 Opening',	'https://picsum.photos/100/100',	1,	1),
(5,	'Combat 2 Biome 1',	'Combat 2 Biome 1',	'Combat 2 Biome 1',	'https://picsum.photos/100/100',	1,	1),
(6,	'Combat 3 Biome 1',	'Combat 3 Biome 1 Description',	'Combat 3 Biome 1 Opening',	'https://picsum.photos/100/100',	1,	1),
(7,	'Repos 1 Biome 1',	'Repos 1 Biome 1 Description',	'Repos 1 Biome 1 Opening',	'https://picsum.photos/100/100',	2,	1),
(8,	'Repos 2 Biome 1',	'Repos 2 Biome 1 Description',	'Repos 2 Biome 1 Opening',	'https://picsum.photos/100/100',	2,	1),
(9,	'Repos 3 Biome 1',	'Repos 3 Biome 1 Description',	'Repos 3 Biome 1 Opening',	'https://picsum.photos/100/100',	2,	1),
(10,	'Rencontre 1 Biome 1',	'Rencontre 1 Biome 1 Description',	'Rencontre 1 Biome 1 Opening',	'https://picsum.photos/100/100',	3,	1),
(11,	'Rencontre 2 Biome 1',	'Rencontre 2 Biome 1 Description',	'Rencontre 2 Biome 1 Opening',	'https://picsum.photos/100/100',	3,	1),
(12,	'Rencontre 3 Biome 1',	'Rencontre 3 Biome 1 Description',	'Rencontre 3 Biome 1 Opening',	'https://picsum.photos/100/100',	3,	1),
(13,	'Boss 1 Biome 1',	'Boss 1 Biome 1 Description',	'Boss 1 Biome 1 Opening',	'https://picsum.photos/100/100',	5,	1),
(14,	'Boss 2 Biome 1',	'Boss 2 Biome 1 Description',	'Boss 2 Biome 1 Opening',	'https://picsum.photos/100/100',	5,	1),
(15,	'Boss 3 Biome 1',	'Boss 3 Biome 1 Description',	'Boss 3 Biome 1 Opening',	'https://picsum.photos/100/100',	5,	1),
(16,	'Départ Biome 2',	'Départ Biome 2 Description',	'Départ Biome 2 Opening',	'https://picsum.photos/100/100',	4,	2),
(17,	'EndGame',	'EndGame Description',	'EndGame Opening',	'https://picsum.photos/100/100',	7,	NULL);

DROP TABLE IF EXISTS `event_npc`;
CREATE TABLE `event_npc` (
  `event_id` int(11) NOT NULL,
  `npc_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`npc_id`),
  KEY `IDX_5743B3FF71F7E88B` (`event_id`),
  KEY `IDX_5743B3FFCA7D6B89` (`npc_id`),
  CONSTRAINT `FK_5743B3FF71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5743B3FFCA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event_npc` (`event_id`, `npc_id`) VALUES
(4,	6),
(5,	7),
(6,	8),
(7,	9),
(8,	11),
(9,	13),
(10,	10),
(11,	12),
(12,	14);

DROP TABLE IF EXISTS `event_type`;
CREATE TABLE `event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event_type` (`id`, `name`) VALUES
(1,	'Combat'),
(2,	'Repos'),
(3,	'Rencontre'),
(4,	'Départ'),
(5,	'Boss'),
(6,	'Fin de Biome'),
(7,	'Endgame'),
(8,	'Death');

DROP TABLE IF EXISTS `hero`;
CREATE TABLE `hero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_health` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `hero_class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_51CE6E864F1EBAB8` (`hero_class_id`),
  KEY `IDX_51CE6E86A76ED395` (`user_id`),
  CONSTRAINT `FK_51CE6E864F1EBAB8` FOREIGN KEY (`hero_class_id`) REFERENCES `hero_class` (`id`),
  CONSTRAINT `FK_51CE6E86A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hero` (`id`, `name`, `max_health`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`, `picture`, `progress`, `hero_class_id`, `user_id`) VALUES
(4,	'Héro',	100,	100,	10,	10,	10,	10,	10,	NULL,	'https://picsum.photos/100/100',	1,	4,	1);

DROP TABLE IF EXISTS `hero_class`;
CREATE TABLE `hero_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_health` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hero_class` (`id`, `name`, `max_health`, `health`, `strength`, `intelligence`, `dexterity`, `defense`) VALUES
(4,	'ALPHA',	100,	100,	10,	10,	10,	10);

DROP TABLE IF EXISTS `hero_event`;
CREATE TABLE `hero_event` (
  `hero_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`hero_id`,`event_id`),
  KEY `IDX_A491056045B0BCD` (`hero_id`),
  KEY `IDX_A491056071F7E88B` (`event_id`),
  CONSTRAINT `FK_A491056045B0BCD` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A491056071F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `hero_item`;
CREATE TABLE `hero_item` (
  `hero_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`hero_id`,`item_id`),
  KEY `IDX_9FF0475845B0BCD` (`hero_id`),
  KEY `IDX_9FF04758126F525E` (`item_id`),
  CONSTRAINT `FK_9FF04758126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9FF0475845B0BCD` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hero_item` (`hero_id`, `item_id`) VALUES
(4,	1),
(4,	3),
(4,	4);

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `item` (`id`, `name`, `picture`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`) VALUES
(1,	'Epée',	'https://picsum.photos/100/100',	10,	10,	10,	10,	10,	10,	10),
(3,	'Arc',	'https://picsum.photos/100/100',	10,	10,	10,	10,	10,	10,	10),
(4,	'Potion',	'https://picsum.photos/100/100',	100,	0,	0,	0,	0,	0,	10);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `npc`;
CREATE TABLE `npc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_boss` tinyint(1) NOT NULL,
  `hostility` tinyint(1) NOT NULL,
  `xp_earned` int(11) DEFAULT NULL,
  `race_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_468C762C6E59D40D` (`race_id`),
  CONSTRAINT `FK_468C762C6E59D40D` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `npc` (`id`, `name`, `description`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `picture`, `is_boss`, `hostility`, `xp_earned`, `race_id`) VALUES
(6,	'Monstre 1 Combat 1',	'Monstre 1 Combat 1 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	1,	10,	3),
(7,	'Monstre 2 Combat 2',	'Monstre 2 Combat 2 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	1,	10,	3),
(8,	'Monstre 3 Combat 3',	'Monstre 3 Combat 3 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	1,	10,	3),
(9,	'Personnage 1 Repos 1',	'Personnage 1 Repos 1 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	0,	NULL,	2),
(10,	'Personnage 1 Rencontre 1',	'Monstre 1 Rencontre 1 description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	0,	100,	2),
(11,	'Personnage 2 Repos 2',	'Personnage 2 Repos 2 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	0,	NULL,	2),
(12,	'Personnage 2 Rencontre 2',	'Personnage 2 Rencontre 2 description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	1,	100,	3),
(13,	'Personnage 3 Repos 3',	'Personnage 3 Repos 3 Description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	0,	NULL,	2),
(14,	'Personnage 3 Rencontre 3',	'Personnage 3 Rencontre 3 description',	100,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	0,	0,	100,	2),
(15,	'Monstre 3 Boss 3',	'Monstre 3 Boss 3 Description',	200,	20,	20,	20,	20,	20,	'https://picsum.photos/50/50',	1,	1,	200,	3),
(16,	'Monstre 1 Boss 1',	'Monstre 1 Boss 1 Description',	200,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	1,	1,	10,	3),
(17,	'Monstre 2 Boss 2',	'Monstre 2 Boss 2 Description',	200,	10,	10,	10,	10,	10,	'https://picsum.photos/50/50',	1,	1,	10,	3);

DROP TABLE IF EXISTS `npc_item`;
CREATE TABLE `npc_item` (
  `npc_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`npc_id`,`item_id`),
  KEY `IDX_46576227CA7D6B89` (`npc_id`),
  KEY `IDX_46576227126F525E` (`item_id`),
  CONSTRAINT `FK_46576227126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_46576227CA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `npc_item` (`npc_id`, `item_id`) VALUES
(6,	1),
(7,	3),
(8,	4),
(15,	1),
(15,	3),
(16,	1),
(16,	3),
(16,	4),
(17,	1),
(17,	3),
(17,	4);

DROP TABLE IF EXISTS `race`;
CREATE TABLE `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `race` (`id`, `name`, `description`) VALUES
(2,	'Humain',	'Gentil'),
(3,	'Démon',	'Méchant');

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_794381C6A76ED395` (`user_id`),
  CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `review` (`id`, `title`, `content`, `rating`, `created_at`, `updated_at`, `user_id`) VALUES
(1,	'Avis 1',	'Avis 1 Contenu',	4,	'2023-06-11 00:00:00',	'2023-06-15 14:00:59',	2),
(2,	'Avis 2',	'Avis 2 Contenu',	2,	'2023-06-11 00:00:00',	'2023-06-15 14:01:22',	6),
(3,	'Avis 3',	'Avis 3 Contenu',	5,	'2023-06-11 00:00:00',	'2023-06-15 14:01:45',	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar`) VALUES
(1,	'pierre@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Pierre',	NULL),
(2,	'anthony@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Anthony',	NULL),
(3,	'marine@gameMaster.com',	'[\"ROLE_GAMEMASTER\",\"ROLE_PLAYER\",\"ROLE_ADMIN\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Marine',	NULL),
(4,	'sandra@gameMaster.com',	'[\"ROLE_GAMEMASTER\",\"ROLE_PLAYER\",\"ROLE_ADMIN\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Sandra',	NULL),
(5,	'gauthier@gameMaster.com',	'[\"ROLE_GAMEMASTER\",\"ROLE_PLAYER\",\"ROLE_ADMIN\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Gauthier',	NULL),
(6,	'player@player.com',	'[\"ROLE_PLAYER\"]',	'$2y$13$4dAjM04jIL1RxKLjZAkH/OJ0e6wPE4wSwrSP1ZnlvFN7TnBkZ5ZpK',	'Player',	NULL);

-- 2023-06-19 11:45:50
