# Dictionnaire de données

## Utilisateur (user)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'user|
|email|VARCHAR(255)|NOT NULL|Email de l'utilisateur|
|password|VARCHAR(255)|NOT NULL|Mot de passe|
|roles|LONGTEXT|NOT NULL|Droits|
|pseudo|VARCHAR(64)|NOT NULL|Nom de joueur|
|avatar|entity|NULL|Jointure (picture)|

## Avis (review)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'avis|
|title|VARCHAR(128)|NOT NULL|Titre de l'avis|
|content|LONGTEXT|NOT NULL|Contenu de l'avis|
|rating|DOUBLE|NULL|Avis (0 à 5)|
|created_at|DATETIME|NOT NULL, DEFAULT CURRENT_TIMESTAMP|Date de création de l'avis|
|updated_at|DATETIME|NULL|Date de modification de l'avis|
|user|entity|NOT NULL|Jointure|

## Joueur (hero)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du joueur|
|name|VARCHAR(255)|NOT NULL|Nom du joueur|
|max_health|INT|NOT NULL|Santé max du joueur|
|health|INT|NOT NULL|Santé du joueur|
|strength|INT|NULL|Force|
|intelligence|INT|NULL|Intelligence|
|dexterity|INT|NULL|Dextérité|
|defense|INT|NULL|Défence|
|karma|INT|NULL|Taux de chance|
|xp|INT|NULL|Expérience|
|progress|INT|NULL|Sauvegarde|
|played_event|LONGTEXT|NULL|Tableau d'event Id|
|hero_class|entity|NOT NULL|Jointure|
|user|entity|NOT NULL|Jointure|
|picture|entity|NULL|Jointure|
|fight|entity|NULL|Jointure|

## Classe de joueur (hero_class)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de la classe du joueur|
|name|VARCHAR(255)|NOT NULL|Nom de la classe|
|max_health|INT|NOT NULL|Santé max|
|health|INT|NOT NULL|Santé|
|strength|INT|NULL|Force|
|intelligence|INT|NULL|Intelligence|
|dexterity|INT|NULL|Dextérité|
|defense|INT|NULL|Défence|

## Evenement (event)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'evenement|
|title|VARCHAR(255)|NOT NULL|Titre de l'evenement|
|description|LONGTEXT|NULL|Description de l'evenement|
|opening|LONGTEXT|NULL|Entrée en scène|
|event_type|entity|NOT NULL|Jointure|
|biome|entity|NOT NULL|Jointure|
|picture|entity|NULL|Jointure|

## Theme (biome)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du theme|
|name|VARCHAR(255)|NOT NULL|Nom du thème|
|difficulty|INT|NOT NULL|Difficulté du Biome|

## Type d'evenement (event_type)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du type d'evenement|
|name|VARCHAR(255)|NOT NULL|Nom du type d'evenement|

## Fin d'event (ending)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du choix|
|content|LONGTEXT|NOT NULL|Contenu du choix|
|event|entity|NOT NULL|Jointure|
|event_type|entity|NOT NULL|Jointure|

## Personnage non joueur (npc)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du personnage non joueur|
|name|VARCHAR(255)|NOT NULL|Nom du personnage|
|description|LONGTEXT|NULL|Description du personnage|
|max_health|INT|NULL|Santé max du personnage|
|health|INT|NOT NULL|Santé|
|strength|INT|NULL|Force|
|intelligence|INT|NULL|Intelligence|
|dexterity|INT|NULL|Dextérité|
|defense|INT|NULL|Défence|
|karma|INT|NULL|Taux de chance|
|is_boss|TINYINT(1)|NOT NULL|Boss = 1, Normal=0|
|hostility|TINYINT(1)|NOT NULL|Hostile = 1, Amical = 0|
|xp_earned|INT|NULL|Donne de l'expérience au joueur en fonction des actions|
|race|entity|NOT NULL|Jointure|
|picture|entity|NULL|Jointure|

## Race (race)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de la race|
|name|VARCHAR(255)|NOT NULL|Nom de la race|
|description|LONGTEXT|NULL|Description de la race|

## Dialogue (dialogue)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du dialogue|
|content|LONGTEXT|NOT NULL|Contenu du dialogue|
|npc|entity|NOT NULL|Jointure|

## Réponse (answer)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de la reponse|
|content|LONGTEXT|NOT NULL|Contenu de la réponse|
|dialogue|entity|NOT NULL|Jointure|

## Effets (effect)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'effet|
|name|VARCHAR(255)|NOT NULL|Nom de l'effet|
|description|LONGTEXT|NULL|Description de l'effet|
|health|INT|NULL|Bonus-Malus de Santé|
|strength|INT|NULL|Bonus-Malus de Force|
|intelligence|INT|NULL|Bonus-Malus d'intelligence|
|dexterity|INT|NULL|Bonus-Malus de Dextérité|
|defense|INT|NULL|Bonus-Malus de Défence|
|karma|INT|NULL|Bonus-Malus du taux de chance|
|xp|INT|NULL|Bonus-Malus d'expérience|

## Objets (item)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'objet|
|name|VARCHAR(255)|NOT NULL|Nom de l'objet|
|health|INT|NULL|Bonus-Malus de Santé|
|strength|INT|NULL|Bonus-Malus de Force|
|intelligence|INT|NULL|Bonus-Malus d'intelligence|
|dexterity|INT|NULL|Bonus-Malus de Dextérité|
|defense|INT|NULL|Bonus-Malus de Défence|
|karma|INT|NULL|Bonus-Malus du taux de chance|
|xp|INT|NULL|Bonus-Malus d'expérience|
|usable|TINYINT(1)|NULL|Utilisable : Oui = 1, Non = 0|
|picture|entity|NULL|Jointure|

## Images (picture)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant de l'image|
|name|VARCHAR(255)|NOT NULL|Nom de l'image|
|base64|LONGTEXT|NOT NULL|Encodage des données binaires en format texte|
|path|VARCHAR(255)|NOT NULL|Chemin de l'image|

## Combat (fight)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Identifiant du personnage non joueur|
|name|VARCHAR(255)|NOT NULL|Nom du personnage|
|description|LONGTEXT|NULL|Description du personnage|
|max_health|INT|NULL|Santé max du personnage|
|health|INT|NOT NULL|Santé|
|strength|INT|NULL|Force|
|intelligence|INT|NULL|Intelligence|
|dexterity|INT|NULL|Dextérité|
|defense|INT|NULL|Défence|
|karma|INT|NULL|Taux de chance|
|is_boss|TINYINT(1)|NOT NULL|Boss = 1, Normal=0|
|hostility|TINYINT(1)|NOT NULL|Hostile = 1, Amical = 0|
|xp_earned|INT|NULL|Donne de l'expérience au joueur en fonction des actions|
|item|INT|NULL|Id de l'objet pris dans la pool d'objet du npc|
