-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 mai 2026 à 08:51
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web_quizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `catégorie`
--

CREATE TABLE `catégorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `catégorie`
--

INSERT INTO `catégorie` (`id`, `nom`, `description`) VALUES
(1, 'HTTP/CSS', 'Voici votre QCM de HTML/CSS');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `reponse1` varchar(50) NOT NULL,
  `reponse2` varchar(50) NOT NULL,
  `reponse3` varchar(50) NOT NULL,
  `reponse4` varchar(50) NOT NULL,
  `bonne_reponse` int(11) NOT NULL,
  `catégorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `bonne_reponse`, `catégorie`) VALUES
(1, 'Quelle propriété CSS permet de changer la couleur de fond d un élément ?', 'color', 'background-color', 'border-color', 'font-weight', 2, 1),
(2, 'Que signifie l\'acronyme HTML ?', 'Hyper Text Markup Language', 'Hyper Tech Modern Language', 'Hyper Text Mobile Links', 'High Text Markup Language', 1, 1),
(3, 'Quelle balise est utilisée pour créer un lien hypertexte ?', '<link>', '<a>', '<href>', '<url>', 2, 1),
(4, 'Quelle propriété CSS est utilisée pour mettre le texte en gras ?', 'font-style', 'text-weight', 'font-weight', 'bold', 3, 1),
(5, 'Comment insère-t-on un commentaire en HTML ?', '// commentaire', '/* commentaire */', '', '<-- commentaire -->', 3, 1),
(6, 'Quel sélecteur CSS permet de cibler un élément avec un identifiant (ID) spécifique ?', '.', '#', '*', '@', 2, 1),
(7, 'Quelle balise HTML est utilisée pour définir un titre de niveau le plus important ?', '<head>', '<h6>', '<header>', '<h1>', 4, 1),
(8, 'Quelle propriété CSS permet de changer la police de caractère ?', 'font-family', 'text-style', 'font-type', 'character-design', 1, 1),
(9, 'Comment appelle-t-on le modèle de boîte en CSS qui inclut les bordures et le padding ?', 'Border-box', 'Flex-box', 'Content-box', 'Grid-box', 1, 1),
(10, 'Quelle balise HTML est utilisée pour créer une liste non-ordonnée (avec des puces) ?', '<ol>', '<li>', '<ul>', '<list>', 3, 1),
(11, 'En CSS, quelle unité est relative à la taille de la police de l\'élément parent ?', 'px', 'em', 'rem', 'vh', 2, 1),
(12, 'Quel attribut HTML permet d\'ouvrir un lien dans un nouvel onglet ?', 'target=\"_blank\"', 'rel=\"new\"', 'window=\"open\"', 'href=\"new\"', 1, 1),
(13, 'Quelle propriété CSS permet d\'ajouter de l\'espace à l\'intérieur d\'un élément, entre le contenu et la bordure ?', 'margin', 'spacing', 'gap', 'padding', 4, 1),
(14, 'Quelle balise est utilisée pour insérer une image ?', '<picture>', '<src>', '<img>', '<image>', 3, 1),
(15, 'Quelle valeur de la propriété \"display\" permet de masquer un élément sans laisser d\'espace ?', 'hidden', 'none', 'invisible', 'collapse', 2, 1),
(16, 'Comment lie-t-on un fichier CSS externe à un document HTML ?', '<style src=\"style.css\">', '<link rel=\"stylesheet\" href=\"style.css\">', '<script href=\"style.css\">', '<css link=\"style.css\">', 2, 1),
(17, 'Quelle propriété CSS permet d\'arrondir les coins d\'un élément ?', 'border-radius', 'corner-style', 'border-curve', 'box-round', 1, 1),
(18, 'Quel est l\'ordre correct des marges dans la notation courte : margin: 10px 20px 30px 40px; ?', 'Haut, Bas, Gauche, Droite', 'Haut, Droite, Bas, Gauche', 'Gauche, Droite, Haut, Bas', 'Bas, Haut, Gauche, Droite', 2, 1),
(19, 'Quelle balise HTML contient les métadonnées d\'une page (titre, encodage) ?', '<body>', '<header>', '<section>', '<head>', 4, 1),
(20, 'En CSS, comment cible-t-on tous les éléments <p> situés à l\'intérieur d\'une <div> ?', 'div + p', 'div > p', 'div p', 'div.p', 3, 1),
(21, 'Quelle propriété CSS est utilisée pour aligner du texte au centre ?', 'align-items: center', 'text-align: center', 'justify-content: center', 'text-middle', 2, 1),
(22, 'Quel attribut HTML définit le texte alternatif pour une image ?', 'title', 'desc', 'caption', 'alt', 4, 1),
(23, 'Quelle propriété CSS permet de changer l\'ordre d\'empilement des éléments (profondeur) ?', 'z-index', 'layer-index', 'stack-order', 'float', 1, 1),
(24, 'Quelle balise HTML est utilisée pour créer un tableau ?', '<tab>', '<table>', '<grid>', '<board>', 2, 1),
(25, 'Quelle propriété CSS permet de transformer le texte en majuscules ?', 'text-style: uppercase', 'font-variant: capital', 'text-transform: uppercase', 'text-format: caps', 3, 1),
(26, 'Comment déclarer une variable locale dont la portée est limitée au bloc actuel ?', 'var', 'let', 'global', 'set', 2, 2),
(27, 'Quelle méthode permet d\'ajouter un élément au début d\'un tableau ?', 'push()', 'shift()', 'unshift()', 'append()', 3, 2),
(28, 'Quel opérateur est utilisé pour l\'exponentiation (puissance) ?', '^', 'exp', '**', 'pow', 3, 2),
(29, 'Comment écrit-on \"pas égal en valeur ou en type\" ?', '!=', '!==', '<>', 'not equal', 2, 2),
(30, 'Quelle fonction permet d\'exécuter du code à intervalles réguliers ?', 'setTimeout()', 'setInterval()', 'wait()', 'repeat()', 2, 2),
(31, 'Que retourne \"typeof [1, 2, 3]\" ?', 'array', 'list', 'object', 'undefined', 3, 2),
(32, 'Comment arrondir 4.7 à l\'entier le plus proche (5) ?', 'Math.floor(4.7)', 'Math.ceil(4.7)', 'Math.round(4.7)', 'Math.int(4.7)', 3, 2),
(33, 'Quel mot-clé permet d\'arrêter l\'itération actuelle d\'une boucle et de passer à la suivante ?', 'break', 'stop', 'next', 'continue', 4, 2),
(34, 'Comment transformer une chaîne en minuscules ?', 'toLowerCase()', 'lower()', 'min()', 'caseSmall()', 1, 2),
(35, 'Quel symbole entoure les littéraux de gabarits (template literals) pour l\'interpolation ?', '\"', '\"', '` (backtick)', '{ }', 3, 2),
(36, 'Quelle méthode fusionne deux tableaux ou plus ?', 'join()', 'concat()', 'merge()', 'combine()', 2, 2),
(37, 'Comment vérifier si une valeur est \"Not-a-Number\" ?', 'isNumber()', 'checkNaN()', 'isNaN()', 'verify()', 3, 2),
(38, 'Quelle propriété d\'un objet \"Math\" donne la valeur de PI ?', 'Math.pi', 'Math.PI', 'Math.getPI()', 'Math.constant(PI)', 2, 2),
(39, 'Lequel de ces éléments n\'est PAS un type de données primitif en JS ?', 'Boolean', 'String', 'Object', 'Symbol', 3, 2),
(40, 'Comment supprimer le premier élément d\'un tableau ?', 'pop()', 'delete()', 'remove()', 'shift()', 4, 2),
(41, 'Quel mot-clé est utilisé dans une classe pour faire référence à l\'instance actuelle ?', 'instance', 'self', 'this', 'current', 3, 2),
(42, 'Quelle méthode crée un nouveau tableau avec les éléments qui passent un test ?', 'map()', 'filter()', 'forEach()', 'find()', 2, 2),
(43, 'Comment transformer un objet en chaîne de caractères JSON ?', 'JSON.parse()', 'JSON.convert()', 'JSON.stringify()', 'JSON.toString()', 3, 2),
(44, 'Quel opérateur permet d\'assigner une valeur par défaut si la variable est null/undefined ?', '&&', '||', '??', '!!', 3, 2),
(45, 'Quelle est la valeur de \"Boolean(0)\" ?', 'true', 'false', 'undefined', 'null', 2, 2),
(46, 'Comment extraire une partie d\'une chaîne (de l\'indice 1 à 3) ?', 'slice(1, 3)', 'extract(1, 3)', 'get(1, 3)', 'cut(1, 3)', 1, 2),
(47, 'Quel est le résultat de \"3\" * \"2\" ?', '32', '5', '6', 'NaN', 3, 2),
(48, 'Quelle méthode transforme une chaîne JSON en objet JavaScript ?', 'JSON.toObject()', 'JSON.parse()', 'JSON.stringify()', 'JSON.read()', 2, 2),
(49, 'Comment vérifier si un tableau inclut une certaine valeur ?', 'has()', 'contains()', 'includes()', 'exists()', 3, 2),
(50, 'Quel mot-clé permet de gérer les erreurs avec \"try\" ?', 'error', 'catch', 'finally', 'exception', 2, 2),
(51, 'Que signifie l\'acronyme SQL ?', 'Simple Query Language', 'Structured Query Language', 'Standard Query Logic', 'Sequential Query List', 2, 3),
(52, 'Quelle commande est utilisée pour extraire des données d\'une base de données ?', 'GET', 'EXTRACT', 'OPEN', 'SELECT', 4, 3),
(53, 'Quelle clause est utilisée pour filtrer les enregistrements d\'une requête ?', 'ORDER BY', 'GROUP BY', 'WHERE', 'LIMIT', 3, 3),
(54, 'Quel mot-clé permet de supprimer les doublons dans un SELECT ?', 'UNIQUE', 'DISTINCT', 'SINGLE', 'ONLY', 2, 3),
(55, 'Quelle commande permet de modifier des données existantes dans une table ?', 'CHANGE', 'MODIFY', 'UPDATE', 'SET', 3, 3),
(56, 'Que fait la commande \"DELETE FROM table_name\" sans clause WHERE ?', 'Elle supprime la table', 'Elle vide la table', 'Elle génère une erreur', 'Elle supprime le premier index', 2, 3),
(57, 'Quelle contrainte garantit qu\'une colonne a une valeur unique pour chaque ligne ?', 'NOT NULL', 'PRIMARY KEY', 'UNIQUE', 'Les réponses B et C', 4, 3),
(58, 'Comment trier les résultats par ordre alphabétique décroissant ?', 'ORDER BY name DESC', 'ORDER BY name ASC', 'SORT BY name', 'DESCENDING name', 1, 3),
(59, 'Quelle fonction SQL compte le nombre de lignes dans une table ?', 'SUM()', 'TOTAL()', 'COUNT()', 'NUMBER()', 3, 3),
(60, 'Quel mot-clé est utilisé pour ajouter une nouvelle ligne dans une table ?', 'ADD', 'INSERT INTO', 'PUT', 'NEW', 2, 3),
(61, 'Comment s\'appelle l\'identifiant unique d\'une table ?', 'Clé étrangère', 'Clé secondaire', 'Clé primaire', 'Clé d\'index', 3, 3),
(62, 'Quelle commande permet de créer une nouvelle base de données ?', 'MAKE DATABASE', 'NEW DATABASE', 'ADD DATABASE', 'CREATE DATABASE', 4, 3),
(63, 'Que signifie l\'acronyme SGBD ?', 'Système de Gestion de Base de Données', 'Service de Grille et Base de Données', 'Structure Générale de Base de Données', 'Stockage de Gestion de Données', 1, 3),
(64, 'Quelle clause permet de limiter le nombre de résultats retournés ?', 'TOP', 'STOP', 'LIMIT', 'BREAK', 3, 3),
(65, 'Quel opérateur permet de chercher un modèle spécifique dans une colonne (ex: nom fini par \"a\") ?', 'LIKE', 'MATCH', 'SEARCH', 'CONTAINS', 1, 3),
(66, 'Comment appelle-t-on une liaison entre deux tables ?', 'Une fusion', 'Une jointure', 'Une attache', 'Un lien SQL', 2, 3),
(67, 'Quelle commande permet de supprimer définitivement une table (structure comprise) ?', 'REMOVE TABLE', 'DELETE TABLE', 'DROP TABLE', 'CLEAR TABLE', 3, 3),
(68, 'Dans une jointure, quelle clé fait référence à la clé primaire d\'une autre table ?', 'Clé externe', 'Clé d\'accès', 'Clé étrangère', 'Clé de lien', 3, 3),
(69, 'Quelle fonction SQL calcule la moyenne d\'une colonne numérique ?', 'MEAN()', 'AVERAGE()', 'SUM()', 'AVG()', 4, 3),
(70, 'Quel mot-clé permet de grouper des lignes ayant les mêmes valeurs ?', 'ORDER BY', 'GROUP BY', 'SORT BY', 'COLLECT BY', 2, 3),
(71, 'Quelle commande permet de modifier la structure d\'une table (ajouter une colonne) ?', 'UPDATE TABLE', 'CHANGE TABLE', 'ALTER TABLE', 'EDIT TABLE', 3, 3),
(72, 'Que retourne la requête \"SELECT * FROM table\" ?', 'La première colonne', 'Le nom des colonnes', 'Toutes les colonnes et lignes', 'Le nombre de lignes', 3, 3),
(73, 'Quel symbole représente \"tous les champs\" dans un SELECT ?', '#', '%', '$', '*', 4, 3),
(74, 'Quel opérateur est utilisé pour tester si une valeur est comprise entre deux limites ?', 'IN', 'BETWEEN', 'RANGE', 'WITHIN', 2, 3),
(75, 'Quelle clause est utilisée avec les fonctions d\'agrégat pour filtrer les groupes ?', 'WHERE', 'ORDER BY', 'HAVING', 'GROUPING', 3, 3),
(76, 'Qu\'est-ce qu\'un algorithme ?', 'Un langage de programmation', 'Une suite finie d\'instructions pour résoudre un pr', 'Un composant matériel de l\'ordinateur', 'Un logiciel de traitement de texte', 2, 4),
(77, 'Quelle structure permet d\'exécuter des instructions seulement si une condition est vraie ?', 'La boucle For', 'La structure alternative (SI)', 'L\'affectation', 'La boucle Tant Que', 2, 4),
(78, 'Comment appelle-t-on une boucle dont on connaît à l\'avance le nombre d\'itérations ?', 'Boucle indéfinie', 'Boucle conditionnelle', 'Boucle itérative (POUR)', 'Boucle infinie', 3, 4),
(79, 'Quel est le rôle de l\'affectation dans un algorithme ?', 'Afficher un résultat', 'Comparer deux valeurs', 'Donner une valeur à une variable', 'Lire une donnée au clavier', 3, 4),
(80, 'Qu\'est-ce qu\'une variable ?', 'Une instruction fixe', 'Un nom associé à une zone mémoire pour stocker une', 'Une erreur de programmation', 'Un type de processeur', 2, 4),
(81, 'Quelle est la particularité d\'une boucle \"Tant Que\" ?', 'Elle s\'exécute toujours au moins une fois', 'La condition est testée avant l\'exécution des inst', 'Elle ne s\'arrête jamais', 'Elle est plus rapide que la boucle Pour', 2, 4),
(82, 'Qu\'est-ce qu\'une fonction récursive ?', 'Une fonction qui ne retourne rien', 'Une fonction qui s\'appelle elle-même', 'Une fonction sans paramètres', 'Une fonction qui s\'exécute en boucle infinie', 2, 4),
(83, 'Dans un tableau de taille N, quel est l\'indice du premier élément ?', '1', 'N', '-1', '0', 4, 4),
(84, 'Quel type de données permet de stocker une liste d\'éléments de même type ?', 'Un entier', 'Un booléen', 'Un tableau', 'Une chaîne de caractères', 3, 4),
(85, 'Que fait un algorithme de tri ?', 'Il supprime les données', 'Il organise les éléments dans un ordre précis', 'Il additionne les nombres', 'Il recherche un élément', 2, 4),
(86, 'Qu\'est-ce qu\'un booléen ?', 'Un nombre entier', 'Une variable qui peut valoir Vrai ou Faux', 'Une suite de caractères', 'Une adresse mémoire', 2, 4),
(87, 'Quelle structure de données suit le principe \"Dernier Entré, Premier Sorti\" (LIFO) ?', 'Une File', 'Un Tableau', 'Une Pile', 'Une Liste', 3, 4),
(88, 'Comment appelle-t-on l\'étape consistant à vérifier manuellement un algorithme avec des valeurs ?', 'La compilation', 'La trace à la main', 'Le débogage automatique', 'L\'exécution matérielle', 2, 4),
(89, 'Quel symbole est souvent utilisé en pseudo-code pour représenter l\'affectation ?', '==', '!=', '<-', '=>', 3, 4),
(90, 'Que se passe-t-il si la condition d\'arrêt d\'une boucle n\'est jamais atteinte ?', 'L\'algorithme s\'arrête par sécurité', 'Cela crée une boucle infinie', 'Le processeur s\'éteint', 'L\'ordinateur recalcule tout', 2, 4),
(91, 'Quelle est la complexité d\'un algorithme ?', 'Sa difficulté de lecture', 'La mesure des ressources (temps/mémoire) consommée', 'Le nombre de lignes de code', 'La couleur de l\'interface', 2, 4),
(92, 'Lequel de ces éléments n\'est pas une structure de contrôle ?', 'SI...ALORS', 'TANT QUE', 'POUR', 'ENTIER', 4, 4),
(93, 'Qu\'est-ce qu\'une condition \"Sinon\" ?', 'Une erreur de logique', 'Le bloc exécuté si la condition du \"Si\" est fausse', 'Une boucle infinie', 'Une affectation multiple', 2, 4),
(94, 'Quel est l\'intérêt d\'utiliser des fonctions ?', 'Ralentir le code', 'Rendre l\'algorithme modulaire et réutilisable', 'Augmenter le nombre de variables', 'Cacher le code à l\'utilisateur', 2, 4),
(95, 'Dans un algorithme de recherche séquentielle, comment trouve-t-on l\'élément ?', 'En le cherchant au milieu', 'En parcourant le tableau du début à la fin', 'En triant d\'abord le tableau', 'En utilisant une clé primaire', 2, 4),
(96, 'Qu\'est-ce que le \"Pseudo-code\" ?', 'Un code secret', 'Un langage proche de la langue naturelle pour décr', 'Le code final en langage C', 'Une erreur de syntaxe', 2, 4),
(97, 'Comment appelle-t-on les valeurs envoyées à une fonction ?', 'Les sorties', 'Les résultats', 'Les paramètres (ou arguments)', 'Les variables locales', 3, 4),
(98, 'Quel type de variable choisir pour stocker le prix d\'un article ?', 'Entier', 'Réel (ou Flottant)', 'Booléen', 'Caractère', 2, 4),
(99, 'Quelle structure suit le principe \"Premier Entré, Premier Sorti\" (FIFO) ?', 'Une Pile', 'Un Tableau', 'Une File', 'Une Variable', 3, 4),
(100, 'Quelle opération permet de combiner deux chaînes de caractères ?', 'L\'addition', 'La multiplication', 'La concaténation', 'La division', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `questions_en_cours`
--

CREATE TABLE `questions_en_cours` (
  `id` int(11) NOT NULL,
  `tentative_id` int(1) NOT NULL,
  `id_1` int(1) NOT NULL,
  `id_2` int(1) NOT NULL,
  `id_3` int(1) NOT NULL,
  `id_4` int(1) NOT NULL,
  `id_5` int(1) NOT NULL,
  `id_6` int(1) NOT NULL,
  `id_7` int(1) NOT NULL,
  `id_8` int(1) NOT NULL,
  `id_9` int(1) NOT NULL,
  `id_10` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions_en_cours`
--

INSERT INTO `questions_en_cours` (`id`, `tentative_id`, `id_1`, `id_2`, `id_3`, `id_4`, `id_5`, `id_6`, `id_7`, `id_8`, `id_9`, `id_10`) VALUES
(6, 10, 38, 50, 37, 46, 43, 34, 39, 48, 29, 30);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `tentative_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `reponse_utilisateur` int(11) NOT NULL,
  `correcte` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `tentative_id`, `question_id`, `reponse_utilisateur`, `correcte`) VALUES
(11, 10, 38, 1, 2),
(12, 10, 30, 2, 2),
(13, 10, 39, 1, 3),
(14, 10, 48, 2, 2),
(15, 10, 46, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tentatives`
--

CREATE TABLE `tentatives` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `score` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tentatives`
--

INSERT INTO `tentatives` (`id`, `utilisateur_id`, `score`, `date`) VALUES
(10, 2, 0, '2026-05-07 08:44:28'),
(11, 2, 0, '2026-05-07 08:44:52');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`) VALUES
(2, 'RAKOTOARIVELO', 'Benjatiana', 'hrakotoarivelo75@gmail.com', '$2y$10$g5n6/zF1QNwzKIZmrvH0R.0Nz9dsSFrm1Pq2mvxKZ7itysdxy2vL6', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `catégorie`
--
ALTER TABLE `catégorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions_en_cours`
--
ALTER TABLE `questions_en_cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tentatives`
--
ALTER TABLE `tentatives`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `catégorie`
--
ALTER TABLE `catégorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `questions_en_cours`
--
ALTER TABLE `questions_en_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tentatives`
--
ALTER TABLE `tentatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
