-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `dialogue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A25A6E12CBD` (`dialogue_id`),
  CONSTRAINT `FK_DADD4A25A6E12CBD` FOREIGN KEY (`dialogue_id`) REFERENCES `dialogue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `biome`;
CREATE TABLE `biome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `difficulty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `biome` (`id`, `name`, `difficulty`) VALUES
(1,	'foret',	2);

DROP TABLE IF EXISTS `dialogue`;
CREATE TABLE `dialogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `npc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F18A1C39CA7D6B89` (`npc_id`),
  CONSTRAINT `FK_F18A1C39CA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230608114918',	'2023-06-15 17:28:04',	162),
('DoctrineMigrations\\Version20230608114924',	'2023-06-15 17:28:04',	33),
('DoctrineMigrations\\Version20230608115345',	'2023-06-15 17:28:04',	33),
('DoctrineMigrations\\Version20230608115548',	'2023-06-15 17:28:04',	25),
('DoctrineMigrations\\Version20230608115914',	'2023-06-15 17:28:04',	16),
('DoctrineMigrations\\Version20230608115925',	'2023-06-15 17:28:04',	27),
('DoctrineMigrations\\Version20230608120055',	'2023-06-15 17:28:04',	98),
('DoctrineMigrations\\Version20230608120155',	'2023-06-15 17:28:04',	22),
('DoctrineMigrations\\Version20230608120205',	'2023-06-15 17:28:04',	25),
('DoctrineMigrations\\Version20230608120242',	'2023-06-15 17:28:04',	21),
('DoctrineMigrations\\Version20230608120611',	'2023-06-15 17:28:04',	26),
('DoctrineMigrations\\Version20230608120627',	'2023-06-15 17:28:04',	18),
('DoctrineMigrations\\Version20230608121709',	'2023-06-15 17:28:04',	15),
('DoctrineMigrations\\Version20230608121712',	'2023-06-15 17:28:04',	19),
('DoctrineMigrations\\Version20230608130332',	'2023-06-15 17:28:04',	19),
('DoctrineMigrations\\Version20230608130559',	'2023-06-15 17:28:04',	9),
('DoctrineMigrations\\Version20230608132036',	'2023-06-15 17:28:04',	87),
('DoctrineMigrations\\Version20230608132442',	'2023-06-15 17:28:04',	177),
('DoctrineMigrations\\Version20230608132738',	'2023-06-15 17:28:05',	147),
('DoctrineMigrations\\Version20230608132949',	'2023-06-15 17:28:05',	188),
('DoctrineMigrations\\Version20230608133053',	'2023-06-15 17:28:05',	121),
('DoctrineMigrations\\Version20230608133225',	'2023-06-15 17:28:05',	90),
('DoctrineMigrations\\Version20230608133331',	'2023-06-15 17:28:05',	78),
('DoctrineMigrations\\Version20230608133955',	'2023-06-15 17:28:05',	187),
('DoctrineMigrations\\Version20230608134212',	'2023-06-15 17:28:05',	148),
('DoctrineMigrations\\Version20230608134310',	'2023-06-15 17:28:06',	147),
('DoctrineMigrations\\Version20230608134406',	'2023-06-15 17:28:06',	183),
('DoctrineMigrations\\Version20230608134447',	'2023-06-15 17:28:06',	146),
('DoctrineMigrations\\Version20230613092007',	'2023-06-15 17:28:06',	10);

DROP TABLE IF EXISTS `effect`;
CREATE TABLE `effect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ending`;
CREATE TABLE `ending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1413D44F71F7E88B` (`event_id`),
  KEY `IDX_1413D44F401B253C` (`event_type_id`),
  CONSTRAINT `FK_1413D44F401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  CONSTRAINT `FK_1413D44F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ending` (`id`, `content`, `event_id`, `event_type_id`) VALUES
(1,	'Vous quittez l\'abri de l\'arbre centenaire, sentant que des présences curieuses vous observent.',	1,	3),
(2,	'Vous vous éloignez de cet endroit. L\'écho d\'un grondement lointain résonne dans l\'air.',	1,	1),
(3,	'Vous prenez congé du grand arbre. Le vent murmure des légendes d\'anciens combats épiques.',	1,	5),
(4,	'Vous vous éloignez de la cascade étincelante, percevant un frôlement fugace sur votre épaule.',	2,	3),
(5,	'Vous vous écartez de la cascade argentée et des éclats de l\'eau qui dansent avec fureur.',	2,	1),
(6,	'Alors que vous quittez la cascade impétueuse, une brume épaisse s\'élève des eaux tumultueuses.',	2,	5),
(7,	'Vous poursuivez. Ce sentier mélodieux vous guide-t-il vers quelqu\'un ?',	3,	3),
(8,	'Quand vous vous éloignez du sentier, une tension électrique éveille votre instinct de guerrier.',	3,	1),
(9,	'Vous quittez le sentier enchanteur. Votre cœur bat au rythme des mystères et des dangers de la forêt.',	3,	5),
(10,	'Vous vous éloignez des champignons lumineux, avide de contrées très paisibles.',	4,	2),
(11,	'Vous délaissez les champignons étranges pour vous enfoncer dans les profondeurs de la foret.',	4,	1),
(12,	'Vous vous détournez de cet oasis féerique, animé par une détermination inébranlable.',	4,	5),
(13,	'Vous cherchez un endroit plus serein, lassé des vieilles pierres.',	5,	2),
(14,	'Vous abandonnez les ruines décrépites, animé par une soif d\'action.',	5,	1),
(15,	'Une lueur d\'intrépidité brille dans vos yeux alors que vous vous éloignez.',	5,	5),
(16,	'Vous quittez la clairière enchantée et profitez de la tranquillité de la nature environnante.',	6,	2),
(17,	'Vous abandonnez les symboles runiques et vous sentez fatigué. Il en faudrait peu pour que vous perdiez votre sang froid...',	6,	1),
(18,	'Vous quittez la clairière sacrée, prêt à défier des puissances redoutables.',	6,	5),
(19,	'Vous partez loin des visions tourbillonnantes qui habitent ces lieux mystiques.',	7,	2),
(20,	'Vous quittez le cercle sacré, pressé de raconter cela à quiconque croiserait votre route.',	7,	3),
(21,	'Vous ne ressentez plus aucune crainte ni hésitation en quittant ce lieu de bataille.',	7,	5),
(22,	'Épuisé, vous vous éloignez au plus vite de ces murmures mystérieux.',	8,	2),
(23,	'Alors que vous vous écartez de la gorge, vous sentez que vous auriez besoin d\'un peu de compagnie.',	8,	3),
(24,	'Vous laissez la ravine derrière vous, prêt à repousser les limites de votre courage.',	8,	5),
(25,	'Vous fuyez au calme, loin de ces arachnides fascinantes et imprévisibles.',	9,	2),
(26,	'Alors que vous quittez l\'espace enchanté, vous rêvez d\'un rebondissement inattendu.',	9,	3),
(27,	'Vous vous écartez du réseau complexe des araignées géantes. Après ça, il va falloir faire fort pour vous effrayer.',	9,	5),
(28,	'Vous partez loin des lueurs mystérieuses qui hantent ces lieux terrifiants.',	10,	2),
(29,	'Vous quittez l\'étang, rêvant d\'une rencontre réconfortante pour guérir vos blessures physiques et émotionnelles.',	10,	3),
(30,	'Votre regard se durcit, vous ne craignez plus aucune créature mystérieuse.',	10,	1),
(31,	'Vous ressentez le besoin viscéral de laisser derrière vous ces ténèbres oppressantes.',	11,	2),
(32,	'Vous détournez le regard de l\'entrée béante, priant pour croiser enfin une figure amie qui dissiperait les ombres de votre esprit.',	11,	3),
(33,	'Vos muscles se contractent alors que vous quittez l\'obscurité. Vous vous souviendrez qu\'il faut toujours se tenir prêt.',	11,	1),
(34,	'Vous soufflez lentement en laissant derrière vous l\'oppression de ces racines sinistres.',	12,	2),
(35,	'Une lueur d\'espoir brille dans vos yeux alors que vous progressez en dehors des pièges végétaux.',	12,	3),
(36,	'Invincible face aux tortueuses racines qui voudraient vous ralentir, vous conservez votre entrain.',	12,	1);

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `opening` longtext DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `event_type_id` int(11) NOT NULL,
  `biome_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA7401B253C` (`event_type_id`),
  KEY `IDX_3BAE0AA7E43A64F9` (`biome_id`),
  CONSTRAINT `FK_3BAE0AA7401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  CONSTRAINT `FK_3BAE0AA7E43A64F9` FOREIGN KEY (`biome_id`) REFERENCES `biome` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event` (`id`, `title`, `description`, `opening`, `picture`, `event_type_id`, `biome_id`) VALUES
(1,	'L\'Arche de Verdure',	'Vous découvrez un immense arbre centenaire aux branches étendues en arc, formant un abri naturel en son centre. Les rayons du soleil filtrent à travers les feuilles, créant un kaléidoscope de couleurs et un refuge paisible pour les voyageurs égarés.',	'Vous apercevez un rayon de soleil filtrant à travers les feuilles, attirant votre attention vers un immense arbre centenaire.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117496613590540369/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_fc6c8418-6cfd-4ead-8cde-1e5fa0a8af74.png',	4,	1),
(2,	'Les Chutes Argentées',	'Vous arrivez devant une cascade impétueuse qui dévale des falaises rocheuses, projetant des éclats d\'eau qui brillent comme de l\'argent au soleil. L\'endroit est réputé pour ses propriétés curatives et sa beauté éblouissante.',	'Votre oeil est attiré au loin par l\'éclat argenté d\'une cascade impétueuse, dévalant des falaises rocheuses.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117497319902937128/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_17594541-24d6-4700-966a-63fb701f4155.png',	2,	1),
(3,	'Le Chemin du Murmure',	'Vous empruntez un sentier caressé par une douce brise, où les feuilles des arbres murmurent des secrets à ceux qui les écoutent attentivement. Chaque pas révèle une nouvelle mélodie, créant une symphonie naturelle qui berce les âmes en quête de tranquillité.',	'Vous réalisé que le bruissement des feuilles a changé. Comme si elles cherchaient à vous parler...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117489786043764796/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_40e80c62-acb7-4637-9f90-38a0e75c019d.png',	2,	1),
(4,	'Le Cercle des Champignons',	'Vous pénétrez dans une clairière entourée d\'immenses champignons colorés aux formes étranges. Chaque champignon émet une lueur douce, créant une ambiance féerique. C\'est un lieu de rassemblement pour les créatures magiques et les amateurs de potions.',	'Un peu plus loin, d\'immenses champignons colorés aux formes étranges attirent votre curiosité.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117494079635337256/rahkart_generate_an_image_with_a_concise_brush_technique_that_d_03a01f8f-eeea-4634-8538-7556f43c2ff7.png',	3,	1),
(5,	'Les Ruines Perdues',	'Vous découvrez les ruines d\'une ancienne cité dissimulées au sein de la forêt, envahies par la végétation. Des colonnes brisées et des sculptures effacées témoignent d\'une grandeur passée.',	'Vous avancez et buttez sur une pierre qui ne ressemble pas aux autres cailloux de la forêt.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117490877250666546/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_f39b9d4a-f51b-44fc-83d3-b036f114786b.png',	3,	1),
(6,	'La Clairière des Runes',	'Vous vous tenez au centre d\'une clairière sacrée où d\'anciens symboles runiques sont gravés dans le sol. Chaque rune renferme un pouvoir unique et une signification mystique, attirant les praticiens de la magie qui cherchent à interpréter leur sagesse.',	'Votre attention est attirée par d\'étranges symboles gravés dans le sol. Ils semblent indiquer une route à suivre.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117492488425455647/rahkart_generate_an_image_with_a_concise_brush_technique_that_d_351f5532-7b73-49de-b609-79ab97200f9c.png',	3,	1),
(7,	'Le Sanctuaire des Anciens',	'Vous arrivez devant un cercle sacré de pierres dressées, entouré d\'arbres millénaires. C\'est un lieu de communion avec les esprits de la forêt, mais il vous semble chargé d\'une tension mystique.',	'Les pierres qui vous entourent ne sont pas placées au hasard. Vous avancez, curieux d\'en savoir plus.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117495294280618155/rahkart_enerate_an_image_with_a_concise_brush_technique_that_de_ab4643a7-2b4c-42cc-8b4f-4ddbcd64113a.png',	1,	1),
(8,	'La Ravine des Soupirs',	'Vous vous retrouvez face à une gorge étroite et sombre, où les arbres touffus se penchent pour former une canopée dense. L\'air est chargé d\'une aura de danger, et le murmure du vent à travers les branches donne l\'impression que la forêt elle-même soupire, anxieuse.',	'Vous entendez un murmure mystérieux dans le vent et vous décidez de l\'écouter attentivement',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117498289823154267/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_6866b654-6b21-4ee0-b63f-f258b1c9e805.png',	1,	1),
(9,	'Le Bosquet des Araignées Tisseuses',	'Vous pénétrez dans un espace enchanté où les araignées géantes tissent des toiles complexes entre les arbres. Les fils d\'argent étincelants forment un véritable labyrinthe !',	'En tendant la main à gauche, vous sentez une matière collante mais vous ne voyez rien... Vous bifurquez pour comprendre de quoi il s\'agit.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117499732927987733/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_b4aadb88-e35d-4d5c-8302-0c680e91b03c.png',	1,	1),
(10,	'L\'étang aux Lueurs Spectrales',	'Vous vous aventurez vers un étang envoûtant où des lucioles spectrales éclairent les sentiers serpentant entre les tourbières. Derrière son apparence magnifique, vous sentez qu\'il renferme de terribles secrets.',	'Une luciole spectrale vous file devant le nez ! Vous courez à sa poursuite.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117500580097691848/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_92d069f0-16e4-4448-a997-75cd665bc4de.png',	5,	1),
(11,	'La Sombre Grotte',	'Vous arrivez devant une imposante grotte dissimulée dans la dense forêt. Les ténèbres l\'enveloppent, et une aura sinistre émane de son entrée béante. L\'intérieur est un labyrinthe de tunnels tortueux et de chambres obscures où des stalactites menaçantes pendent du plafond.',	'Un frisson vous parcourt l\'échine. Toute votre attention est absorbée par une grotte que vous voyez se dessiner au loin. Vous êtes comme possédé et ne pouvez vous empêcher d\'approcher...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117501321109573712/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_fc584627-203c-4417-9c80-5ce57dc03cb3.png',	5,	1),
(12,	'Les racines éternelles',	'Le sol est absolument couvert de racines. Tortueuses et sinistres, elles s\'entrelacent et rendent votre progression extrêmement difficile. À chaque pas, la sensation d\'oppression ne fait qu\'empirer...',	'Vous reprenez votre chemin et n\'arrêtez pas de trébucher ! La forêt n\'a pas fini de vous surprendre...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117502359032049785/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_8f0465e2-999e-4467-a166-fb5039726c1d.png',	5,	1);

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


DROP TABLE IF EXISTS `event_type`;
CREATE TABLE `event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
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
  `name` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
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
(1,	'Cookie',	100,	100,	80,	70,	60,	75,	50,	0,	'https://static.vecteezy.com/system/resources/previews/018/931/604/original/cartoon-cookie-icon-png.png',	0,	1,	4),
(2,	'Pony',	100,	80,	90,	20,	20,	70,	80,	0,	'https://www.pngmart.com/files/3/My-Little-Pony-Rarity-PNG-Clipart.png',	0,	1,	3);

DROP TABLE IF EXISTS `hero_class`;
CREATE TABLE `hero_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hero_class` (`id`, `name`, `max_health`, `health`, `strength`, `intelligence`, `dexterity`, `defense`) VALUES
(1,	'développeur',	100,	100,	100,	100,	100,	100);

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


DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
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
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `karma` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `is_boss` tinyint(1) NOT NULL,
  `hostility` tinyint(1) NOT NULL,
  `xp_earned` int(11) DEFAULT NULL,
  `race_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_468C762C6E59D40D` (`race_id`),
  CONSTRAINT `FK_468C762C6E59D40D` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `npc` (`id`, `name`, `description`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `picture`, `is_boss`, `hostility`, `xp_earned`, `race_id`) VALUES
(1,	'Brom la Chasseuse  de Monstres',	'Cette chasseuse intrépide protège les voyageurs des créatures les plus dangereuses, elle pourrait vous prêter main forte.',	100,	100,	100,	100,	100,	100,	'http://imagizer.imageshack.com/v2/642x642q70/924/8kXdnt.png',	0,	0,	0,	1),
(2,	'Eloi le Protecteur des Animaux',	'Ce druide dévoué donnerait sa vie pour protéger les créatures de la forêt. Il vous aidera si vous partagez sa passion pour la nature.',	100,	100,	100,	100,	100,	100,	'https://imagizer.imageshack.com/v2/789x789q90/r/922/X6YrXf.png',	0,	0,	0,	1),
(3,	'Lysandre l\'Érudite',	'Très instruite et mystérieuse, elle est connue pour sa sagesse et ses connaissances ésotériques sur les secrets de la forêt.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/1bde38ab-9964-4585-b910-6e744f8152fd/0_0.png',	0,	0,	0,	2),
(4,	'Thorgar la Rôdeuse',	'Cette chasseuse solitaire et silencieuse a une affinité profonde avec les animaux de la forêt et peut vous aider à éviter les pièges.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/7547d81a-ab55-4c18-ac75-5a3973d42ae9/0_1.png',	0,	1,	0,	1),
(5,	'Les Farfadets Chapardeurs',	'Ces farfadets espiègles adorent voler des objets sans importance à ceux qui traversent leur territoire.',	100,	100,	100,	100,	100,	100,	'https://imagizer.imageshack.com/img924/5015/Q27XNl.png',	0,	1,	0,	8),
(6,	'Les Gobelins Artificiers',	'Ces gobelins aiment jouer avec des explosifs et sont parfois aussi dangereux pour eux-mêmes que pour les autres.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/eba73e8c-3ccb-4bc7-8972-ee1fa133d86b/0_1.png',	0,	1,	NULL,	3),
(7,	'Le Dragon des Brumes',	'Ce dragon ne crache pas des flammes, mais un brouillard toxique qui ferait succomber l\'aventurier le plus robuste dans d\'atroces souffrances.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/a475dd90-cace-46f8-8829-fd9cf1b110cf/0_3.png',	1,	1,	0,	14),
(8,	'La Gardienne des Ancêtres',	'Esprit vengeur, elle déteste absolument toutes les créatures qui perturbent l\'équilibre de la forêt. Oui, piétiner une brindille, ça compte… N\'avez-vous donc aucun respect pour les brindilles ?!',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/3f252c85-642c-49b8-ba7d-cdd60d40147c/0_2.png',	1,	1,	0,	11),
(9,	'La Sorcière de l\'humus',	'Cette sorcière maléfique au visage inquiétant utilise la magie noire pour ensorceler les aventuriers et les mener à leur perte.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/cff72ca6-251f-4baa-8b9b-032eca3abbba/0_0.png',	1,	1,	0,	7);

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


DROP TABLE IF EXISTS `race`;
CREATE TABLE `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `race` (`id`, `name`, `description`) VALUES
(1,	'humain',	NULL),
(2,	'elfe',	NULL),
(3,	'gobelin',	NULL),
(4,	'fée',	NULL),
(5,	'dryade',	NULL),
(6,	'nain',	NULL),
(7,	'sorcière',	NULL),
(8,	'farfadet',	NULL),
(9,	'troll',	NULL),
(10,	'animal',	NULL),
(11,	'esprit',	NULL),
(12,	'végétal',	NULL),
(13,	'lutin',	NULL),
(14,	'dragon',	NULL),
(15,	'golem',	NULL),
(16,	'monstre',	NULL);

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` longtext NOT NULL,
  `rating` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_794381C6A76ED395` (`user_id`),
  CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar`) VALUES
(1,	'pierre@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Pierre',	NULL),
(2,	'anthony@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Anthony',	NULL),
(3,	'marine@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Marine',	NULL),
(4,	'sandra@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Sandra',	NULL),
(5,	'gauthier@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Gauthier',	NULL),
(6,	'player@player.com',	'[\"ROLE_PLAYER\"]',	'$2y$13$4dAjM04jIL1RxKLjZAkH/OJ0e6wPE4wSwrSP1ZnlvFN7TnBkZ5ZpK',	'Player',	NULL);

-- 2023-06-17 07:08:21
