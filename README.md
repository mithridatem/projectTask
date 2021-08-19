# projectTask
Comment Récupérer et utiliser le projet Task sur votre ordinateur  (Tutoriel) :
1 il vous faut sur votre machine wamp, xampp ou un autre serveur (apache, php, mysql),(modifié)
2 Dézipper le contenu de l'archive dans le dossier à la racine du serveur web (cela va dépendre du serveur : wamp dossier WWW, Xamp : dossier htdocs
), ou faire un git clone du dépôt dans un dossier à la racine du serveur apache,
3 éditez le fichier /utils/connexionbdd.php avec vos informations de serveur BDD (login (défaut root), mdp (défaut vide), adresse du serveur mysql (défaut localhost),
4 Créer une base de données ( depuis phpyadmin ou autre) qui se nomme task1 de type utf8generalci,
5 Exécuter le script sql de stucture ci-dessous dans votre bdd (il va créer les 3 tables et les relations du projet depuis phpmyadmin),

--SCRIPT SQL DE LA BDD
-- Base de données : `task1`
-- --------------------------------------------------------
-- Structure de la table `cat`
--
DROP TABLE IF EXISTS `cat`;
CREATE TABLE IF NOT EXISTS `cat` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
--
-- Structure de la table `task`
--
DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `name_task` varchar(50) DEFAULT NULL,
  `content_task` text,
  `date_task` date DEFAULT NULL,
  `validate_task` tinyint(1) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_task`),
  KEY `task_user_FK` (`id_user`),
  KEY `task_cat0_FK` (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
--
-- Structure de la table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) NOT NULL,
  `first_name_user` varchar(50) NOT NULL,
  `login_user` varchar(50) NOT NULL,
  `mdp_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_cat0_FK` FOREIGN KEY (`id_cat`) REFERENCES `cat` (`id_cat`),
  ADD CONSTRAINT `task_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

6 Créer un compte utilisateur (add_user.php ajouter un compte accessible uniquement déconnecté),
7 Créer une catégorie de tâche (add_cat.php),
8 Créer une ou plusieurs tâches (add_task.php).