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
(7,	'Avec plaisir !',	4),
(8,	'Je suis timide...',	4),
(10,	'C\'est fascinant !',	6),
(11,	'Hum...',	6),
(12,	'J\'ai adoré le tome 2 de \"Luminae Arcana - Secrets enchantés de l\'art elfique\".',	8),
(13,	'Je voyage léger, je lis très peu.',	8),
(14,	'Ils sont plus impressionnants que la Bête du Gévaudan.',	5),
(15,	'Celui-ci ressemble au loup-garou de Twilight... Comment s\'appelle-t-il déjà ?',	5),
(16,	'Ton haleine est aussi acide que la brume qui t\'enveloppe.',	10),
(17,	'Ta grandeur est aussi épaisse que la brume qui t\'enveloppe.',	10),
(18,	'Je préfère m\'abstenir.',	12),
(19,	'Je relève le défi, petits chapardeurs !',	12),
(20,	'Difficile de résister aux fantômes farcis...',	11),
(21,	'La prochaine fois, choisissez la salade spectrale !',	11),
(22,	'À propos de cette toile, quel est le secret de sa blancheur si éclatante ?',	9),
(23,	'Vous devriez passer dans Rire et Chansons.',	9),
(24,	'Dans une autre vie, vous auriez été une artiste florale de renom.',	13),
(25,	'Tes lianes et racines ne peuvent entraver mon esprit résolu.',	13),
(26,	'Je suis prêt à voir votre science farfelue en action.',	14),
(27,	'Vous me rappelez mon prof de techno en 4ème B.',	14);

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
(7,	5),
(8,	6),
(8,	14),
(10,	7),
(11,	8),
(12,	10),
(13,	14),
(14,	15),
(15,	16),
(16,	17),
(17,	18),
(18,	19),
(19,	20),
(20,	21),
(21,	22),
(22,	23),
(23,	24),
(24,	25),
(25,	26),
(26,	27),
(27,	28);

DROP TABLE IF EXISTS `biome`;
CREATE TABLE `biome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `biome` (`id`, `name`, `difficulty`) VALUES
(1,	'Forêt',	2),
(2,	'Game',	0);

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
(4,	'Aventurier, fais-moi ton cri de guerre le plus effrayant !',	1),
(5,	'Mes fidèles compagnons sont mes yeux et mes oreilles dans les ténèbres. Prenez garde à ne pas sous-estimer leur intelligence.',	4),
(6,	'Saviez-vous qu\'il existe un corbeau fan de Shakespeare qui récite Hamlet en picorant des vers de terre ?',	2),
(8,	'Cher voyageur, quel est votre ouvrage préféré, en matière de magie elfique classique ?',	3),
(9,	'Vous êtes tombé dans ma toile... littéralement ! Préparez-vous à une rencontre tissée de défis et d\'humiliation.',	10),
(10,	'Sais-tu pourquoi je suis craint à travers ces contrées ?',	7),
(11,	'Une indigestion spectrale, manquait plus que ça ! Je n\'en peux plus des repas gargantuesques des Rendez-Vous des Ancêtres...',	8),
(12,	'Voulez-vous tenter de retrouver l\'objet que nous avons subtilisé ?',	5),
(13,	'Pour ta fin de vie, que préfères-tu ? Étranglé par une liane... ou dévoré par les vers de ma terre fertile ?',	9),
(14,	'Prépare-toi à découvrir notre dernière invention !',	6);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
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
('DoctrineMigrations\\Version20230613092007',	'2023-06-15 17:28:06',	10),
('DoctrineMigrations\\Version20230619114003',	'2023-06-22 15:38:19',	37),
('DoctrineMigrations\\Version20230622133928',	'2023-06-22 15:39:35',	77);

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
(1,	'Bonus de Vie',	'Soin',	30,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'Malus de Vie',	'Dégat',	-20,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'Boss Fight',	'Dégat',	-35,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'Potion de Rien',	'T\'abuses un peu trop de la boisson',	NULL,	NULL,	NULL,	NULL,	NULL,	-10,	NULL),
(5,	'Brom bonus',	'Vous l\'impressionnez et gagnez un bonus.',	10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'Brom zéro effet',	'Elle est déçue mais se montre compréhensive.',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'Eloi bonus',	'Il est ravi que vous partagiez sa passion de la nature, vous gagnez un bonus.',	10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(8,	'Eloi zéro effet',	'Il tourne les talons, semblant préférer la compagnie de l\'écureuil.',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(10,	'Lysandre bonus',	'Incroyable, vous avez le même livre préféré ! Vous gagnez un bonus.',	10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(14,	'Lysandre zéro effet',	'Elle regrette que vous ne partagiez pas sa passion.',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(15,	'Thorgar malus faible',	'Flattée, elle retiendra ses coups. Vous recevez un malus faible.',	-5,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(16,	'Thorgar malus moyen',	'Comment OSEZ-VOUS ? Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(17,	'Dragon malus moyen',	'Le dragon a le sens de l\'humour. Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(18,	'Dragon malus fort',	'Le dragon n\'est pas sensible à la flatterie. Vous recevez un malus fort.',	-15,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(19,	'Farfadets Chapardeurs malus faible',	'Vous évitez les ennuis et recevez un malus faible.',	-5,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(20,	'Farfadets Chapardeurs malus moyen',	'Les Farfadets en profitent pour vous voler davantage. Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(21,	'Gardienne malus moyen',	'Votre compréhension la rassure. Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(22,	'Gardienne malus fort',	'Votre insolence la fait vriller. Vous recevez un malus fort.',	-15,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(23,	'Arachnus Maximus malus faible',	'Arachnus vous tient la jambe pendant une heure. Vous recevez un malus faible.',	-5,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(24,	'Arachnus Maximus malus moyen',	'Rien n\'est plus grand qu\'Arachnus... Si ce n\'est son ego ! Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(25,	'Sorcière de l\'Humus malus moyen',	'Vous touchez un point sensible et la déstabilisez. Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(26,	'Sorcière de l\'Humus malus fort',	'Elle va vous prouver le contraire. Vous recevez un malus fort.',	-20,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(27,	'Gobelins Artificiers malus faible',	'Vous savez apprécier son art et recevez un malus faible.',	-5,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(28,	'Gobelins Artificiers malus moyen',	'Les gobelins se vengent de l\'affront que vous avez fait à leur chef. Vous recevez un malus moyen.',	-10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

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
(28,	'Vous partez loin des lueurs mystérieuses qui hantent ces lieux terrifiants.',	10,	6),
(31,	'Vous ressentez le besoin viscéral de laisser derrière vous ces ténèbres oppressantes.',	11,	6),
(34,	'Vous soufflez lentement en laissant derrière vous l\'oppression de ces racines sinistres.',	12,	6),
(37,	'Dans un éclat de triomphe, vous avez surmonté tous les obstacles et remporté la victoire finale.',	13,	7);

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(3,	'Le Chemin du Murmure',	'Vous empruntez un sentier caressé par une douce brise, où les feuilles des arbres murmurent des secrets à ceux qui les écoutent attentivement. Chaque pas révèle une nouvelle mélodie, créant une symphonie naturelle qui berce les âmes en quête de tranquillité.',	'Vous réalisez que le bruissement des feuilles a changé. Comme si elles cherchaient à vous parler...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117489786043764796/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_40e80c62-acb7-4637-9f90-38a0e75c019d.png',	2,	1),
(4,	'Le Cercle des Champignons',	'Les couleurs éclatantes des champignons illuminent la scène. Un voile de brume flotte dans l\'air. Une silhouette se détache des arbres environnants et s\'avance d\'un pas assuré.',	'Un peu plus loin, d\'immenses champignons colorés aux formes étranges attirent votre curiosité.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117494079635337256/rahkart_generate_an_image_with_a_concise_brush_technique_that_d_03a01f8f-eeea-4634-8538-7556f43c2ff7.png',	3,	1),
(5,	'Les Ruines Perdues',	'Les ruines perdues se dressent majestueusement devant vous, témoins silencieux d\'un passé oublié. Les pierres antiques racontent des histoires que seuls les personnes les plus cultivées peuvent comprendre.',	'Vous avancez et buttez sur une pierre qui ne ressemble pas aux autres cailloux de la forêt.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117490877250666546/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_f39b9d4a-f51b-44fc-83d3-b036f114786b.png',	3,	1),
(6,	'La Clairière des Runes',	'La clairière scintille de runes magiques. Une silhouette masculine émerge des frondaisons. En tenue verdoyante et ornée de feuilles, il semble tout droit sorti d\'une chanson de Disney.',	'Votre attention est attirée par d\'étranges symboles gravés dans le sol. Ils semblent indiquer une route à suivre.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117492488425455647/rahkart_generate_an_image_with_a_concise_brush_technique_that_d_351f5532-7b73-49de-b609-79ab97200f9c.png',	3,	1),
(7,	'Le Sanctuaire des Anciens',	'Vous arrivez devant un cercle sacré de pierres dressées. La brume enveloppe le sanctuaire, chargé d\'énergie magique. Vous sentez quelqu\'un approcher à travers le brouillard.',	'Les pierres qui vous entourent ne sont pas placées au hasard. Vous avancez, curieux d\'en savoir plus.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117495294280618155/rahkart_enerate_an_image_with_a_concise_brush_technique_that_de_ab4643a7-2b4c-42cc-8b4f-4ddbcd64113a.png',	1,	1),
(8,	'La Ravine des Soupirs',	'La Ravine des Soupirs est un lieu lugubre où dansent des ombres inquiétantes. Vous percevez un mouvement furtif.',	'Vous entendez un murmure mystérieux dans le vent et vous décidez de l\'écouter attentivement',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117498289823154267/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_6866b654-6b21-4ee0-b63f-f258b1c9e805.png',	1,	1),
(9,	'Le Bosquet des Araignées Tisseuses',	'Dans ce Bosquet, les rayons du soleil peinent à percer à travers les voiles de toiles d\'araignées. Vous entendez des craquements se rapprochant rapidement.',	'En tendant la main à gauche, vous sentez une matière collante mais vous ne voyez rien... Vous bifurquez pour comprendre de quoi il s\'agit.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117499732927987733/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_b4aadb88-e35d-4d5c-8302-0c680e91b03c.png',	1,	1),
(10,	'L\'étang aux Lueurs Spectrales',	'Des lueurs blafardes se reflètent sur les eaux sombres de l\'étang. L\'ambiance est lugubre et msytérieuse. Un rugissement retentit soudain, faisant frémir les arbres et ébranlant les âmes les plus vaillantes. Les brumes s\'écartent brutalement.',	'Une luciole spectrale vous file devant le nez ! Vous courez à sa poursuite.',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117500580097691848/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_92d069f0-16e4-4448-a997-75cd665bc4de.png',	5,	1),
(11,	'La Sombre Grotte',	'Ici, la lumière ne pénètre jamais. Alors que vous avancez dans la grotte, des grondements sinistres résonnent. Si vous aviez une once de vocation pour la spéléologie, elle disparaît aussitôt.',	'Un frisson vous parcourt l\'échine. Toute votre attention est absorbée par une grotte que vous voyez se dessiner au loin. Vous êtes comme possédé et ne pouvez vous empêcher d\'approcher...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117501321109573712/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_fc584627-203c-4417-9c80-5ce57dc03cb3.png',	5,	1),
(12,	'Les racines éternelles',	'Les arbres noueux semblent se tordre de douleur et le vent murmure un chuchotement sinistre à travers les feuilles mortes. Une silhouette apparaît, digne d\'un cauchemar éveillé.',	'Vous reprenez votre chemin et n\'arrêtez pas de trébucher ! La forêt n\'a pas fini de vous surprendre...',	'https://cdn.discordapp.com/attachments/1114521519893254195/1117502359032049785/rahkart_generate_an_image_that_depicts_a_captivating_scene_insp_8f0465e2-999e-4467-a166-fb5039726c1d.png',	5,	1),
(13,	'Victoire forêt',	'Votre visage rayonne de fierté et d\'accomplissement alors que vous contemplez les mystères de la nature qui vous ont entouré tout au long de cette épopée. Les arbres majestueux, témoins silencieux de votre courage, vous saluent de leurs branches ondoyantes. Vous sentez la brise légère caresser votre visage, comme pour vous féliciter de votre triomphe. Une douce mélodie résonne dans l\'air, jouée par une flûte invisible, vous rappelant les leçons apprises lors de cette aventure inoubliable. Maintenant, c\'est le moment de prendre congé de cette forêt, portant avec vous le souvenir indélébile de vos prouesses.',	'Vous émergez victorieux de cette sombre forêt après avoir bravé mille périls.',	'https://imagizer.imageshack.com/img922/9859/NongTL.jpg',	6,	1),
(14,	'Victoire !',	'Les terres enchantées se réjouissent de votre succès, tandis que votre nom résonne désormais comme une légende dans les tavernes et les foyers du royaume.',	'Congratulations',	'https://imagizer.imageshack.com/img924/7334/cLWkMv.jpg',	7,	2),
(18,	'Game Over',	'Vous n\'êtes pas prêt !',	'Il va faire tout noir !',	'images/game-over.png',	8,	2);

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
(4,	1),
(5,	3),
(6,	2),
(7,	4),
(8,	5),
(9,	10),
(10,	7),
(11,	8),
(12,	9);

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
(1,	'Sandra du Cookie Ploup-Ploup',	150,	150,	100,	100,	100,	100,	10,	0,	'https://static.vecteezy.com/system/resources/previews/018/931/604/original/cartoon-cookie-icon-png.png',	NULL,	1,	11),
(2,	'Marine du Poney trop Stylé',	150,	150,	100,	100,	100,	100,	10,	0,	'https://www.pngmart.com/files/3/My-Little-Pony-Rarity-PNG-Clipart.png',	NULL,	1,	10),
(6,	'Pierre de la Grotte carrelée',	150,	150,	100,	100,	100,	100,	10,	0,	'images/avatar5.png',	NULL,	1,	8),
(7,	'Anthony de la Cave Backeux',	150,	150,	100,	100,	100,	100,	10,	NULL,	'images/avatar7.png',	NULL,	1,	9),
(8,	'Gauthier le roi des insoumis',	150,	150,	100,	100,	100,	100,	10,	NULL,	'images/avatar2.png',	NULL,	1,	12),
(12,	'Testeur',	100,	100,	100,	100,	100,	100,	7,	0,	'images/default-hero-avatar.png',	0,	2,	27);

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
(1,	'Super Héro',	150,	100,	100,	100,	100,	100),
(2,	'Héro',	100,	100,	100,	100,	100,	100);

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
(1,	1),
(1,	2),
(2,	1),
(2,	2),
(6,	1),
(6,	2),
(7,	1),
(7,	2),
(8,	1),
(8,	2);

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
(1,	'Epée de guerre',	'https://cdn-icons-png.flaticon.com/512/523/523813.png',	10,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'Baton étoilé',	'https://cdn-icons-png.flaticon.com/512/3122/3122411.png',	410,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

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
(1,	'Brom la Chasseuse  de Monstres',	'Brom lève sa main gantée vers le ciel et un éclair d\'énergie magique crépite dans sa paume. Les champignons se mettent à briller intensément. Elle se tourne vers vous avec un sourire malicieux.',	100,	100,	100,	100,	100,	100,	'http://imagizer.imageshack.com/v2/642x642q70/924/8kXdnt.png',	0,	0,	0,	1),
(2,	'Eloi le Protecteur des Animaux',	'D\'un pas léger malgré sa carrure imposante, Éloi s\'approche de vous, accompagné d\'une ménagerie d\'animaux. Il tend les bras et un écureuil s\'y précipite alors qu\'il s\'adresse à vous.',	100,	100,	100,	100,	100,	100,	'https://imagizer.imageshack.com/v2/789x789q90/r/922/X6YrXf.png',	0,	0,	0,	1),
(3,	'Lysandre l\'Érudite',	'Lysandre semble incarner la sagesse et la beauté des temps anciens. Elle s\'approche de vous avec grâce, ses pas résonnant doucement sur les dalles de pierre. Elle brûle de vous poser une question capitale.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/1bde38ab-9964-4585-b910-6e744f8152fd/0_0.png',	0,	0,	0,	2),
(4,	'Thorgar la Rôdeuse',	'Thorgar dégage une aura féroce et semble évaluer votre potentiel. De terribles loups aux yeux dorés l\'accompagnent. Ils se postent à ses côtés en vous observant.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/7547d81a-ab55-4c18-ac75-5a3973d42ae9/0_1.png',	0,	1,	0,	1),
(5,	'Les Farfadets Chapardeurs',	'En baissant les yeux vous découvrez les Farfadets Chapardeurs, d\'étranges et espiègles créatures aux yeux malicieux.',	100,	100,	100,	100,	100,	100,	'https://imagizer.imageshack.com/img924/5015/Q27XNl.png',	0,	1,	0,	8),
(6,	'Les Gobelins Artificiers',	'Le chef des Gobelins Artificiers se présente devant vous, redoutable inventeur déjanté, maîtrisant l\'art de la magie mécanique et de l\'alchimie déviante.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/eba73e8c-3ccb-4bc7-8972-ee1fa133d86b/0_1.png',	0,	1,	200,	3),
(7,	'Le Dragon des Brumes',	'Il se dresse fièrement sur ses pattes griffues, ses ailes déployées, et pousse un hurlement déchirant qui fait vibrer vos os. Sa gueule ne crache pas du feu, mais un nuage de brume toxique.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/a475dd90-cace-46f8-8829-fd9cf1b110cf/0_3.png',	1,	1,	0,	14),
(8,	'La Gardienne des Ancêtres',	'Avec étonnement, vous constatez que le dernier grondement provient du ventre de la Gardienne des Ancêtres qui s\'avance vers vous.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/3f252c85-642c-49b8-ba7d-cdd60d40147c/0_2.png',	1,	1,	0,	11),
(9,	'La Sorcière de l\'humus',	'Elle s\'avance d\'un pas lent et majestueux, exsudant une aura de pouvoir corrompu. Son rire vous fait frissonner jusqu\'à la moelle.',	100,	100,	100,	100,	100,	100,	'https://cdn.midjourney.com/cff72ca6-251f-4baa-8b9b-032eca3abbba/0_0.png',	1,	1,	0,	7),
(10,	'Arachnus Maximus',	'L\'imposant Arachnus Maximus émerge des ombres, le corps couvert de poils noirs et brillants. Ses pattes se terminent en griffes acérées.',	100,	100,	100,	100,	100,	100,	'https://imagizer.imageshack.com/v2/519x519q70/r/924/HQcBIF.png',	0,	1,	100,	10);

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `race` (`id`, `name`, `description`) VALUES
(1,	'Humain',	NULL),
(2,	'Elfe',	NULL),
(3,	'Gobelin',	NULL),
(4,	'Fée',	NULL),
(5,	'Dryade',	NULL),
(6,	'Nain',	NULL),
(7,	'Sorcière',	NULL),
(8,	'Farfadet',	NULL),
(9,	'Troll',	NULL),
(10,	'Animal',	NULL),
(11,	'Esprit',	NULL),
(12,	'Végétal',	NULL),
(13,	'Lutin',	NULL),
(14,	'Dragon',	NULL),
(15,	'Golem',	NULL),
(16,	'Monstre',	NULL);

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
(8,	'pierre@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Pierre',	'images/avatar11.png'),
(9,	'anthony@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m',	'Anthony',	'images/avatar7.png'),
(10,	'marine@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Marine',	'https://www.pngmart.com/files/3/My-Little-Pony-Rarity-PNG-Clipart.png'),
(11,	'sandra@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Sandra',	'https://static.vecteezy.com/system/resources/previews/018/931/604/original/cartoon-cookie-icon-png.png'),
(12,	'gauthier@gameMaster.com',	'[\"ROLE_GAMEMASTER\"]',	'$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6',	'Gauthier',	'images/avatar2.png'),
(27,	'player@player.com',	'[\"ROLE_PLAYER\"]',	'$2y$13$8Iq54Nr6N4a3QZq5SWuE7ejsZROkF5bWIXBg3gqC4rf7uvsqx63TO',	'Testeur',	'images/default-hero-avatar.png');

-- 2023-06-22 17:21:56
