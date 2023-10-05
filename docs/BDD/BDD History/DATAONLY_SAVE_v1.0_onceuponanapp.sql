-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 09 août 2023 à 12:08
-- Version du serveur : 10.6.14-MariaDB
-- Version de PHP : 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boan6375_onceuponanapp`
--

-- --------------------------------------------------------



--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id`, `content`, `dialogue_id`) VALUES
(7, 'Avec plaisir !', 4),
(8, 'Je suis timide...', 4),
(10, 'C\'est fascinant !', 6),
(11, 'Hum...', 6),
(12, 'J\'ai adoré le tome 2 de \"Luminae Arcana - Secrets enchantés de l\'art elfique\".', 8),
(13, 'Je voyage léger, je lis très peu.', 8),
(14, 'Ils sont plus impressionnants que la Bête du Gévaudan.', 5),
(15, 'Celui-ci ressemble au loup-garou de Twilight... Comment s\'appelle-t-il déjà ?', 5),
(16, 'Ton haleine est aussi acide que la brume qui t\'enveloppe.', 10),
(17, 'Ta grandeur est aussi épaisse que la brume qui t\'enveloppe.', 10),
(18, 'Je préfère m\'abstenir.', 12),
(19, 'Je relève le défi, petits chapardeurs !', 12),
(20, 'Difficile de résister aux fantômes farcis...', 11),
(21, 'La prochaine fois, choisissez la salade spectrale !', 11),
(22, 'À propos de cette toile, quel est le secret de sa blancheur si éclatante ?', 9),
(23, 'Vous devriez passer dans Rire et Chansons.', 9),
(24, 'Dans une autre vie, vous auriez été une artiste florale de renom.', 13),
(25, 'Tes lianes et racines ne peuvent entraver mon esprit résolu.', 13),
(26, 'Je suis prêt à voir votre science farfelue en action.', 14),
(27, 'Vous me rappelez mon prof de techno en 4ème B.', 14),
(28, 'Je cherche des connaissances sur les plantes et les remèdes naturels.', 15),
(29, 'Je cherche mon animal totem. Peux-tu me le présenter ?', 15),
(30, 'Oui, j\'aimerais tenter ma chance.', 16),
(31, 'C\'est juste une légende !', 16),
(32, 'Le vert olive.', 17),
(33, 'Le vert Hulk.', 17),
(34, 'L\'Autel est-il toujours en service ?', 18),
(35, 'Je suis passionné d\'Histoire, noble Chevalier Feuillu.', 18),
(36, 'J\'ai plutôt l\'habitude de me fier à ma boussole.', 19),
(37, 'Comme les Rois Mages... En Galilée....', 19),
(38, 'Bon courage, l\'ami !', 20),
(39, 'Végane, c\'est pas un peu extrémiste, ça ?', 20),
(40, 'Je suis nouveau, mais tu me donnes envie de rester pour toujours.', 21),
(41, 'Merci... Hum... Vous avez un sacré sens du rythme !', 21),
(42, 'Qu\'est-ce qui doit être cassé avant qu\'on l\'utilise ?', 22),
(43, 'Qu\'est-ce qui est petit et marron ?', 22),
(44, 'Elle est partie par là !', 23),
(45, 'Pardon, mais... que vous avez de grandes dents !', 23),
(46, 'Je vous crois sur parole.', 24),
(47, 'Quelles sont vos sources ?', 24),
(48, 'J\'ai connu des pique-niques plus effrayants.', 25),
(49, 'Je te reconnais ! Tu es Casper le gentil fantôme !', 25),
(50, 'Si tu savais ce que j\'ai vu dans la taverne des Nains... mais promets-moi que ça reste entre nous !', 26),
(51, 'On dit que le fameux \"trésor des elfes\" est en réalité une montagne de chaussettes dépareillées.', 26),
(52, 'C\'est comme si mes rêves les plus fous se réalisaient ! Je suis définitivement prêt.', 27),
(53, 'Que le headbanging commence !', 27),
(54, 'La guitare de Remy le Barde à la fête du Feu Follet.', 28),
(55, 'La chanson \"Libérée, Délivrée\", ma préférée.', 28),
(56, 'Le beurre salé évidemment.', 29),
(57, 'Le beurre doux, évidemment.', 29),
(58, 'Votre ramage se rapporte à votre plumage, les deux sont si dark !', 30),
(59, 'Votre ramage se rapporte à votre plumage, les deux sont pleins d\'éclat !', 30),
(60, 'Oula... Avez-vous déjà entendu parler des thérapies comportementales et cognitives ? Je connais un excellent spécialiste, je pourrais vous donner son numéro si vous voulez.', 31),
(61, 'Un gros câlin vous remonterait le moral à coup sûr !', 31);

-- --------------------------------------------------------


--
-- Déchargement des données de la table `answer_effect`
--

INSERT INTO `answer_effect` (`answer_id`, `effect_id`) VALUES
(7, 5),
(8, 6),
(8, 14),
(10, 7),
(11, 8),
(12, 10),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19),
(19, 20),
(20, 21),
(21, 22),
(22, 23),
(23, 24),
(24, 25),
(25, 26),
(26, 27),
(27, 28),
(28, 29),
(29, 30),
(30, 31),
(31, 32),
(32, 33),
(33, 34),
(34, 35),
(35, 36),
(36, 37),
(37, 38),
(38, 39),
(39, 40),
(40, 41),
(41, 42),
(42, 43),
(43, 44),
(44, 45),
(45, 46),
(46, 47),
(47, 48),
(48, 49),
(49, 50),
(50, 51),
(51, 52),
(52, 53),
(53, 54),
(54, 55),
(55, 56),
(56, 57),
(57, 58),
(58, 59),
(59, 60),
(60, 61),
(61, 62);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `biome`
--

INSERT INTO `biome` (`id`, `name`, `difficulty`) VALUES
(1, 'Forêt', 2),
(2, 'Game', 0);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `dialogue`
--

INSERT INTO `dialogue` (`id`, `content`, `npc_id`) VALUES
(4, 'Aventurier, fais-moi ton cri de guerre le plus effrayant !', 1),
(5, 'Mes fidèles compagnons sont mes yeux et mes oreilles dans les ténèbres. Prenez garde à ne pas sous-estimer leur intelligence.', 4),
(6, 'Saviez-vous qu\'il existe un corbeau fan de Shakespeare qui récite Hamlet en picorant des vers de terre ?', 2),
(8, 'Cher voyageur, quel est votre ouvrage préféré, en matière de magie elfique classique ?', 3),
(9, 'Vous êtes tombé dans ma toile... littéralement ! Préparez-vous à une rencontre tissée de défis et d\'humiliation.', 10),
(10, 'Sais-tu pourquoi je suis craint à travers ces contrées ?', 7),
(11, 'Une indigestion spectrale, manquait plus que ça ! Je n\'en peux plus des repas gargantuesques des Rendez-Vous des Ancêtres...', 8),
(12, 'Voulez-vous tenter de retrouver l\'objet que nous avons subtilisé ?', 5),
(13, 'Pour ta fin de vie, que préfères-tu ? Étranglé par une liane... ou dévoré par les vers de ma terre fertile ?', 9),
(14, 'Prépare-toi à découvrir notre dernière invention !', 6),
(15, 'Bienvenue dans la Clairière Verdoyante. Qu\'est-ce qui t\'attire dans la magie verte ?', 11),
(16, 'Salut, aventurier ! Tu cherches peut-être à attraper les poissons d\'or ?', 12),
(17, 'Salut toi ! Dis, c\'est quoi ta couleur préférée ?', 13),
(18, 'Bienvenue à l\'Autel de l\'Écorce, un lieu de communion entre les mondes. Que puis-je pour vous ?', 14),
(19, 'Quelle étoile t\'a guidé jusqu\'à moi ?', 15),
(20, 'Je meurs de faim, je fais un jeûne intermittent... Mais t\'as rien à craindre, je suis végane.', 16),
(21, 'Tu es nouveau, n\'est-ce pas ? Je me souviendrais si j\'avais déjà croisé un si joli minois.', 17),
(22, 'Hihihi ! Fais-moi une devinette ! Si tu parviens à me divertir, je t\'épargnerai !', 18),
(23, 'Je cherche la fillette vêtue d\'un capuchon écarlate.', 19),
(24, 'Les sangsues ont d\'incroyables vertus thérapeutiques, vous savez...', 20),
(25, 'Treeemble devant l\'effroiiii de cette forêêêt...', 21),
(26, 'Aventurier, n\'as-tu pas un secret croustillant à me dévoiler ?', 22),
(27, 'Êtes-vous prêt à plonger dans l\'abîme de l\'imagination, là où les licornes chantent du death metal ?', 23),
(28, 'Si tu pouvais capturer un écho dans une bouteille, aventurier, que voudrais-tu entendre à l\'infini ?', 24),
(29, 'Sais-tu quel est l\'ingrédient incontournable pour une galette réussie ?', 25),
(30, 'Toute fable noire a sa morale amère, je viens vous rappeler que vous êtes éphémère.', 26),
(31, 'Va-t-en ! Ma souffrance est la seule compagne que je tolère à mes côtés.', 27);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230608114918', '2023-06-15 17:28:04', 162),
('DoctrineMigrations\\Version20230608114924', '2023-06-15 17:28:04', 33),
('DoctrineMigrations\\Version20230608115345', '2023-06-15 17:28:04', 33),
('DoctrineMigrations\\Version20230608115548', '2023-06-15 17:28:04', 25),
('DoctrineMigrations\\Version20230608115914', '2023-06-15 17:28:04', 16),
('DoctrineMigrations\\Version20230608115925', '2023-06-15 17:28:04', 27),
('DoctrineMigrations\\Version20230608120055', '2023-06-15 17:28:04', 98),
('DoctrineMigrations\\Version20230608120155', '2023-06-15 17:28:04', 22),
('DoctrineMigrations\\Version20230608120205', '2023-06-15 17:28:04', 25),
('DoctrineMigrations\\Version20230608120242', '2023-06-15 17:28:04', 21),
('DoctrineMigrations\\Version20230608120611', '2023-06-15 17:28:04', 26),
('DoctrineMigrations\\Version20230608120627', '2023-06-15 17:28:04', 18),
('DoctrineMigrations\\Version20230608121709', '2023-06-15 17:28:04', 15),
('DoctrineMigrations\\Version20230608121712', '2023-06-15 17:28:04', 19),
('DoctrineMigrations\\Version20230608130332', '2023-06-15 17:28:04', 19),
('DoctrineMigrations\\Version20230608130559', '2023-06-15 17:28:04', 9),
('DoctrineMigrations\\Version20230608132036', '2023-06-15 17:28:04', 87),
('DoctrineMigrations\\Version20230608132442', '2023-06-15 17:28:04', 177),
('DoctrineMigrations\\Version20230608132738', '2023-06-15 17:28:05', 147),
('DoctrineMigrations\\Version20230608132949', '2023-06-15 17:28:05', 188),
('DoctrineMigrations\\Version20230608133053', '2023-06-15 17:28:05', 121),
('DoctrineMigrations\\Version20230608133225', '2023-06-15 17:28:05', 90),
('DoctrineMigrations\\Version20230608133331', '2023-06-15 17:28:05', 78),
('DoctrineMigrations\\Version20230608133955', '2023-06-15 17:28:05', 187),
('DoctrineMigrations\\Version20230608134212', '2023-06-15 17:28:05', 148),
('DoctrineMigrations\\Version20230608134310', '2023-06-15 17:28:06', 147),
('DoctrineMigrations\\Version20230608134406', '2023-06-15 17:28:06', 183),
('DoctrineMigrations\\Version20230608134447', '2023-06-15 17:28:06', 146),
('DoctrineMigrations\\Version20230613092007', '2023-06-15 17:28:06', 10),
('DoctrineMigrations\\Version20230619114003', '2023-06-22 15:38:19', 37),
('DoctrineMigrations\\Version20230622133928', '2023-06-22 15:39:35', 77),
('DoctrineMigrations\\Version20230626212201', '2023-06-26 23:41:55', 29),
('DoctrineMigrations\\Version20230626214201', '2023-06-26 23:42:05', 382),
('DoctrineMigrations\\Version20230626222428', '2023-06-27 00:24:38', 36),
('DoctrineMigrations\\Version20230626231127', '2023-06-27 01:11:39', 90);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `effect`
--

INSERT INTO `effect` (`id`, `name`, `description`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`) VALUES
(1, 'Bonus de Vie', 'Soin', 30, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Malus de Vie', 'Dégat', -20, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Boss Fight', 'Dégat', -35, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Potion de Rien', 'T\'abuses un peu trop de la boisson', NULL, NULL, NULL, NULL, NULL, -10, NULL),
(5, 'Brom bonus', 'Vous l\'impressionnez et gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Brom zéro effet', 'Elle est déçue mais se montre compréhensive.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Eloi bonus', 'Il est ravi que vous partagiez sa passion de la nature, vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Eloi zéro effet', 'Il tourne les talons, semblant préférer la compagnie de l\'écureuil.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Lysandre bonus', 'Incroyable, vous avez le même livre préféré ! Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Lysandre zéro effet', 'Elle regrette que vous ne partagiez pas sa passion.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Thorgar malus faible', 'Flattée, elle retiendra ses coups. Vous recevez un malus faible.', -5, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Thorgar malus moyen', 'Comment OSEZ-VOUS ? Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Dragon malus moyen', 'Le dragon a le sens de l\'humour. Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Dragon malus fort', 'Le dragon n\'est pas sensible à la flatterie. Vous recevez un malus fort.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Farfadets Chapardeurs malus faible', 'Vous évitez les ennuis et recevez un malus faible.', -5, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Farfadets Chapardeurs malus moyen', 'Les Farfadets en profitent pour vous voler davantage. Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Gardienne malus moyen', 'Votre compréhension la rassure. Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Gardienne malus fort', 'Votre insolence la fait vriller. Vous recevez un malus fort.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Arachnus Maximus malus faible', 'Arachnus vous tient la jambe pendant une heure. Vous recevez un malus faible.', -5, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Arachnus Maximus malus moyen', 'Rien n\'est plus grand qu\'Arachnus... Si ce n\'est son ego ! Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Sorcière de l\'Humus malus moyen', 'Vous touchez un point sensible et la déstabilisez. Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Sorcière de l\'Humus malus fort', 'Elle va vous prouver le contraire. Vous recevez un malus fort.', -20, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Gobelins Artificiers malus faible', 'Vous savez apprécier son art et recevez un malus faible.', -5, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Gobelins Artificiers malus moyen', 'Les gobelins se vengent de l\'affront que vous avez fait à leur chef. Vous recevez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Elara bonus', 'Elle vous offre un sort de soin et vous recevez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Elara zéro effet', 'Son truc à elle, c\'est plutôt les végétaux...', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Lumi zéro effet', 'Craignant que vous ne lui fassiez concurrence, il vous mène sur une fausse piste.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Lumi bonus', 'Pour vous prouver votre erreur, il vous jette un miniscule poisson doré. Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Ivy zéro effet', 'Elle fronce le nez, visiblement déçue.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Ivy bonus', 'Un immense sourire illumine son visage. Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Bryn bonus', 'Comme pour vous répondre, l\'Autel se met à briller d\'une aura magique. Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Bryn zéro bonus', 'Bryn est mauvais conteur mais tente de vous satisfaire.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Seraphina zéro effet', 'Elle éclate de rire et vous prend pour un fou.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Seraphina bonus', 'Apparemment, la chanteuse Sheila est connue jusque dans cette forêt. Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Pop-Cornes bonus', 'Votre compassion le touche, il vous aide à traverser.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Pop-Cornes zéro effet', 'Il renâcle. Vous trouverez la sortie tout seul !', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Remy bonus', 'Il dépose sur votre joue un baiser magique. Vous gagnez un bonus.', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Remy zéro effet', 'Le voilà déjà en train de charmer une autre convive...', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Farcey malus faible', 'Il sèche mais s\'en va frustré. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Farcey malus moyen', 'Un marron. Il est fort le con ! Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Griflamme malus faible', 'Il vous croit mais mentir, c\'est mal. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Griflamme malus moyen', 'C\'est pour mieux vous manger. Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Gobul malus faible', 'Elle jette une sangsue sur vous, mais vous rate. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Gobul malus moyen', 'Elle vous propose une démo. Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Ombrethorn malus faible', 'Il disparaît mais l\'humidité ambiante vous fait attraper un rhume. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Ombrethorn malus moyen', 'Vous le saviez, pourtant, que c\'était le Fantôme Sylvestre... Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Discordia malus faible', 'Vous lui plaisez mais vous ne valez pas mieux qu\'elle. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Discordia malus moyen', 'Elle vous assure que c\'est une fake news. Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Jerarmajax malus faible', 'L\'illusion démarre mais la symphonie est atroce. La déception vous donne un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Jerarmajax malus moyen', 'Votre tête heurte l\'arche de pierre. Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Lilith malus faible', 'Ce souvenir vous rend nostalgique. Vous recevez un malus faible.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Lilith malus moyen', 'N\'avez-vous donc aucun instinct de survie ? Vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Chaperon malus moyen', 'Sa famille a des origines bretonnes, vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Chaperon malus fort', 'Sa famille a des origines bretonnes, vous recevez un malus fort.', -20, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Maitre corbeau malus moyen', 'On le lui dit souvent, vous recevez un malus moyen.', -15, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Maitre corbeau malus fort', 'Le renard l\'a rendu méfiant face aux flatteurs, vous recevez un malus fort.', -20, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Arya malus moyen', 'Malgré votre insolence, vous lui avez donné espoir. Vous recevrez un malus moyen.', -10, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Arya malus fort', 'Note pour plus tard : éviter les câlins aux créatures aux bois tranchants. Vous recevez un malus fort.', -20, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `ending`
--

INSERT INTO `ending` (`id`, `content`, `event_id`, `event_type_id`) VALUES
(1, 'Vous quittez l\'abri de l\'arbre centenaire, sentant que des présences curieuses vous observent.', 1, 3),
(2, 'Vous vous éloignez de cet endroit. L\'écho d\'un grondement lointain résonne dans l\'air.', 1, 1),
(3, 'Vous prenez congé du grand arbre. Le vent murmure des légendes d\'anciens combats épiques.', 1, 5),
(4, 'Vous vous éloignez de la cascade étincelante, percevant un frôlement fugace sur votre épaule.', 2, 3),
(5, 'Vous vous écartez de la cascade argentée et des éclats de l\'eau qui dansent avec fureur.', 2, 1),
(6, 'Alors que vous quittez la cascade impétueuse, une brume épaisse s\'élève des eaux tumultueuses.', 2, 5),
(7, 'Vous poursuivez. Ce sentier mélodieux vous guide-t-il vers quelqu\'un ?', 3, 3),
(8, 'Quand vous vous éloignez du sentier, une tension électrique éveille votre instinct de guerrier.', 3, 1),
(9, 'Vous quittez le sentier enchanteur. Votre cœur bat au rythme des mystères et des dangers de la forêt.', 3, 5),
(10, 'Vous vous éloignez des champignons lumineux, avide de contrées très paisibles.', 4, 2),
(11, 'Vous délaissez les champignons étranges pour vous enfoncer dans les profondeurs de la foret.', 4, 1),
(12, 'Vous vous détournez de cet oasis féerique, animé par une détermination inébranlable.', 4, 5),
(13, 'Vous cherchez un endroit plus serein, lassé des vieilles pierres.', 5, 2),
(14, 'Vous abandonnez les ruines décrépites, animé par une soif d\'action.', 5, 1),
(15, 'Une lueur d\'intrépidité brille dans vos yeux alors que vous vous éloignez.', 5, 5),
(16, 'Vous quittez la clairière enchantée et profitez de la tranquillité de la nature environnante.', 6, 2),
(17, 'Vous abandonnez les symboles runiques et vous sentez fatigué. Il en faudrait peu pour que vous perdiez votre sang froid...', 6, 1),
(18, 'Vous quittez la clairière sacrée, prêt à défier des puissances redoutables.', 6, 5),
(19, 'Vous partez loin des visions tourbillonnantes qui habitent ces lieux mystiques.', 7, 2),
(20, 'Vous quittez le cercle sacré, pressé de raconter cela à quiconque croiserait votre route.', 7, 3),
(21, 'Vous ne ressentez plus aucune crainte ni hésitation en quittant ce lieu de bataille.', 7, 5),
(22, 'Épuisé, vous vous éloignez au plus vite de ces murmures mystérieux.', 8, 2),
(23, 'Alors que vous vous écartez de la gorge, vous sentez que vous auriez besoin d\'un peu de compagnie.', 8, 3),
(24, 'Vous laissez la ravine derrière vous, prêt à repousser les limites de votre courage.', 8, 5),
(25, 'Vous fuyez au calme, loin de ces arachnides fascinantes et imprévisibles.', 9, 2),
(26, 'Alors que vous quittez l\'espace enchanté, vous rêvez d\'un rebondissement inattendu.', 9, 3),
(27, 'Vous vous écartez du réseau complexe des araignées géantes. Après ça, il va falloir faire fort pour vous effrayer.', 9, 5),
(28, 'Vous partez loin des lueurs mystérieuses qui hantent ces lieux terrifiants.', 10, 6),
(31, 'Vous ressentez le besoin viscéral de laisser derrière vous ces ténèbres oppressantes.', 11, 6),
(34, 'Vous soufflez lentement en laissant derrière vous l\'oppression de ces racines sinistres.', 12, 6),
(37, 'Dans un éclat de triomphe, vous avez surmonté tous les obstacles et remporté la victoire finale.', 13, 7),
(38, 'Vous reprenez la route, même si vous rêvez de vous allonger et rêvasser dans l\'herbe.', 22, 2),
(39, 'Vous poursuivez votre chemin, persuadé qu\'une surprise vous attend dans la forêt.', 22, 3),
(40, 'Malgré la paix de ce champ, vous serrez votre arme à la main en reprenant la route.', 22, 1),
(41, 'Rasséréné, vous êtes prêt à relever les défis les plus épiques.', 22, 5),
(42, 'Vous avez franchi le petit pont de bois avec une profonde quiétude.', 23, 2),
(43, 'Vous continuez votre route, le cœur empli d\'excitation et d\'attentes.', 23, 3),
(44, 'À la sortie du pont, des traces dans la boue troublent votre paix intérieure.', 23, 1),
(45, 'De l\'autre côté du pont, la mélodie cesse brutalement.', 23, 5),
(46, 'Vous vous éloignez lentement, la magie continue de vibrer en vous.', 24, 2),
(47, 'Vous avez la sensation d\'être observé en vous éloignant de la flaque.', 24, 3),
(48, 'Vous jetez un dernier regard aux reflets brillants en partant, votre instinct est en alerte.', 24, 1),
(49, 'Vous partez en faisant le plein d\'énergie magique. Cela pourrait bien servir...', 24, 5),
(50, 'La végétation semble s\'incliner avec grâce pour vous souhaiter bonne route.', 25, 2),
(51, 'Vous sentez une énergie attirante dans l\'air, en laissant le vieil arbre.', 25, 3),
(52, 'L\'agitation qui vous envahit contraste avec la tranquillité du lieu que vous quittez.', 25, 1),
(53, 'Cette dépouille végétale vous fait réfléchir sur votre propre condition de mortel.', 25, 5),
(54, 'Vous continuez votre chemin, portant avec vous les bienfaits de cette rencontre avec Elara.', 26, 2),
(55, 'Vous sortez du halo de lumière, impatient de croiser d\'autres âmes bienveillantes.', 26, 3),
(56, 'Vous quittez la clairière dorée énergisé, prêt à déclencher un combat imprévisible.', 26, 1),
(57, 'Une énergie surpuissante s\'accumule en vous. Vous allez en avoir besoin.', 26, 5),
(58, 'Alors que vous vous éloignez, vous pensez à la légèreté de cet instant avec Lumi.', 27, 2),
(59, 'Vous partez en réalisant que la forêt est plus peuplée que vous ne le pensiez.', 27, 3),
(60, 'Vous espérez être aussi vif que Lumi lors de vos prochaines batailles.', 27, 1),
(61, 'Heureusement que Lumi n\'a pas décidé de cheminer avec vous. La suite de votre périple s\'annonce bien trop violente pour un garçon de son âge.', 27, 5),
(62, 'Quelques mètres plus loin, vous ressentez encore quelques effluves de magie.', 28, 3),
(63, 'La lueur verte d\'Ivy a éclairé votre chemin, vous êtes avide de nouveaux échanges.', 28, 3),
(64, 'Quand la lumière verte s\'estompe, vous remarquez des perturbations dans l\'atmosphère.', 28, 1),
(65, 'Vous priez pour que la puissance verdoyante d\'Ivy protège votre prochaine escale.', 28, 5),
(66, 'La présence de Bryn résonne encore en vous bien après l\'avoir laissé.', 29, 2),
(67, 'Vous laissez Bryn en espérant rencontrer d\'autres âmes aussi vaillantes.', 29, 3),
(68, 'En quittant Bryn, vous vous demandez quels sont ses faits d\'armes.', 29, 1),
(69, 'Un peu plus loin, vous allez amèrement regretter de ne pas avoir proposé au Chevalier Feuillu de vous accompagner.', 29, 5),
(70, 'La présence de Seraphina vous a connecté à une harmonie cosmique.', 30, 2),
(71, 'Vous marchez avec une certaine excitation, loin de cette rencontre astrale.', 30, 3),
(72, 'Les astres vous saluent en vous recommandant de rester sur vos gardes.', 30, 1),
(73, 'En partant, vous réalisez que l\'alignement des étoiles annonce un événement inédit et terrible.', 30, 5),
(74, 'Vous avez le sourire aux lèvres, ravi d\'avoir trouvé la sortie.', 31, 2),
(75, 'La créature imposante de Pop-Cornes a éveillé votre curiosité, vous reprenez la route.', 31, 3),
(76, 'En quittant le minotaure, vous vous dites qu\'il va falloir faire fort pour vous intimider.', 31, 1),
(77, 'Si vous aviez pu lire l\'avenir, vous seriez sûrement resté tapi dans le labyrinthe.', 31, 5),
(78, 'En quittant la fête, vous vous autorisez un petit pas de danse.', 32, 2),
(79, 'Cette atmosphère romantique vous a ouvert l\'appétit pour de nouvelles rencontres.', 32, 3),
(80, 'Après le réconfort, l\'effort... Vous partez vers une autre forme d\'animation.', 32, 1),
(81, 'Heureusement que vous avez bien profité de la fête. C\'était peut-être la dernière pour vous !', 32, 5),
(82, 'Vous quittez la grotte sombre, encore pris de fous rires incontrôlables.', 33, 2),
(83, 'Vous vous dirigez vers un coin animé de la forêt, espérant que d\'autres créatures sauront plaisanter avec vous.', 33, 3),
(84, 'Vous espérez que votre prochain adversaire sera aussi divertissant.', 33, 1),
(85, 'La grotte vous semblait sombre. Ce n\'est rien à côté de l\'énergie inquiétante qui se manifeste autour de vous.', 33, 5),
(86, 'Vous vous échappez de la caverne obscure, vers les vastes étendues de la forêt.', 34, 2),
(87, 'En quittant le loup, vous réalisez que vous ne pourriez pas être aussi solitaire.', 34, 3),
(88, 'Vous sentez que Griflamme n\'est pas la seule créature qui rôde par ici.', 34, 1),
(89, 'A peine sorti du repaire, vous sentez l\'arrivée imminente d\'un adversaire encore plus redoutable.', 34, 5),
(90, 'Vous mettez de la distance les sinistres sourires de Gobul et vous.', 35, 2),
(91, 'Les bruits de succion s\'estompent. Vous priez pour que votre prochaine rencontre soit moins répugnante.', 35, 3),
(92, 'Vous vous éloignez rapidement, sur vos gardes, tentant de ne pas vous laisser surprendre.', 35, 1),
(93, 'Les sangsues sont mignonnes comme de petites fleurs, si on les compare à ce qui vous attend ensuite.', 35, 5),
(94, 'Vous cherchez le rayon de soleil qui vous réchauffera après ce brouillard.', 36, 2),
(95, 'Laissant derrière vous le sentier vacillant, vous marchez vers des lieux à l\'atmosphère plus animée.', 36, 3),
(96, 'Vous mettez prudemment fin à votre exploration du sentier.', 36, 1),
(97, 'Les feux follets dansants s\'agitent avec effroi, révélant l\'imminence d\'un adversaire insaisissable.', 36, 5),
(98, 'Vous partez en quête d\'un endroit paisible où le chant des oiseaux remplacera les ragots.', 37, 2),
(99, 'Après Discordia, quels esprits facétieux pourraient venir pimenter votre aventure ?', 37, 3),
(100, 'Les Buissons des Ragots ont parlé d\'un être malveillant dans les parages...', 37, 1),
(101, 'La suite de votre périple s\'annonce si angoissante que même Discordia n\'oserait la raconter à personne.', 37, 5),
(102, 'Vous vous éloignez de la porte céleste et des mirages troublants.', 38, 2),
(103, 'Les lueurs mystérieuses dansent autour de vous sur quelques mètres.', 38, 3),
(104, 'Vous franchissez la porte magique, sans savoir ce qui vous attend de l\'autre côté.', 38, 1),
(105, 'Plus loin sur votre route, une angoisse puissante vous saisit. Pourvu que ce ne soit que le fruit d\'une dernière illusion de Jerarmajax...', 38, 5),
(106, 'Vous prenez la route de sentiers plus tranquilles, où vos propres mots résonneront avec une clarté retrouvée.', 39, 2),
(107, 'Vous espérez bientôt rencontrer quelqu\'un à qui raconter cette troublante escale.', 39, 3),
(108, 'En remontant rapidement du Val de Perte-Voix, vous ne vous sentez pas tout à fait à l\'abri.', 39, 1),
(109, 'Vous courez presque pour sortir du vallon encaissé. Préparez-vous à rester sans voix - et ce coup-ci, Lilith n\'en sera pas responsable.', 39, 5),
(110, 'Vous vous laissez porter par la quiétude de ce lieu, apaisé.', 1, 2),
(111, 'Vous quittez les eaux, priant pour que votre périple vous dévoile d\'autres lieux merveilleux.', 2, 2),
(112, 'La mélodie continue de vous bercer tandis que vous repartez, serein.', 3, 2),
(113, 'Vous êtes d\'une humeur enjouée après cette rencontre avec Brom.', 4, 3),
(114, 'Vous vous demandez combien de créatures fascinantes vivent ici.', 5, 3),
(115, 'Vous êtes d\'humeur joviale en quittant Eloi.', 6, 3),
(116, 'Vous abandonnez les pierres sacrées, le cœur battant.', 7, 1),
(117, 'Curieux farfadets. Vous vous demandez qui sera votre prochain adversaire.', 8, 1),
(118, 'En partant, le souvenir de Maximus vous colle littéralement à la peau.', 9, 1),
(119, 'Sa voix cristalline se brise dans un dernier hurlement de frustration, alors que vous vous échappez de l\'atmosphère opprimante de la Rencontre Écarlate.', 19, 6),
(120, 'Les corbeaux géants, témoins de votre survie, se dispersent dans le ciel. Vous quittez enfin la sinistre allée de la Branche Crochue.', 20, 6),
(121, 'Vous vous échappez de l\'atmosphère maudite de l\'Allée de l\'Absence, laissant derrière vous les arbres dénudés et la tristesse infinie qui y régnait. Vous vous sentez heureux d\'avoir survécu à cette créature terrifiante.', 21, 6);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `opening`, `event_type_id`, `biome_id`, `picture_id`) VALUES
(1, 'L\'Arche de Verdure', 'Vous découvrez un immense arbre centenaire aux branches étendues en arc, formant un abri naturel en son centre. Les rayons du soleil filtrent à travers les feuilles, créant un kaléidoscope de couleurs et un refuge paisible pour les voyageurs égarés.', 'Vous apercevez un rayon de soleil filtrant à travers les feuilles, attirant votre attention vers un immense arbre centenaire.', 4, 1, 16),
(2, 'Les Chutes Argentées', 'Vous arrivez devant une cascade impétueuse qui dévale des falaises rocheuses, projetant des éclats d\'eau qui brillent comme de l\'argent au soleil. L\'endroit est réputé pour ses propriétés curatives et sa beauté éblouissante.', 'Votre oeil est attiré au loin par l\'éclat argenté d\'une cascade impétueuse, dévalant des falaises rocheuses.', 2, 1, 40),
(3, 'Le Chemin du Murmure', 'Vous empruntez un sentier caressé par une douce brise, où les feuilles des arbres murmurent des secrets à ceux qui les écoutent attentivement. Chaque pas révèle une nouvelle mélodie, créant une symphonie naturelle qui berce les âmes en quête de tranquillité.', 'Vous réalisez que le bruissement des feuilles a changé. Comme si elles cherchaient à vous parler...', 2, 1, 39),
(4, 'Le Cercle des Champignons', 'Les couleurs éclatantes des champignons illuminent la scène. Un voile de brume flotte dans l\'air. Une silhouette se détache des arbres environnants et s\'avance d\'un pas assuré.', 'Un peu plus loin, d\'immenses champignons colorés aux formes étranges attirent votre curiosité.', 3, 1, 38),
(5, 'Les Ruines Perdues', 'Les ruines perdues se dressent majestueusement devant vous, témoins silencieux d\'un passé oublié. Les pierres antiques racontent des histoires que seuls les personnes les plus cultivées peuvent comprendre.', 'Vous avancez et buttez sur une pierre qui ne ressemble pas aux autres cailloux de la forêt.', 3, 1, 27),
(6, 'La Clairière des Runes', 'La clairière scintille de runes magiques. Une silhouette masculine émerge des frondaisons. En tenue verdoyante et ornée de feuilles, il semble tout droit sorti d\'une chanson de Disney.', 'Votre attention est attirée par d\'étranges symboles gravés dans le sol. Ils semblent indiquer une route à suivre.', 3, 1, 37),
(7, 'Le Sanctuaire des Anciens', 'Vous arrivez devant un cercle sacré de pierres dressées. La brume enveloppe le sanctuaire, chargé d\'énergie magique. Vous sentez quelqu\'un approcher à travers le brouillard.', 'Les pierres qui vous entourent ne sont pas placées au hasard. Vous avancez, curieux d\'en savoir plus.', 1, 1, 36),
(8, 'La Ravine des Soupirs', 'La Ravine des Soupirs est un lieu lugubre où dansent des ombres inquiétantes. Vous percevez un mouvement furtif.', 'Vous entendez un murmure mystérieux dans le vent et vous décidez de l\'écouter attentivement', 1, 1, 35),
(9, 'Le Bosquet des Araignées Tisseuses', 'Dans ce Bosquet, les rayons du soleil peinent à percer à travers les voiles de toiles d\'araignées. Vous entendez des craquements se rapprochant rapidement.', 'En tendant la main à gauche, vous sentez une matière collante mais vous ne voyez rien... Vous bifurquez pour comprendre de quoi il s\'agit.', 1, 1, 34),
(10, 'L\'étang aux Lueurs Spectrales', 'Des lueurs blafardes se reflètent sur les eaux sombres de l\'étang. L\'ambiance est lugubre et msytérieuse. Un rugissement retentit soudain, faisant frémir les arbres et ébranlant les âmes les plus vaillantes. Les brumes s\'écartent brutalement.', 'Une luciole spectrale vous file devant le nez ! Vous courez à sa poursuite.', 5, 1, 33),
(11, 'La Sombre Grotte', 'Ici, la lumière ne pénètre jamais. Alors que vous avancez dans la grotte, des grondements sinistres résonnent. Si vous aviez une once de vocation pour la spéléologie, elle disparaît aussitôt.', 'Un frisson vous parcourt l\'échine. Toute votre attention est absorbée par une grotte que vous voyez se dessiner au loin. Vous êtes comme possédé et ne pouvez vous empêcher d\'approcher...', 5, 1, 32),
(12, 'Les racines éternelles', 'Les arbres noueux semblent se tordre de douleur et le vent murmure un chuchotement sinistre à travers les feuilles mortes. Une silhouette apparaît, digne d\'un cauchemar éveillé.', 'Vous reprenez votre chemin et n\'arrêtez pas de trébucher ! La forêt n\'a pas fini de vous surprendre...', 5, 1, 31),
(13, 'Victoire forêt', 'Votre visage rayonne de fierté et d\'accomplissement alors que vous contemplez les mystères de la nature qui vous ont entouré tout au long de cette épopée. Les arbres majestueux, témoins silencieux de votre courage, vous saluent de leurs branches ondoyantes. Vous sentez la brise légère caresser votre visage, comme pour vous féliciter de votre triomphe. Une douce mélodie résonne dans l\'air, jouée par une flûte invisible, vous rappelant les leçons apprises lors de cette aventure inoubliable. Maintenant, c\'est le moment de prendre congé de cette forêt, portant avec vous le souvenir indélébile de vos prouesses.', 'Vous émergez victorieux de cette sombre forêt après avoir bravé mille périls.', 6, 1, 30),
(14, 'Victoire !', 'Les terres enchantées se réjouissent de votre succès, tandis que votre nom résonne désormais comme une légende dans les tavernes et les foyers du royaume.', 'Congratulations', 7, 2, 107),
(18, 'Game Over', 'Vous ne pouvez pas lutter, la force de l\'adversaire est trop grande. Le souffle coupé, vous vous effondrez lentement, sentant la froideur de la défaite envahir votre être. Votre histoire s\'achève ici, dans ce lieu enchanté. Si cela peut vous consoler, sachez que les murmures de la forêt garderont longtemps le souvenir de votre bravoure.', 'Vous n\'étiez pas prêt !', 8, 2, 106),
(19, 'La Rencontre Écarlate', 'Les arbres se courbent sinistrement, formant une voûte menaçante au-dessus de vous. Une atmosphère oppressante règne, chargée de terreur mêlée d\'une surprenante familiarité. Une voix cristalline résonne près de vous.', 'Vous donneriez cher pour retourner à l\'époque où vos parents vous lisaient un conte avant de dormir.', 5, 1, 73),
(20, 'La Branche Crochue', 'L\'air est empreint d\'une odeur d\'humus et de mystère, tandis que les murmures du vent résonnent parmi les feuilles froissées. Des corbeaux géants, leurs plumes noires luisant sinistrement, surveillent les environs depuis les branches tordues des arbres centenaires.', 'Derrière le bruit du vent, vous distinguez comme un croassement dissonant.', 5, 1, 68),
(21, 'L\'Allée de l\'Absence Tourmentée', 'Vous avancez le long d\'une allée sombre et oppressante. Les arbres dénudés se dressent, tordus comme des griffes prêtes à attaquer. Une aura de douleur et de tristesse infinie émane de chaque recoin de ce lieu maudit et pénètre votre âme.', 'Une longue allée s\'ouvre sous vos pas.', 5, 1, 70),
(22, 'Le champ de fleurs sauvages', 'Vous pénétrez dans un vaste champ où des fleurs aux couleurs éclatantes dansent au rythme d\'une brise légère. Le parfum envoûtant des fleurs embaume l\'air, créant une ambiance enchanteresse. Des papillons aux ailes chatoyantes voltigent joyeusement parmi les pétales, ajoutant une touche de magie à ce tableau floral.', 'Une brise légère apporte avec elle de délicieuses flagrances fleuries.', 2, 1, 76),
(23, 'Le petit pont de bois', 'Un charmant petit pont de bois enjambant un ruisseau cristallin s\'étend devant vous. Son apparence rustique est agrémentée de délicates sculptures de créatures fantastiques. Les planches grincent légèrement sous vos pas, créant une mélodie discrète qui semble éveiller la nature environnante. C\'est un passage pittoresque qui invite à l\'aventure.', 'Vous prenez un sentier pittoresque, où court une jolie rivière.', 2, 1, 80),
(24, 'La flaque aux reflets magiques', 'Vous découvrez une flaque d\'eau d\'apparence banale, mais ses reflets sont d\'une étrange beauté. Les rayons du soleil se jouent à sa surface, créant des tourbillons de couleurs chatoyantes qui semblent presque hypnotiques. Vous ne pouvez vous empêcher de vous pencher pour contempler ce spectacle fascinant, sentant l\'énergie magique émaner de cet humble point d\'eau.', 'Votre regard est captivé par une simple flaque d\'eau à vos pieds.', 2, 1, 105),
(25, 'Le tronc du vieil arbre mort', 'Un imposant tronc d\'arbre gît au sol, témoignant des âges passés de la forêt. Malgré son apparence décrépite, des lianes grimpantes l\'enlacent avec grâce, formant un motif naturellement sculpté. Des champignons luminescents éclosent sur l\'écorce usée, diffusant une douce lueur dans l\'obscurité environnante. C\'est un lieu empreint de sérénité, où la vie trouve un moyen même dans la mort.', 'Vous avancez vers un imposant tronc d\'arbre couché au sol.', 2, 1, 85),
(26, 'La Clairière Verdoyante', 'Une clairière baignée de lumière dorée se dévoile à travers les branches d\'arbres anciens. Des papillons multicolores virevoltent joyeusement. Une femme se tient debout, une aura apaisante émanant d\'elle.', 'Un papillon volette à vos côtés et vous entraîne.', 3, 1, 69),
(27, 'La Rivière aux Poissons d\'Or', 'La rivière scintille, bordée de nénuphars aux pétales dorés. Les reflets du soleil dansent sur l\'eau calme. Vous distinguez un enfant près de la rive.', 'Vous entendez le bruit mélodieux d\'une petite rivière.', 3, 1, 74),
(28, 'Les Arbres aux Sortilèges', 'Une clairière s\'ouvre devant vous, entourée d\'arbres sans feuilles. Une faible lueur verte vous rassure dans la pénombre.', 'Vous vous enfoncez encore dans la forêt, de plus en plus verte.', 3, 1, 82),
(29, 'L\'Autel de l\'Écorce', 'Un autel en pierre se dresse, orné de motifs représentant des feuilles et des racines entremêlées. Quelqu\'un monte visiblement la garde pour le défendre.', 'Que voyez-vous là-bas ? On dirait un lieu de culte.', 3, 1, 75),
(30, 'Le Chant des Étoiles', 'Cet endroit est illuminé par une lueur céleste. Les arbres scintillants vous font penser aux étoiles d\'un ciel nocturne.', 'La lumière décline pour mieux faire ressortir de vifs points lumineux.', 3, 1, 77),
(31, 'Le Labyrinthe de Maïs', 'Vous arrivez devant une immense structure labyrinthique qu\'il va falloir traverser. Les hautes tiges dorées s\'étendent vers le ciel à perte de vue. Une créature imposante émerge des épis.', 'Vous distinguez comme un fort végétal qui se dresse, non loin.', 3, 1, 78),
(32, 'Soirée Musicale au Feu Follet', 'Les rires qui résonnent sur fond de musique endiablée vous réchauffent l\'âme. L\'atmosphère est festive et chaleureuse. Au centre, mille Feux Follets composent un immense feu de joie.', 'Des accords de guitare vous parviennent. Vous courez pour voir qui joue si divinement bien.', 3, 1, 87),
(33, 'Le Palais du Rire', 'Vous vous aventurez dans une grotte sombre, mais quelque chose attire immédiatement votre attention : chaque paroi est un miroir déformant. L\'atmosphère est déstabilisante et désopilante.', 'Quel est ce bruit ? On dirait une créature magique qui pouffe de rire.', 1, 1, 79),
(34, 'Le Repaire du Loup Solitaire', 'Vous pénétrez dans une caverne sombre, à la lueur des flammes vacillantes. Une atmosphère de mystère et de danger vous entoure. Vous ressentez une présence féroce qui approche.', 'Vous reconnaissez un cri animal. Vous allez voir s\'il n\'est pas blessé.', 1, 1, 81),
(35, 'La Mare Gluante', 'Vous arrivez devant une étendue d\'eau sombre et stagnante, couverte d\'une épaisse couche de mousse. Des bulles inquiétantes émergent de la surface, dans un bruit de succion.', 'Vous remarquez une étrange odeur émanant des alentours.', 1, 1, 71),
(36, 'Le Sentier Vacillant', 'Vous débouchez sur un sentier étroit et sinueux, perché au-dessus d\'un précipice abyssal. Une brume épaisse enveloppe le chemin. Soudain, une silhouette éthérée se matérialise devant vous.', 'Vous choisissez un chemin plus escarpé pour prendre un peu de hauteur.', 1, 1, 84),
(37, 'Les Buissons des Ragots', 'Vous pénétrez dans une clairière ombragée, où les buissons frétillent d\'excitation. Des voix chuchotantes et rieuses s\'échappent des feuillages. Vous apercevez une silhouette gracile parmi les arbustes.', 'Des chuchotis émanent des buissons qui frémissent tout autour de vous.', 1, 1, 83),
(38, 'La Porte des Étoiles', 'Devant vous se dresse une imposante arche de pierre gravée de symboles célestes. Des constellations scintillantes se dessinent au-dessus, formant une porte éthérée vers l\'inconnu.', 'Une vision vous conseille une direction. Vous lui faites confiance.', 1, 1, 72),
(39, 'Le Val de Perte-Voix', 'Vous arrivez dans un vallon encaissé, où les échos résonnent avec une étrange intensité. Vous criez et le vent emporte votre voix dans un tourbillon mélancolique. Une silhouette accourt, avide de vos paroles.', 'Vous descendez plus profondément dans la vallée. L\'acoustique est intense par ici.', 1, 1, 86);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `event_npc`
--

INSERT INTO `event_npc` (`event_id`, `npc_id`) VALUES
(4, 1),
(5, 3),
(6, 2),
(7, 4),
(8, 5),
(9, 10),
(10, 7),
(11, 8),
(12, 9),
(19, 25),
(20, 26),
(21, 27),
(26, 11),
(27, 12),
(28, 13),
(29, 14),
(30, 15),
(31, 16),
(32, 17),
(33, 18),
(34, 19),
(35, 20),
(36, 21),
(37, 22),
(38, 23),
(39, 24);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `event_type`
--

INSERT INTO `event_type` (`id`, `name`) VALUES
(1, 'Combat'),
(2, 'Repos'),
(3, 'Rencontre'),
(4, 'Départ'),
(5, 'Boss'),
(6, 'Fin de Biome'),
(7, 'Endgame'),
(8, 'Death');

-- --------------------------------------------------------



--
-- Déchargement des données de la table `hero`
--

INSERT INTO `hero` (`id`, `name`, `max_health`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`, `progress`, `hero_class_id`, `user_id`, `picture_id`) VALUES
(2, 'Marine du Poney trop Stylé', 100, 100, 100, 150, 100, 100, 10, 0, NULL, 1, 10, 23),
(6, 'Pierre de la Grotte carrelée', 100, 85, 100, 150, 100, 100, 10, 0, NULL, 1, 8, 15),
(7, 'Anthony de la Cave', 100, 80, 100, 150, 100, 100, 10, NULL, NULL, 1, 9, 22),
(8, 'Gauthier le roi des insoumis', 100, 100, 100, 150, 100, 100, 10, NULL, NULL, 1, 12, 26),
(12, 'Testeur', 100, 90, 100, 100, 100, 100, 7, 0, 0, 2, 27, 18),
(13, 'Visiteur', 100, 100, 100, 100, 100, 100, 0, 0, 0, 2, 28, 11),
(14, 'Death', 1, -4, 1, 1, 1, 1, 4, 0, 0, 2, 29, 25),
(19, 'Marine 1659', 100, 100, 100, 100, 100, 100, 1, 0, 0, 2, 34, 18),
(21, 'Test', 100, 80, 100, 100, 100, 100, 3, 0, 0, 2, 36, 18),
(23, 'AnthonyGM', 100, 100, 10, 10, 10, 10, 10, 10, NULL, 1, 37, 22),
(24, 'R4hk4rt', 100, 100, 100, 100, 100, 100, 9, 0, 0, 2, 40, 18),
(25, 'tony', 100, 100, 100, 100, 100, 100, 7, 0, 0, 2, 41, 18);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `hero_class`
--

INSERT INTO `hero_class` (`id`, `name`, `max_health`, `health`, `strength`, `intelligence`, `dexterity`, `defense`) VALUES
(1, 'Super Héro', 100, 100, 100, 150, 100, 100),
(2, 'Héro', 100, 100, 100, 100, 100, 100);

-- --------------------------------------------------------



-- --------------------------------------------------------



--
-- Déchargement des données de la table `hero_item`
--

INSERT INTO `hero_item` (`hero_id`, `item_id`) VALUES
(2, 1),
(6, 1),
(7, 1),
(8, 1),
(23, 1);

-- --------------------------------------------------------



--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `name`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `xp`, `picture_id`) VALUES
(1, 'Epée de guerre', 10, NULL, NULL, NULL, NULL, NULL, NULL, 14);

-- --------------------------------------------------------


-- --------------------------------------------------------



--
-- Déchargement des données de la table `npc`
--

INSERT INTO `npc` (`id`, `name`, `description`, `health`, `strength`, `intelligence`, `dexterity`, `defense`, `karma`, `is_boss`, `hostility`, `xp_earned`, `race_id`, `picture_id`) VALUES
(1, 'Brom la Chasseuse  de Monstres', 'Brom lève sa main gantée vers le ciel et un éclair d\'énergie magique crépite dans sa paume. Les champignons se mettent à briller intensément. Elle se tourne vers vous avec un sourire malicieux.', 100, 100, 100, 100, 100, 100, 0, 0, 0, 1, 17),
(2, 'Eloi le Protecteur des Animaux', 'D\'un pas léger malgré sa carrure imposante, Éloi s\'approche de vous, accompagné d\'une ménagerie d\'animaux. Il tend les bras et un écureuil s\'y précipite alors qu\'il s\'adresse à vous.', 100, 100, 100, 100, 100, 100, 0, 0, 0, 1, 49),
(3, 'Lysandre l\'Érudite', 'Lysandre semble incarner la sagesse et la beauté des temps anciens. Elle s\'approche de vous avec grâce, ses pas résonnant doucement sur les dalles de pierre. Elle brûle de vous poser une question capitale.', 100, 100, 100, 100, 100, 100, 0, 0, 0, 2, 48),
(4, 'Thorgar la Rôdeuse', 'Thorgar dégage une aura féroce et semble évaluer votre potentiel. De terribles loups aux yeux dorés l\'accompagnent. Ils se postent à ses côtés en vous observant.', 100, 100, 100, 100, 100, 100, 0, 1, 0, 1, 47),
(5, 'Les Farfadets Chapardeurs', 'En baissant les yeux vous découvrez les Farfadets Chapardeurs, d\'étranges et espiègles créatures aux yeux malicieux.', 100, 100, 100, 100, 100, 100, 0, 1, 0, 8, 46),
(6, 'Les Gobelins Artificiers', 'Le chef des Gobelins Artificiers se présente devant vous, redoutable inventeur déjanté, maîtrisant l\'art de la magie mécanique et de l\'alchimie déviante.', 100, 100, 100, 100, 100, 100, 0, 1, 200, 3, 45),
(7, 'Le Dragon des Brumes', 'Il se dresse fièrement sur ses pattes griffues, ses ailes déployées, et pousse un hurlement déchirant qui fait vibrer vos os. Sa gueule ne crache pas du feu, mais un nuage de brume toxique.', 100, 100, 100, 100, 100, 100, 1, 1, 0, 14, 44),
(8, 'La Gardienne des Ancêtres', 'Avec étonnement, vous constatez que le dernier grondement provient du ventre de la Gardienne des Ancêtres qui s\'avance vers vous.', 100, 100, 100, 100, 100, 100, 1, 1, 0, 11, 43),
(9, 'La Sorcière de l\'humus', 'Elle s\'avance d\'un pas lent et majestueux, exsudant une aura de pouvoir corrompu. Son rire vous fait frissonner jusqu\'à la moelle.', 100, 100, 100, 100, 100, 100, 1, 1, 0, 7, 42),
(10, 'Arachnus Maximus', 'L\'imposant Arachnus Maximus émerge des ombres, le corps couvert de poils noirs et brillants. Ses pattes se terminent en griffes acérées.', 100, 100, 100, 100, 100, 100, 0, 1, 100, 10, 41),
(11, 'Elara la Prêtrese Sylvestre', 'Elara est une prêtresse douce et bienveillante, vêtue d\'une robe blanche ornée de feuilles et de fleurs. Ses yeux reflètent la sagesse des anciens esprits.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 91),
(12, 'Lumi le Petit Pêcheur', 'Lumi est un garçon vif et curieux au visage constellé de taches de rousseur. Il tient une canne à pêche miniature dans ses mains.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 99),
(13, 'Ivy, votre Sorcière Bien Aimée', 'La lumière provient de la main de cette petite sorcière. Elle est verte, tout comme sa peau claire et ses deux longues tresses.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 7, 95),
(14, 'Bryn, le Chevalier Feuillu', 'Bryn est une force tranquille. Son armure végétale se fond si bien dans le paysage que vous avez failli le rater.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 5, 89),
(15, 'Seraphina, la Dryade Astrale', 'Seraphina apparaît devant vous. Vous mettez la main en visière, légèrement ébloui.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 5, 104),
(16, 'Pop-Cornes le Minotaure', 'Son corps massif et sa crinière touffue vous impressionnent. Il a l\'air affamé et les gargouillis de son ventre font vibrer la terre sous vos pieds.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 16, 102),
(17, 'Remy le Barde', 'Au centre du groupe, vous repérez immédiatement le barde, sa guitare acoustique à la main. Il a des cheveux magnifiques et respire la confiance et la séduction.', 100, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 103),
(18, 'Farcey Atrap, un Lutin Plaisantin', 'Farcey Atrap observe les miroirs avec amusement et applaudit, ravi de son effet ! Il a les gestes vifs et agiles d\'un prestidigitateur...', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 13, 92),
(19, 'Griflamme l\'Impétueux', 'Un loup aux yeux perçants surgit des ténèbres. Son allure majestueuse dégage une aura effrayante et fascinante. Sa voix rauque résonne dans l\'air glacial.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 1, 94),
(20, 'Gobul, Reine des Sangsues', 'Une créature à la peau visqueuse sort lentement de l\'eau. Des sangsues géantes se tortillent sur son corps. Elle vous regarde avec un sourire malsain.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 16, 93),
(21, 'Ombrethorn, le Fantôme Sylvestre', 'Ombrethorn flotte dans les airs, son corps translucide se mêlant à la brume environnante. Autour de lui, des feux follets dansent mystérieusement.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 11, 101),
(22, 'Discordia la Dryade', 'Le sourire malicieux et le regard pétillant de Discordia trahissent sa nature facétieuse. Autour d\'elle, les animaux de la forêt semblent se divertir en reprenant les ragots qu\'elle colporte.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 5, 90),
(23, 'Jerarmajax, le Maître des Illusions', 'Les vêtements chatoyants du magicien reflètent la lueur astrale. Il semble capable de manipuler les étoiles elles-mêmes pour créer des mirages troublants.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 1, 96),
(24, 'Lilith, la Voleuse d\'Écho', 'Lilith apparaît, aérienne. Ses lèvres ne bougent pas et pourtant, autour d\'elle, des ombres mélodieuses semblent déverser des mots volés que vous peinez à comprendre.', 100, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 11, 98),
(25, 'Le Petit Chaperon Rouge-Sang', 'Elle est vêtue d\'une cape écarlate et son visage est dissimulé par le capuchon, dévoilant uniquement son regard surnaturel. Sa démarche est à la fois gracieuse et dérangeante, comme si la Grande Faucheuse elle-même avait pris forme dans ce personnage envoûtant. Ses doigts crochus se crispent sur l\'anse de son panier macabre.', 100, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 11, 97),
(26, 'Maître Corbeau', 'Soudain, un craquement retentit et le Maître Corbeau se révèle, son regard trahissant une intelligence maligne. Sa voix s\'élève, teintée d\'une ironie mordante, alors qu\'il se prépare à défendre son royaume de votre dérangeante présence.', 100, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 10, 100),
(27, 'Aria la Biche Blessée', 'La Biche Blessée avance vers vous en quelques bonds étranges, sa silhouette déformée par la souffrance et la rage. Ses yeux autrefois doux sont maintenant injectés de sang, et ses bois déchiquetés semblent prêts à transpercer quiconque ose s\'approcher. Des cicatrices béantes marquent son pelage délavé.', 100, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 10, 88);

-- --------------------------------------------------------


-- --------------------------------------------------------



--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `name`, `base64`, `path`) VALUES
(11, 'Visitor', '/tmp/phpiBtnmo', 'images/visitor.png'),
(12, 'Pierre User Avatar', '/tmp/phpRbb97m', 'images/user-pierre.png'),
(14, 'Sword Left', '/tmp/phpDdsQwn', 'images/sword-left.png'),
(15, 'Pierre Hero Avatar', '/tmp/phpmjiZHp', 'images/hero-pierre.png'),
(16, 'Arche de Verdure', '/tmp/php5bCNlj', 'images/arche-de-Verdure.png'),
(17, 'Brom la Chasseuse de Monstres', '/tmp/php6cIXHk', 'images/brom-la-Chasseuse-de-Monstres.webp'),
(18, 'Default Hero Avatar', '/tmp/phpgDWvIm', 'images/default-hero-avatar.png'),
(19, 'Back Office Accueil', '/tmp/phpAiNN0Z', 'images/back-office-Accueil.png'),
(20, 'Back Office Cave', '/tmp/phpQkvFJZ', 'images/back-office-cave.png'),
(21, 'Back Office Grotte', '/tmp/phpo5cXgZ', 'images/back-office-grotte.png'),
(22, 'Antho Avatar', '/tmp/php51gYhZ', 'images/avatar7.png'),
(23, 'Marine Avatar', '/tmp/phpjFdYVY', 'images/My-Little-Pony-Rarity-PNG-Clipart.png'),
(25, 'Avatar Death', '/tmp/phpDwSK2W', 'images/avatar5.png'),
(26, 'Gauthier Avatar', '/tmp/phpOuepWY', 'images/avatar2.png'),
(27, 'Les Ruines Perdues', '/tmp/phprKJ0fX', 'images/Les Ruines-Perdues.png'),
(28, 'Game Over', '/tmp/phpuWQj1W', 'images/Game Over.webp'),
(29, 'Victoire !', '/tmp/phpjHiH9X', 'images/Victoire !.webp'),
(30, 'Victoire forêt', '/tmp/phpHJGhNX', 'images/Victoire forêt.jpg'),
(31, 'Les racines éternelles', '/tmp/php1LbyuX', 'images/Les racines éternelles.png'),
(32, 'La Sombre Grotte', '/tmp/phptHjrtZ', 'images/La Sombre Grotte.png'),
(33, 'L\'étang aux Lueurs Spectrales', '/tmp/phpweShVX', 'images/L\'étang aux Lueurs Spectrales.png'),
(34, 'Le Bosquet des Araignées Tisseuses', '/tmp/phpiEFydY', 'images/Le Bosquet des Araignées Tisseuses.png'),
(35, 'La Ravine des Soupirs', '/tmp/phpKPXxz0', 'images/La Ravine des Soupirs.png'),
(36, 'Le Sanctuaire des Anciens', '/tmp/phpfe1jSY', 'images/Le Sanctuaire des Anciens.png'),
(37, 'La Clairière des Runes', '/tmp/phpA323UX', 'images/La Clairière des Runes.png'),
(38, 'Le Cercle des Champignons', '/tmp/phpRIVNFW', 'images/Le-Cercle-des-Champignons.png'),
(39, 'Le Chemin du Murmure', '/tmp/phpyUFSIZ', 'images/Le-Chemin-du-Murmure.png'),
(40, 'Les Chutes Argentées', '/tmp/php7r6aZZ', 'images/Les-Chutes-Argentées.png'),
(41, 'Arachnus Maximus', '/tmp/phpZTY6wZ', 'images/Arachnus-Maximus.webp'),
(42, 'La Sorcière de l\'humus', '/tmp/php71JuNW', 'images/La-Sorciere-de-l-humus.png'),
(43, 'La Gardienne des Ancêtres', '/tmp/phpgpb0aZ', 'images/La-Gardienne-des-Ancêtres.png'),
(44, 'Le Dragon des Brumes', '/tmp/phpRoCeIX', 'images/Le-Dragon-des-Brumes.png'),
(45, 'Les Gobelins Artificiers', '/tmp/phpjYdBYZ', 'images/Les-Gobelins-Artificiers.png'),
(46, 'Les Farfadets Chapardeurs', '/tmp/php6w46vZ', 'images/Les-Farfadets-Chapardeurs.webp'),
(47, 'Thorgar la Rodeuse', '/tmp/phpZxPOg0', 'images/Thorgar-la-rodeuse.png'),
(48, 'Lysandre l\'érudite', '/tmp/phpSH77wZ', 'images/Lysandre-l-erudite.png'),
(49, 'Eloi le protecteur des animaux', '/tmp/phpWQUyxX', 'images/Eloi-le -protecteur-des-animaux.webp'),
(68, 'La Branche Crochue', '/tmp/phpKWLnwf', 'images/La Branche Crochue.png'),
(69, 'La Clairière Verdoyante', '/tmp/phpDgOeti', 'images/La Clairière Verdoyante.png'),
(70, 'L_Allée de l_Absence Tourmentée', '/tmp/phpgb3X4g', 'images/L_Allée de l_Absence Tourmentée.png'),
(71, 'La Mare Gluante', '/tmp/phpiila7d', 'images/La Mare Gluante.png'),
(72, 'La Porte des Etoiles', '/tmp/phpWvNCog', 'images/La Porte des Etoiles.png'),
(73, 'La Rencontre Ecarlate', '/tmp/phpGeyIvi', 'images/La Rencontre Ecarlate.png'),
(74, 'La Rivière aux Poissons d_Or', '/tmp/phpzheBif', 'images/La Rivière aux Poissons d_Or.png'),
(75, 'L_Autel de l_Ecorce', '/tmp/phpmjna1h', 'images/L_Autel de l_Ecorce.png'),
(76, 'Le Champ de Fleurs Sauvages', '/tmp/phpWEFRDg', 'images/Le Champ de Fleurs Sauvages.png'),
(77, 'Le Chant des Etoiles', '/tmp/phpnrIvff', 'images/Le Chant des Etoiles.png'),
(78, 'Le Labyrinthe de Mais', '/tmp/phpl437lf', 'images/Le Labyrinthe de Mais.png'),
(79, 'Le Palais du Rire', '/tmp/phppTArrf', 'images/Le Palais du Rire.png'),
(80, 'Le Petit Pont de Bois', '/tmp/phpdUHm1f', 'images/Le Petit Pont de Bois.png'),
(81, 'Le Repaire du Loup Solitaire', '/tmp/phpNwf0ai', 'images/Le Repaire du Loup Solitaire.png'),
(82, 'Les Arbres aux Sortilèges', '/tmp/phpH1FNpi', 'images/Les Arbres aux Sortilèges.png'),
(83, 'Les Buissons des Ragots', '/tmp/phpfxVoQh', 'images/Les Buissons des Ragots.png'),
(84, 'Le Sentier Vacillant', '/tmp/phpR4dRch', 'images/Le Sentier Vacillant.png'),
(85, 'Le Tronc du Vieil Arbre Mort', '/tmp/phpO0y0Ef', 'images/Le Tronc du Vieil Arbre Mort.png'),
(86, 'Le Val de Perte Voix', '/tmp/phpca3L7e', 'images/Le Val de Perte Voix.png'),
(87, 'Soirée-Musicale-au-Feu-Follet', '/tmp/php9batag', 'images/Soirée-Musicale-au-Feu-Follet.png'),
(88, 'Aria-La-Biche-Blessee', '/tmp/phpS7BcNf', 'images/Aria-La-Biche-Blessee.png'),
(89, 'Bryn le Chevalier Feuillu', '/tmp/phpV3QPig', 'images/Bryn le Chevalier Feuillu.png'),
(90, 'Discordia la Dryade', '/tmp/phpiUqWFg', 'images/Discordia la Dryade.png'),
(91, 'Elara la Pretresse Sylvestre', '/tmp/phpfyjSmf', 'images/Elara la Pretresse Sylvestre.png'),
(92, 'Farcey Atrap un Lutin Plaisantin', '/tmp/phpLpxPig', 'images/Farcey Atrap un Lutin Plaisantin.png'),
(93, 'Gobul Reine des Sangsues', '/tmp/php6pGNif', 'images/Gobul Reine des Sangsues.png'),
(94, 'Griflamme l Impetueux', '/tmp/phpyJ8YYf', 'images/Griflamme l Impetueux.png'),
(95, 'Ivy Votre Sociere Bien Aimee', '/tmp/phpBeXb6g', 'images/Ivy Votre Sociere Bien Aimee.png'),
(96, 'Jerarmajax le Maitre des Illusions', '/tmp/phpf4MNkg', 'images/Jerarmajax le Maitre des Illusions.png'),
(97, 'Le petit chaperon rouge sang', '/tmp/phpChq18f', 'images/Le petit chaperon rouge sang.png'),
(98, 'Lilith la Voleuse d Echo', '/tmp/phpzBtijf', 'images/Lilith la Voleuse d Echo.png'),
(99, 'Lumi Le Petit Pecheur', '/tmp/phpZoRQfg', 'images/Lumi Le Petit Pecheur.png'),
(100, 'Maitre Corbeau', '/tmp/phpBI549e', 'images/Maitre Corbeau.png'),
(101, 'Ombrethorn le Fantome Sylvestre', '/tmp/php2ihxoh', 'images/Ombrethorn le Fantome Sylvestre.png'),
(102, 'PopCornes le Minotaure', '/tmp/phpf9UTlf', 'images/PopCornes le Minotaure.png'),
(103, 'Remy le Barde', '/tmp/phpdRNKjh', 'images/Remy le Barde.png'),
(104, 'Seraphina la Dryade Astrale', '/tmp/phpbB55Ve', 'images/Seraphina la Dryade Astrale.png'),
(105, 'La-flaque-aux-reflets-magiques', '/tmp/php7YSoQe', 'images/La-flaque-aux-reflets-magiques.png'),
(106, 'Game-over', '/tmp/phpbmKWVd', 'images/Game-over.png'),
(107, 'Victory', '/tmp/phpGoZnzK', 'images/Victory.png'),
(108, 'sword-favicon', '/tmp/phpOTJnRG', 'images/sword-favicon.png'),
(109, 'forrestInFire', '/tmp/php9KS1mI', 'images/forrestInFire.jpg');

-- --------------------------------------------------------



--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id`, `name`, `description`) VALUES
(1, 'Humain', NULL),
(2, 'Elfe', NULL),
(3, 'Gobelin', NULL),
(4, 'Fée', NULL),
(5, 'Dryade', NULL),
(6, 'Nain', NULL),
(7, 'Sorcière', NULL),
(8, 'Farfadet', NULL),
(9, 'Troll', NULL),
(10, 'Animal', NULL),
(11, 'Esprit', NULL),
(12, 'Végétal', NULL),
(13, 'Lutin', NULL),
(14, 'Dragon', NULL),
(15, 'Golem', NULL),
(16, 'Monstre', NULL);

-- --------------------------------------------------------



-- --------------------------------------------------------



--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar_id`) VALUES
(8, 'pierre@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$Hn1Ez2B8PPK4KUBCixF7vOFGl7KMA3fxYiyh7RyXGR6dVL41uFhVe', 'Pierre', 12),
(9, 'anthony.boutherin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$Vv7C1TVSnjJ7eFY/focabunNAX637Rp.kVZGjHZ2jwz8ZeVAVSxWi', 'Anthony', 22),
(10, 'marine@gameMaster.com', '{\"1\":\"ROLE_PLAYER\",\"0\":\"ROLE_ADMIN\"}', '$2y$13$xxiccPL92ugROWLiCaQpruHZj1yADynLOCNGGOZCAF67.5QScUD5q', 'Marine', 23),
(12, 'gauthier.laplace@gmail.com', '{\"1\":\"ROLE_PLAYER\",\"2\":\"ROLE_ADMIN\"}', '$2y$13$S.Y/Bc.y7dKlL5nfR.Ioue3Adg/ZpvJHgDGJ.Pd1DhgDNYjv83n6y', 'Gauthier', 26),
(27, 'player@player.com', '[\"ROLE_PLAYER\"]', '$2y$13$8Iq54Nr6N4a3QZq5SWuE7ejsZROkF5bWIXBg3gqC4rf7uvsqx63TO', 'Testeur', 18),
(28, 'visitor@visitor.com', '[\"ROLE_PLAYER\",\"ROLE_VISITOR\"]', '$2y$13$mrqRRap9c.x7i1SKQEkLEenFhKbefXOTmBCGg2YrvRL455atnIL6K', 'Visiteur', 11),
(29, 'death@death.com', '[\"ROLE_PLAYER\"]', '$2y$13$fM5yIkvQrjNPjT/Rpw.0XejsX36aHohJMvxFsYCC9bqEPnIyb8jaW', 'Death', 25),
(34, 'marine1659@gmail.com', '[\"ROLE_PLAYER\"]', '$2y$13$7hr7M56yNCpvTGIXbM6D5.9RfrK/lplpgHlUj/KHjueOajxgOlvAG', 'Marine 1659', 18),
(36, 'test@test.fr', '[\"ROLE_PLAYER\"]', '$2y$13$YKEvE4Hc1n5kALg7SS8yvO50SLjDnLL5h66lUh9prqbeBi8Sdx.RW', 'Test', 18),
(37, 'anthonyGM@gamemaster.com', '[\"ROLE_PLAYER\",\"ROLE_GAMEMASTER\"]', '$2y$13$QHFLCMZQYBbua3kLq/s2Pe4U.AYk2rV9khk2OHJfsuibax4TSMAfq', 'Game Master', 25),
(39, 'marine@marine.com', '[\"ROLE_PLAYER\",\"ROLE_GAMEMASTER\"]', '$2y$13$sV9TCM1NlJ8WOlqnIWboTeBM8bbvcux84by1ubx0PcbhaHO55eWwO', 'Marine', 18),
(40, 'R4hk4rt@gmail.com', '[\"ROLE_PLAYER\"]', '$2y$13$yLGWkCjg1NtIxwVHeOmsGurPd99pFjEEDh9EdjjvJKn0pqMl.pEGu', 'R4hk4rt', 18),
(41, 'tony@tony.com', '[\"ROLE_PLAYER\"]', '$2y$13$Ap0XrOAzaYkE6FCDkYC4kO08F0FyRMX4N0ii5NGvxjIA.j4BRGt7u', 'tony', 18),
(42, 'pierre_0613@hotmail.fr', '[\"ROLE_PLAYER\",\"ROLE_ADMIN\",\"ROLE_GAMEMASTER\",\"ROLE_VISITOR\"]', '$2y$13$DhnH3RyQ4ORuoM3lt3Svm..GlxrS04LGs0T37Mfv0I07iTkM/LW.q', 'Pierre', 109);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DADD4A25A6E12CBD` (`dialogue_id`);

--
-- Index pour la table `answer_effect`
--
ALTER TABLE `answer_effect`
  ADD PRIMARY KEY (`answer_id`,`effect_id`),
  ADD KEY `IDX_4499AB55AA334807` (`answer_id`),
  ADD KEY `IDX_4499AB55F5E9B83B` (`effect_id`);

--
-- Index pour la table `biome`
--
ALTER TABLE `biome`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dialogue`
--
ALTER TABLE `dialogue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F18A1C39CA7D6B89` (`npc_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `effect`
--
ALTER TABLE `effect`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ending`
--
ALTER TABLE `ending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1413D44F71F7E88B` (`event_id`),
  ADD KEY `IDX_1413D44F401B253C` (`event_type_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3BAE0AA7EE45BDBF` (`picture_id`),
  ADD KEY `IDX_3BAE0AA7401B253C` (`event_type_id`),
  ADD KEY `IDX_3BAE0AA7E43A64F9` (`biome_id`);

--
-- Index pour la table `event_npc`
--
ALTER TABLE `event_npc`
  ADD PRIMARY KEY (`event_id`,`npc_id`),
  ADD KEY `IDX_5743B3FF71F7E88B` (`event_id`),
  ADD KEY `IDX_5743B3FFCA7D6B89` (`npc_id`);

--
-- Index pour la table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_51CE6E864F1EBAB8` (`hero_class_id`),
  ADD KEY `IDX_51CE6E86A76ED395` (`user_id`),
  ADD KEY `IDX_51CE6E86EE45BDBF` (`picture_id`);

--
-- Index pour la table `hero_class`
--
ALTER TABLE `hero_class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hero_event`
--
ALTER TABLE `hero_event`
  ADD PRIMARY KEY (`hero_id`,`event_id`),
  ADD KEY `IDX_A491056045B0BCD` (`hero_id`),
  ADD KEY `IDX_A491056071F7E88B` (`event_id`);

--
-- Index pour la table `hero_item`
--
ALTER TABLE `hero_item`
  ADD PRIMARY KEY (`hero_id`,`item_id`),
  ADD KEY `IDX_9FF0475845B0BCD` (`hero_id`),
  ADD KEY `IDX_9FF04758126F525E` (`item_id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1F1B251EEE45BDBF` (`picture_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `npc`
--
ALTER TABLE `npc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_468C762CEE45BDBF` (`picture_id`),
  ADD KEY `IDX_468C762C6E59D40D` (`race_id`);

--
-- Index pour la table `npc_item`
--
ALTER TABLE `npc_item`
  ADD PRIMARY KEY (`npc_id`,`item_id`),
  ADD KEY `IDX_46576227CA7D6B89` (`npc_id`),
  ADD KEY `IDX_46576227126F525E` (`item_id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_16DB4F895E237E06` (`name`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C6A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64986383B10` (`avatar_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `biome`
--
ALTER TABLE `biome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `dialogue`
--
ALTER TABLE `dialogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `effect`
--
ALTER TABLE `effect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `ending`
--
ALTER TABLE `ending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `hero_class`
--
ALTER TABLE `hero_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `npc`
--
ALTER TABLE `npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_DADD4A25A6E12CBD` FOREIGN KEY (`dialogue_id`) REFERENCES `dialogue` (`id`);

--
-- Contraintes pour la table `answer_effect`
--
ALTER TABLE `answer_effect`
  ADD CONSTRAINT `FK_4499AB55AA334807` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4499AB55F5E9B83B` FOREIGN KEY (`effect_id`) REFERENCES `effect` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dialogue`
--
ALTER TABLE `dialogue`
  ADD CONSTRAINT `FK_F18A1C39CA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`);

--
-- Contraintes pour la table `ending`
--
ALTER TABLE `ending`
  ADD CONSTRAINT `FK_1413D44F401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `FK_1413D44F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7E43A64F9` FOREIGN KEY (`biome_id`) REFERENCES `biome` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`);

--
-- Contraintes pour la table `event_npc`
--
ALTER TABLE `event_npc`
  ADD CONSTRAINT `FK_5743B3FF71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5743B3FFCA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `hero`
--
ALTER TABLE `hero`
  ADD CONSTRAINT `FK_51CE6E864F1EBAB8` FOREIGN KEY (`hero_class_id`) REFERENCES `hero_class` (`id`),
  ADD CONSTRAINT `FK_51CE6E86A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_51CE6E86EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`);

--
-- Contraintes pour la table `hero_event`
--
ALTER TABLE `hero_event`
  ADD CONSTRAINT `FK_A491056045B0BCD` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A491056071F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `hero_item`
--
ALTER TABLE `hero_item`
  ADD CONSTRAINT `FK_9FF04758126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9FF0475845B0BCD` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251EEE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`);

--
-- Contraintes pour la table `npc`
--
ALTER TABLE `npc`
  ADD CONSTRAINT `FK_468C762C6E59D40D` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  ADD CONSTRAINT `FK_468C762CEE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`);

--
-- Contraintes pour la table `npc_item`
--
ALTER TABLE `npc_item`
  ADD CONSTRAINT `FK_46576227126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_46576227CA7D6B89` FOREIGN KEY (`npc_id`) REFERENCES `npc` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64986383B10` FOREIGN KEY (`avatar_id`) REFERENCES `picture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
