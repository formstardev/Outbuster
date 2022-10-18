-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour outbuster
CREATE DATABASE IF NOT EXISTS `outbuster` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `outbuster`;

-- Listage de la structure de la table outbuster. action_events
CREATE TABLE IF NOT EXISTS `action_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) unsigned NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  KEY `action_events_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.action_events : ~0 rows (environ)
/*!40000 ALTER TABLE `action_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `action_events` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `feedback_user_id` int(11) DEFAULT NULL,
  `feedback_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `feedback_resolution_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.feedback : ~1 rows (environ)
DELETE FROM `feedback`;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`id`, `feedback_user_id`, `feedback_type`, `feedback`, `feedback_resolution_date`, `feedback_status`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Problème technique', 'Message', '2022-01-01', 'Nouveau', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. films
CREATE TABLE IF NOT EXISTS `films` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_original_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_country_of_origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_running_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_country_id` int(11) DEFAULT NULL,
  `film_certification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_synopsis` text COLLATE utf8mb4_unicode_ci,
  `film_category` text COLLATE utf8mb4_unicode_ci,
  `film_genre` text COLLATE utf8mb4_unicode_ci,
  `film_tag` text COLLATE utf8mb4_unicode_ci,
  `film_pros` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_cons` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_master_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.films : ~1 rows (environ)
DELETE FROM `films`;
/*!40000 ALTER TABLE `films` DISABLE KEYS */;
INSERT INTO `films` (`id`, `film_original_title`, `film_country_of_origin`, `film_version`, `film_running_time`, `film_tagline`, `film_synopsis`, `film_category`, `film_genre`, `film_tag`, `film_pros`, `film_cons`, `film_cover`, `film_trailer`, `film_master_file`, `film_country_id`, `film_certification`, `home`, `created_at`, `updated_at`) VALUES
  (1, 'The love witch', 'Film américain', 'Film en VOST', '120', 61, 'Interdit aux moins de 16 ans', 'Ma sorcière mal aimée', 'Elaine, une jeune et belle sorcière, est déterminée à trouver l’homme de sa vie. Disposant pour ce faire d\'un physique des plus avantageux, comme de potions et autres formules magiques, elle attire de nombreux hommes…Mais semble les rendre tous malheureux, voire décédés.', '3,5,6,7', '8,10,11,15,23', '4,3,13,18,22,17', 'Les sortilèges, Les films de genre, Le rouge', 'Le maniérisme, Le spiritisme, Les trucs en "-isme"', 'media/film/covers/the-love-witch.jpg', NULL, NULL, 1, '2022-01-01 00:00:00', '2022-01-01 00:00:00');

-- Listage de la structure de la table outbuster. film_cast_members
CREATE TABLE IF NOT EXISTS `film_cast_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` int(11) DEFAULT NULL,
  `film_cast_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_cast_character` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.film_cast_members : ~3 rows (environ)
DELETE FROM `film_cast_members`;
/*!40000 ALTER TABLE `film_cast_members` DISABLE KEYS */;
INSERT INTO `film_cast_members` (`id`, `film_id`, `film_cast_name`, `film_cast_character`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Samantha Robinson', 'Elaine Parks', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 1, 'Elle Evans', 'Star', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 1, 'Jeffrey Vincent Parise', 'Wayne Peters', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `film_cast_members` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. film_crew_members
CREATE TABLE IF NOT EXISTS `film_crew_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` int(11) DEFAULT NULL,
  `film_crew_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_crew_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.film_crew_members : ~1 rows (environ)
DELETE FROM `film_crew_members`;
/*!40000 ALTER TABLE `film_crew_members` DISABLE KEYS */;
INSERT INTO `film_crew_members` (`id`, `film_id`, `film_crew_name`, `film_crew_occupation`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Anna Biller', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `film_crew_members` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. film_critics
CREATE TABLE IF NOT EXISTS `film_critics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` int(11) DEFAULT NULL,
  `film_critic_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_critic_name_id` int(11) DEFAULT NULL,
  `film_criticism` text COLLATE utf8mb4_unicode_ci,
  `film_complete_criticism` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_complete_criticism_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `film_description_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.film_critics : ~1 rows (environ)
DELETE FROM `film_critics`;
/*!40000 ALTER TABLE `film_critics` DISABLE KEYS */;
INSERT INTO `film_critics` (`id`, `film_id`, `film_critic_title`, `film_critic_name_id`, `film_criticism`, `film_complete_criticism`, `film_description`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Ce qu\'on en pense sur', '1', 'C\'est le style qui fait le charme du film ! Les effets sont kitsch assumés et c\'est sympa de voir un film de sorcière moderne aussi assumé. Le discours sur la reappropriation du pouvoir et le feminisme est très clairement intégré. Le film ne se moque pas de son fond mais est très parodique.', 'Lire la critique complète de Lys sur SensCritique', 'Voir la fiche du film sur SensCritique', '2022-06-02 16:15:47', '2022-06-02 16:15:47');
/*!40000 ALTER TABLE `film_critics` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. film_rating_systems
CREATE TABLE IF NOT EXISTS `film_rating_systems` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` int(11) DEFAULT NULL,
  `certification_country_id` int(11) DEFAULT NULL,
  `certification_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification_letter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.film_rating_systems : ~0 rows (environ)
/*!40000 ALTER TABLE `film_rating_systems` DISABLE KEYS */;
/*!40000 ALTER TABLE `film_rating_systems` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. gp_countries
CREATE TABLE IF NOT EXISTS `gp_countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cyrlight.gp_countries : ~197 rows (environ)
DELETE FROM `gp_countries`;
/*!40000 ALTER TABLE `gp_countries` DISABLE KEYS */;
INSERT INTO `gp_countries` (`id`, `country_flag`, `country_name`, `created_at`, `updated_at`) VALUES
  (1, 'media/parameters/country/flags/af.svg', 'Afghanistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 'media/parameters/country/flags/za.svg', 'Afrique du Sud', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 'media/parameters/country/flags/al.svg', 'Albanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 'media/parameters/country/flags/dz.svg', 'Algérie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 'media/parameters/country/flags/de.svg', 'Allemagne', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 'media/parameters/country/flags/ad.svg', 'Andorre', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 'media/parameters/country/flags/ao.svg', 'Angola', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 'media/parameters/country/flags/ag.svg', 'Antigua-et-Barbuda', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, 'media/parameters/country/flags/sa.svg', 'Arabie saoudite', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, 'media/parameters/country/flags/ar.svg', 'Argentine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (11, 'media/parameters/country/flags/am.svg', 'Arménie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (12, 'media/parameters/country/flags/au.svg', 'Australie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (13, 'media/parameters/country/flags/at.svg', 'Autriche', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (14, 'media/parameters/country/flags/az.svg', 'Azerbaïdjan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (15, 'media/parameters/country/flags/bs.svg', 'Bahamas', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (16, 'media/parameters/country/flags/bh.svg', 'Bahreïn', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (17, 'media/parameters/country/flags/bd.svg', 'Bangladesh', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (18, 'media/parameters/country/flags/bb.svg', 'Barbade', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (19, 'media/parameters/country/flags/be.svg', 'Belgique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (20, 'media/parameters/country/flags/bz.svg', 'Bélize', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (21, 'media/parameters/country/flags/bj.svg', 'Bénin', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (22, 'media/parameters/country/flags/bt.svg', 'Bhoutan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (23, 'media/parameters/country/flags/by.svg', 'Biélorussie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (24, 'media/parameters/country/flags/bo.svg', 'Bolivie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (25, 'media/parameters/country/flags/ba.svg', 'Bosnie-Herzégovine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (26, 'media/parameters/country/flags/bw.svg', 'Botswana', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (27, 'media/parameters/country/flags/br.svg', 'Brésil', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (28, 'media/parameters/country/flags/bn.svg', 'Brunéi Darussalam', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (29, 'media/parameters/country/flags/bg.svg', 'Bulgarie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (30, 'media/parameters/country/flags/bf.svg', 'Burkina Faso', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (31, 'media/parameters/country/flags/bi.svg', 'Burundi', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (32, 'media/parameters/country/flags/kh.svg', 'Cambodge', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (33, 'media/parameters/country/flags/cm.svg', 'Cameroun', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (34, 'media/parameters/country/flags/ca.svg', 'Canada', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (35, 'media/parameters/country/flags/cv.svg', 'Cap-Vert', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (36, 'media/parameters/country/flags/cl.svg', 'Chili', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (37, 'media/parameters/country/flags/cn.svg', 'Chine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (38, 'media/parameters/country/flags/cy.svg', 'Chypre', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (39, 'media/parameters/country/flags/co.svg', 'Colombie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (40, 'media/parameters/country/flags/km.svg', 'Comores', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (41, 'media/parameters/country/flags/kp.svg', 'Corée du Nord', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (42, 'media/parameters/country/flags/kr.svg', 'Corée du Sud', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (43, 'media/parameters/country/flags/cr.svg', 'Costa Rica', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (44, 'media/parameters/country/flags/ci.svg', 'Côte d\'Ivoire', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (45, 'media/parameters/country/flags/hr.svg', 'Croatie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (46, 'media/parameters/country/flags/cu.svg', 'Cuba', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (47, 'media/parameters/country/flags/dk.svg', 'Danemark', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (48, 'media/parameters/country/flags/dj.svg', 'Djibouti', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (49, 'media/parameters/country/flags/dm.svg', 'Dominique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (50, 'media/parameters/country/flags/eg.svg', 'Égypte', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (51, 'media/parameters/country/flags/ae.svg', 'Émirats arabes unis', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (52, 'media/parameters/country/flags/ec.svg', 'Équateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (53, 'media/parameters/country/flags/er.svg', 'Érythrée', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (54, 'media/parameters/country/flags/es.svg', 'Espagne', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (55, 'media/parameters/country/flags/ee.svg', 'Estonie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (56, 'media/parameters/country/flags/sz.svg', 'Eswatini', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (57, 'media/parameters/country/flags/us.svg', 'États-Unis', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (58, 'media/parameters/country/flags/et.svg', 'Éthiopie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (59, 'media/parameters/country/flags/fj.svg', 'Fidji', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (60, 'media/parameters/country/flags/fi.svg', 'Finlande', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (61, 'media/parameters/country/flags/fr.svg', 'France', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (62, 'media/parameters/country/flags/ga.svg', 'Gabon', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (63, 'media/parameters/country/flags/gm.svg', 'Gambie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (64, 'media/parameters/country/flags/ge.svg', 'Géorgie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (65, 'media/parameters/country/flags/gh.svg', 'Ghana', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (66, 'media/parameters/country/flags/gr.svg', 'Grèce', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (67, 'media/parameters/country/flags/gd.svg', 'Grenade', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (68, 'media/parameters/country/flags/gt.svg', 'Guatemala', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (69, 'media/parameters/country/flags/gn.svg', 'Guinée', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (70, 'media/parameters/country/flags/gq.svg', 'Guinée équatoriale', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (71, 'media/parameters/country/flags/gw.svg', 'Guinée-Bissau', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (72, 'media/parameters/country/flags/gy.svg', 'Guyana', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (73, 'media/parameters/country/flags/ht.svg', 'Haïti', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (74, 'media/parameters/country/flags/hn.svg', 'Honduras', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (75, 'media/parameters/country/flags/hu.svg', 'Hongrie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (76, 'media/parameters/country/flags/ck.svg', 'Îles Cook', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (77, 'media/parameters/country/flags/mh.svg', 'Îles Marshall', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (78, 'media/parameters/country/flags/sb.svg', 'Îles Salomon', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (79, 'media/parameters/country/flags/in.svg', 'Inde', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (80, 'media/parameters/country/flags/id.svg', 'Indonésie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (81, 'media/parameters/country/flags/iq.svg', 'Irak', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (82, 'media/parameters/country/flags/ir.svg', 'Iran', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (83, 'media/parameters/country/flags/ie.svg', 'Irlande', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (84, 'media/parameters/country/flags/is.svg', 'Islande', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (85, 'media/parameters/country/flags/il.svg', 'Israël', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (86, 'media/parameters/country/flags/it.svg', 'Italie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (87, 'media/parameters/country/flags/jm.svg', 'Jamaïque', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (88, 'media/parameters/country/flags/jp.svg', 'Japon', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (89, 'media/parameters/country/flags/jo.svg', 'Jordanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (90, 'media/parameters/country/flags/kz.svg', 'Kazakhstan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (91, 'media/parameters/country/flags/ke.svg', 'Kenya', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (92, 'media/parameters/country/flags/kg.svg', 'Kirghizistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (93, 'media/parameters/country/flags/ki.svg', 'Kiribati', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (94, 'media/parameters/country/flags/kw.svg', 'Koweït', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (95, 'media/parameters/country/flags/la.svg', 'Laos', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (96, 'media/parameters/country/flags/ls.svg', 'Lesotho', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (97, 'media/parameters/country/flags/lv.svg', 'Lettonie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (98, 'media/parameters/country/flags/lb.svg', 'Liban', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (99, 'media/parameters/country/flags/lr.svg', 'Libéria', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (100, 'media/parameters/country/flags/ly.svg', 'Libye', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (101, 'media/parameters/country/flags/li.svg', 'Liechtenstein', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (102, 'media/parameters/country/flags/lt.svg', 'Lituanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (103, 'media/parameters/country/flags/lu.svg', 'Luxembourg', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (104, 'media/parameters/country/flags/mk.svg', 'Macédoine du Nord', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (105, 'media/parameters/country/flags/mg.svg', 'Madagascar', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (106, 'media/parameters/country/flags/my.svg', 'Malaisie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (107, 'media/parameters/country/flags/mw.svg', 'Malawi', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (108, 'media/parameters/country/flags/mv.svg', 'Maldives', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (109, 'media/parameters/country/flags/ml.svg', 'Mali', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (110, 'media/parameters/country/flags/mt.svg', 'Malte', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (111, 'media/parameters/country/flags/ma.svg', 'Maroc', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (112, 'media/parameters/country/flags/mu.svg', 'Maurice', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (113, 'media/parameters/country/flags/mr.svg', 'Mauritanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (114, 'media/parameters/country/flags/mx.svg', 'Mexique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (115, 'media/parameters/country/flags/fm.svg', 'Micronésie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (116, 'media/parameters/country/flags/md.svg', 'Moldavie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (117, 'media/parameters/country/flags/mc.svg', 'Monaco', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (118, 'media/parameters/country/flags/mn.svg', 'Mongolie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (119, 'media/parameters/country/flags/me.svg', 'Monténégro', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (120, 'media/parameters/country/flags/mz.svg', 'Mozambique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (121, 'media/parameters/country/flags/mm.svg', 'Myanmar (Birmanie)', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (122, 'media/parameters/country/flags/na.svg', 'Namibie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (123, 'media/parameters/country/flags/nr.svg', 'Nauru', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (124, 'media/parameters/country/flags/np.svg', 'Népal', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (125, 'media/parameters/country/flags/ni.svg', 'Nicaragua', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (126, 'media/parameters/country/flags/ne.svg', 'Niger', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (127, 'media/parameters/country/flags/ng.svg', 'Nigeria', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (128, 'media/parameters/country/flags/nu.svg', 'Niué', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (129, 'media/parameters/country/flags/no.svg', 'Norvège', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (130, 'media/parameters/country/flags/nz.svg', 'Nouvelle-Zélande', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (131, 'media/parameters/country/flags/om.svg', 'Oman', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (132, 'media/parameters/country/flags/ug.svg', 'Ouganda', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (133, 'media/parameters/country/flags/uz.svg', 'Ouzbékistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (134, 'media/parameters/country/flags/pk.svg', 'Pakistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (135, 'media/parameters/country/flags/pw.svg', 'Palaos', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (136, 'media/parameters/country/flags/ps.svg', 'Palestine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (137, 'media/parameters/country/flags/pa.svg', 'Panama', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (138, 'media/parameters/country/flags/pg.svg', 'Papouasie-Nouvelle-Guinée', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (139, 'media/parameters/country/flags/py.svg', 'Paraguay', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (140, 'media/parameters/country/flags/nl.svg', 'Pays-Bas', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (141, 'media/parameters/country/flags/pe.svg', 'Pérou', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (142, 'media/parameters/country/flags/ph.svg', 'Philippines', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (143, 'media/parameters/country/flags/pl.svg', 'Pologne', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (144, 'media/parameters/country/flags/pt.svg', 'Portugal', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (145, 'media/parameters/country/flags/qa.svg', 'Qatar', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (146, 'media/parameters/country/flags/cf.svg', 'République centrafricaine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (147, 'media/parameters/country/flags/cd.svg', 'République démocratique du Congo', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (148, 'media/parameters/country/flags/do.svg', 'République dominicaine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (149, 'media/parameters/country/flags/cg.svg', 'République du Congo', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (150, 'media/parameters/country/flags/ro.svg', 'Roumanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (151, 'media/parameters/country/flags/gb.svg', 'Royaume-Uni', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (152, 'media/parameters/country/flags/ru.svg', 'Russie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (153, 'media/parameters/country/flags/rw.svg', 'Rwanda', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (154, 'media/parameters/country/flags/kn.svg', 'Saint-Christophe-et-Niévès', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (155, 'media/parameters/country/flags/sm.svg', 'Saint-Marin', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (156, 'media/parameters/country/flags/vc.svg', 'Saint-Vincent-et-les-Grenadines', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (157, 'media/parameters/country/flags/lc.svg', 'Sainte-Lucie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (158, 'media/parameters/country/flags/sv.svg', 'Salvador', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (159, 'media/parameters/country/flags/ws.svg', 'Samoa', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (160, 'media/parameters/country/flags/st.svg', 'Sao Tomé-et-Principe', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (161, 'media/parameters/country/flags/sn.svg', 'Sénégal', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (162, 'media/parameters/country/flags/rs.svg', 'Serbie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (163, 'media/parameters/country/flags/sc.svg', 'Seychelles', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (164, 'media/parameters/country/flags/sl.svg', 'Sierra Leone', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (165, 'media/parameters/country/flags/sg.svg', 'Singapour', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (166, 'media/parameters/country/flags/sk.svg', 'Slovaquie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (167, 'media/parameters/country/flags/si.svg', 'Slovénie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (168, 'media/parameters/country/flags/so.svg', 'Somalie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (169, 'media/parameters/country/flags/sd.svg', 'Soudan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (170, 'media/parameters/country/flags/ss.svg', 'Soudan du Sud', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (171, 'media/parameters/country/flags/lk.svg', 'Sri Lanka', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (172, 'media/parameters/country/flags/se.svg', 'Suède', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (173, 'media/parameters/country/flags/ch.svg', 'Suisse', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (174, 'media/parameters/country/flags/sr.svg', 'Suriname', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (175, 'media/parameters/country/flags/sy.svg', 'Syrie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (176, 'media/parameters/country/flags/tj.svg', 'Tadjikistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (177, 'media/parameters/country/flags/tz.svg', 'Tanzanie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (178, 'media/parameters/country/flags/td.svg', 'Tchad', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (179, 'media/parameters/country/flags/cz.svg', 'Tchéquie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (180, 'media/parameters/country/flags/th.svg', 'Thaïlande', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (181, 'media/parameters/country/flags/tl.svg', 'Timor oriental', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (182, 'media/parameters/country/flags/tg.svg', 'Togo', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (183, 'media/parameters/country/flags/to.svg', 'Tonga', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (184, 'media/parameters/country/flags/tt.svg', 'Trinité-et-Tobago', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (185, 'media/parameters/country/flags/tn.svg', 'Tunisie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (186, 'media/parameters/country/flags/tm.svg', 'Turkménistan', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (187, 'media/parameters/country/flags/tr.svg', 'Turquie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (188, 'media/parameters/country/flags/tv.svg', 'Tuvalu', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (189, 'media/parameters/country/flags/ua.svg', 'Ukraine', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (190, 'media/parameters/country/flags/uy.svg', 'Uruguay', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (191, 'media/parameters/country/flags/vu.svg', 'Vanuatu', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (192, 'media/parameters/country/flags/va.svg', 'Vatican', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (193, 'media/parameters/country/flags/ve.svg', 'Venezuela', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (194, 'media/parameters/country/flags/vn.svg', 'Viêt Nam', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (195, 'media/parameters/country/flags/ye.svg', 'Yémen', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (196, 'media/parameters/country/flags/zm.svg', 'Zambie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (197, 'media/parameters/country/flags/zw.svg', 'Zimbabwe', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `gp_countries` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.migrations : ~32 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_01_01_000000_create_action_events_table', 1),
	(4, '2019_05_03_000001_create_customer_columns', 1),
	(5, '2019_05_03_000002_create_subscriptions_table', 1),
	(6, '2019_05_03_000003_create_subscription_items_table', 1),
	(7, '2019_05_10_000000_add_fields_to_action_events_table', 1),
	(8, '2019_08_19_000000_create_failed_jobs_table', 1),
	(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(10, '2022_01_01_000000_create_feedback', 1),
	(11, '2022_01_01_000000_create_film_cast_members', 1),
	(12, '2022_01_01_000000_create_film_crew_members', 1),
	(13, '2022_01_01_000000_create_film_critics', 1),
	(14, '2022_01_01_000000_create_film_rating_systems', 1),
	(15, '2022_01_01_000000_create_films', 1),
	(16, '2022_01_01_000000_create_gp_countries', 1),
	(17, '2022_01_01_000000_create_mp_artwork_categories', 1),
	(18, '2022_01_01_000000_create_mp_artwork_critics', 1),
	(19, '2022_01_01_000000_create_mp_artwork_genres', 1),
	(20, '2022_01_01_000000_create_mp_artwork_tags', 1),
	(21, '2022_01_01_000000_create_mp_artwork_warnings', 1),
	(22, '2022_01_01_000000_create_serie_cast_members', 1),
	(23, '2022_01_01_000000_create_serie_crew_members', 1),
	(24, '2022_01_01_000000_create_serie_critics', 1),
	(25, '2022_01_01_000000_create_serie_episodes', 1),
	(26, '2022_01_01_000000_create_serie_rating_systems', 1),
	(27, '2022_01_01_000000_create_series', 1),
	(28, '2022_01_01_000000_create_user_playlists', 1),
	(29, '2022_10_11_083410_create_user_verification_tokens_table', 1),
	(30, '2022_10_12_000000_create_plans', 1),
	(31, '2022_10_12_185624_create_transactions_table', 1),
	(32, '2022_10_15_171225_create_play_histories_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. mp_artwork_categories
CREATE TABLE IF NOT EXISTS `mp_artwork_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.mp_artwork_categories : ~8 rows (environ)
DELETE FROM `mp_artwork_categories`;
/*!40000 ALTER TABLE `mp_artwork_categories` DISABLE KEYS */;
INSERT INTO `mp_artwork_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
  (1, 'Complètement à l\'Est', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 'Documenteurs', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 'Entre fesses', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 'Entre potes', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 'FEFFS', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 'Le doigt dans le culte', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 'Palmés (ou presque)', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 'Raison et sentiments', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `mp_artwork_categories` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. mp_artwork_critics
CREATE TABLE IF NOT EXISTS `mp_artwork_critics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artwork_critic_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artwork_critic_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artwork_critic_logotype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.mp_artwork_critics : ~1 rows (environ)
DELETE FROM `mp_artwork_critics`;
/*!40000 ALTER TABLE `mp_artwork_critics` DISABLE KEYS */;
INSERT INTO `mp_artwork_critics` (`id`, `artwork_critic_name`, `artwork_critic_website`, `artwork_critic_logotype`, `created_at`, `updated_at`) VALUES
  (1, 'SensCritique', 'https://www.senscritique.com/', 'media/parameters/artwork/critic/logotypes/senscritique.png', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `mp_artwork_critics` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. mp_artwork_genres
CREATE TABLE IF NOT EXISTS `mp_artwork_genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.mp_artwork_genres : ~24 rows (environ)
DELETE FROM `mp_artwork_genres`;
/*!40000 ALTER TABLE `mp_artwork_genres` DISABLE KEYS */;
INSERT INTO `mp_artwork_genres` (`id`, `genre`, `created_at`, `updated_at`) VALUES
  (1, 'Action', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 'Animation', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 'Anime', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 'Art', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 'Aventure', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 'Biographie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 'Comedie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 'Crime', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, 'Documentaire', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, 'Drame', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (11, 'Érotique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (12, 'Fantastique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (13, 'Guerre', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (14, 'Historique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (15, 'Horreur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (16, 'Musical', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (17, 'Nature', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (18, 'Péplum', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (19, 'Pornographique', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (20, 'Romance', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (21, 'Science-fiction', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (22, 'Sport', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (23, 'Thriller', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (24, 'Western', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `mp_artwork_genres` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. mp_artwork_tags
CREATE TABLE IF NOT EXISTS `mp_artwork_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.mp_artwork_tags : ~27 rows (environ)
DELETE FROM `mp_artwork_tags`;
/*!40000 ALTER TABLE `mp_artwork_tags` DISABLE KEYS */;
INSERT INTO `mp_artwork_tags` (`id`, `tag`, `created_at`, `updated_at`) VALUES
  (1, '#au-delà du réel', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, '#bourpifs', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, '#ça fait peur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, '#ça fait réfléchir', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, '#ça va saigner', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, '#cartooneries', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, '#crise d\'ados', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, '#docs en stock', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, '#dramakif', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, '#feelgood', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (11, '#french connection', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (12, '#gangstermania', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (13, '#halloween', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (14, '#heartbeat', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (15, '#intellokif', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (16, '#keufs&cie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (17, '#kiss&cry', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (18, '#kiss&love', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (19, '#monstres&cie', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (20, '#nanarschisme', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (21, '#no brain no pain', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (22, '#petit cochon', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (23, '#punks not dead', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (24, '#welcome', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (25, '#zik en fond', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (26, '#zombies nation', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (27, '#zygomatik', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `mp_artwork_tags` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. mp_artwork_warnings
CREATE TABLE IF NOT EXISTS `mp_artwork_warnings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artwork_warning_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artwork_warning_logotype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.mp_artwork_warnings : ~3 rows (environ)
DELETE FROM `mp_artwork_warnings`;
/*!40000 ALTER TABLE `mp_artwork_warnings` DISABLE KEYS */;
INSERT INTO `mp_artwork_warnings` (`id`, `artwork_warning_type`, `artwork_warning_logotype`, `created_at`, `updated_at`) VALUES
  (1, 'Drogue', 'media/parameters/artwork/warning/logotypes/drug.png', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 'Sexe', 'media/parameters/artwork/warning/logotypes/sex.png', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 'Violence', 'media/parameters/artwork/warning/logotypes/violence.png', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `mp_artwork_warnings` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. plans
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT '0.00',
  `free_period` int(11) DEFAULT NULL,
  `payment_period` int(11) DEFAULT NULL,
  `payment_recurring` int(11) DEFAULT NULL,
  `stripe_prod_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_plan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.plans : ~2 rows (environ)
DELETE FROM `plans`;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` (`id`, `name`, `description`, `frequency`, `amount`,  `free_period`, `payment_period`, `payment_recurring`, `stripe_prod_id`, `stripe_plan_id`, `status`, `created_at`, `updated_at`) VALUES
  (1, 'Abonnement mensuel de 30 jours', 'Abonnement mensuel de 30 jours', 'Month', 6.00, 0, 30, 0, 'prod_McSbYGg7z2m6f4', 'plan_McSb6XXwGV8WrL', 1, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 'Abonnement annuel de 365 jours', 'Abonnement annuel de 365 jours', 'Year', 60.00, 0, 365, 0, 'prod_McSbk1mrAH148P', 'plan_McSbjV6Vt8Mkwt', 1, '2022-01-01 00:00:00', '2022-01-01 00:00:00');

-- Listage de la structure de la table outbuster. play_histories
CREATE TABLE IF NOT EXISTS `play_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.play_histories : ~0 rows (environ)
/*!40000 ALTER TABLE `play_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `play_histories` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. series
CREATE TABLE IF NOT EXISTS `series` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_original_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_country_of_origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_synopsis` text COLLATE utf8mb4_unicode_ci,
  `serie_category` text COLLATE utf8mb4_unicode_ci,
  `serie_genre` text COLLATE utf8mb4_unicode_ci,
  `serie_tag` text COLLATE utf8mb4_unicode_ci,
  `serie_pros` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_cons` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.series : ~1 rows (environ)
DELETE FROM `series`;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` (`id`, `serie_original_title`, `serie_country_of_origin`, `serie_version`, `serie_tagline`, `serie_synopsis`, `serie_category`, `serie_genre`, `serie_tag`, `serie_pros`, `serie_cons`, `serie_cover`, `serie_trailer`, `created_at`, `updated_at`) VALUES
  (1, 'Game of Thrones', 'Série américaine', 'Série en VOST', 'L\'hiver arrive.', 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de fer, le symbole du pouvoir absolu.', '4,3,6,7', '1,5,12,10', '3,4,5,1,22,19,18,17', 'Aventure, Intrigue, Dragons', 'Sexe, Violence', NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `series` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. serie_cast_members
CREATE TABLE IF NOT EXISTS `serie_cast_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `serie_cast_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_cast_character` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.serie_cast_members : ~30 rows (environ)
DELETE FROM `serie_cast_members`;
/*!40000 ALTER TABLE `serie_cast_members` DISABLE KEYS */;
INSERT INTO `serie_cast_members` (`id`, `serie_id`, `serie_cast_name`, `serie_cast_character`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Peter Dinklage', 'Tyrion Lannister', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 1, 'Emilia Clarke', 'Daenerys Targaryen', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 1, 'Kit Harington', 'Jon Snow', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 1, 'Lena Headey', 'Cersei Lannister', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 1, 'Maisie Williams', 'Arya Stark', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 1, 'Sophie Turner', 'Sansa Stark', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 1, 'Nikolaj Coster-Waldau', 'Jaime Lannister', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 1, 'Iain Glen', 'Jorah Mormont', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, 1, 'John Bradley', 'Samwell Tarly', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, 1, 'Alfie Allen', 'Theon Greyjoy', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (11, 1, 'Conleth Hill', 'Lord Varys', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (12, 1, 'Gwendoline Christie', 'Brienne of Tarth', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (13, 1, 'Liam Cunningham', 'Davos Seaworth', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (14, 1, 'Aidan Gillen', 'Petyr \'Littlefinger\' Baelish', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (15, 1, 'Isaac Hempstead Wright', 'Bran Stark', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (16, 1, 'Nathalie Emmanuel', 'Missandei', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (17, 1, 'Rory McCann', 'Sandor \'The Hound\' Clegane', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (18, 1, 'Jerome Flynn', 'Bronn', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (19, 1, 'Daniel Portman', 'Podrick Payne', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (20, 1, 'Ben Crompton', 'Eddison Tollett', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (21, 1, 'Jacob Anderson', 'Grey Worm', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (22, 1, 'Kristofer Hivju', 'Tormund Giantsbane', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (23, 1, 'Julian Glover', 'Grand Maester Pycelle', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (24, 1, 'Carice van Houten', 'Melisandre', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (25, 1, 'Charles Dance', 'Tywin Lannister', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (26, 1, 'Hannah Murray', 'Gilly', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (27, 1, 'Jack Gleeson', 'Joffrey Baratheon', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (28, 1, 'Natalie Dormer', 'Margaery Tyrell', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (29, 1, 'Ian McElhinney', 'Barristan Selmy', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (30, 1, 'Michelle Fairley', 'Catelyn Stark', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `serie_cast_members` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. serie_crew_members
CREATE TABLE IF NOT EXISTS `serie_crew_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `serie_crew_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_crew_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.serie_crew_members : ~19 rows (environ)
DELETE FROM `serie_crew_members`;
/*!40000 ALTER TABLE `serie_crew_members` DISABLE KEYS */;
INSERT INTO `serie_crew_members` (`id`, `serie_id`, `serie_crew_name`, `serie_crew_occupation`, `created_at`, `updated_at`) VALUES
  (1, 1, 'David Nutter', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 1, 'Alan Taylor', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 1, 'Alex Graves', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 1, 'Miguel Sapochnik', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 1, 'Mark Mylod', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 1, 'Jeremy Podeswa', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 1, 'Daniel Minahan', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 1, 'Alik Sakharov', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, 1, 'Michelle MacLaren', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, 1, 'Brian Kirk', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (11, 1, 'David Benioff', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (12, 1, 'D.B. Weiss', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (13, 1, 'Timothy Van Patten', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (14, 1, 'Neil Marshall', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (15, 1, 'David Petrarca', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (16, 1, 'Michael Slovis', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (17, 1, 'Jack Bender', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (18, 1, 'Daniel Sackheim', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (19, 1, 'Matt Shakman', 'Réalisateur', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `serie_crew_members` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. serie_critics
CREATE TABLE IF NOT EXISTS `serie_critics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `serie_critic_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_critic_name_id` int(11) DEFAULT NULL,
  `serie_criticism` text COLLATE utf8mb4_unicode_ci,
  `serie_complete_criticism` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.serie_critics : ~1 rows (environ)
DELETE FROM `serie_critics`;
/*!40000 ALTER TABLE `serie_critics` DISABLE KEYS */;
INSERT INTO `serie_critics` (`id`, `serie_id`, `serie_critic_title`, `serie_critic_name_id`, `serie_criticism`, `serie_complete_criticism`, `serie_description`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Ce qu\'on en pense sur', 1, 'Superbe retranscription visuelle de l\'univers de G.R.R. Martin, malgré un budget parfois limite (On parle quand même de 6 millions de dollars par épisode), la série Game of Thrones gagne par rapport au livres en clarté dans l\'intrigue ce qu\'elle perd nécessairement en détail du fait du format télévisuel.', 'Lire la critique complète de Hypérion sur SensCritique', 'Voir la fiche du film sur SensCritique', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `serie_critics` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. serie_episodes
CREATE TABLE IF NOT EXISTS `serie_episodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `serie_season_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_synopsis` text COLLATE utf8mb4_unicode_ci,
  `serie_episode_running_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie_episode_master_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.serie_episodes : ~10 rows (environ)
DELETE FROM `serie_episodes`;
/*!40000 ALTER TABLE `serie_episodes` DISABLE KEYS */;
INSERT INTO `serie_episodes` (`id`, `serie_id`, `serie_season_number`, `serie_episode_number`, `serie_episode_title`, `serie_episode_synopsis`, `serie_episode_running_time`, `serie_episode_cover`, `serie_episode_trailer`, `serie_episode_master_file`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Saison 1', 'Épisode 1', 'L\'hiver vient', 'Sur le continent de Westeros, un jeune patrouilleur de la Garde de Nuit, chargée de veiller sur le Mur, est condamné à mort pour désertion par Eddard Stark, seigneur de Winterfell et Gardien du Nord. Mais de sombres nouvelles arrivent de Port-Réal, la capitale des Sept Couronnes : Jon Arryn, ami intime d\'Eddard et Main du roi Robert Baratheon, vient de mourir. Le roi Robert et sa cour entreprennent alors un voyage vers Winterfell, pour gratifier son ami Eddard de la charge de Main du roi. Pendant ce temps, les descendants des rois Targaryen en exil, renversés par Robert, fomentent leur retour en Westeros par un jeu d\'alliance avec les Dothrakis, une tribu de guerriers nomades. Alors qu\'à Winterfell les festivités vont bon train durant le séjour du roi, Brandon, l\'un des fils d\'Eddard Stark, fait une découverte qui lui attire les foudres de la famille royale…', '62', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (2, 1, 'Saison 1', 'Épisode 2', 'La Route royale', 'Daenerys Targaryen, fraîchement mariée au Khal Drogo, entreprend avec les Dothrakis et son frère le long voyage vers Vaes Dothrak. À Winterfell, alors que Bran est toujours dans le coma suite à sa chute, Ned prépare son départ pour Port-Réal. Catelyn, dévastée par l\'état de Bran, ne prend pas part aux adieux à sa famille : Arya et Sansa accompagnent leur père, Jon part vers le nord, sur le Mur, accompagné de son oncle Benjen et de Tyrion Lannister. Seuls restent à Winterfell Robb, Rickon et Bran. Lorsqu\'un assassin tente de s\'en prendre à Bran, toujours dans le coma, Catelyn décide de mener l\'enquête et de partir à Port-Réal prévenir son mari des dangers qui le guettent. Sur la longue route qui sépare Winterfell de la capitale des sept couronnes, les deux filles Stark et leurs loups vont se retrouver mêlées à un incident aux conséquences inattendues.', '55', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (3, 1, 'Saison 1', 'Épisode 3', 'Lord Snow', 'À peine arrivé à Port-Réal, Eddard Stark est convoqué à une session du Conseil Restreint et découvre alors que le Royaume est fortement endetté et doit beaucoup d\'argent aux Lannister. À Winterfell, Bran, conscient depuis peu, essaie d\'accepter son amnésie et son handicap ; pendant que sur le Mur, Jon Snow fait face à sa difficile condition de bâtard parmi ses futurs frères de la Garde de Nuit. Sur le continent est, chevauchant la longue route qui les emmène elle et son Khal vers Vaes Dothrak, Daenerys Targaryen commence à assumer son rôle de Khaleesi.', '57', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (4, 1, 'Saison 1', 'Épisode 4', 'Infirmes, Bâtards et Choses brisées', 'À Port-Réal, Eddard Stark commence son enquête pour savoir qui est impliqué dans la mort subite de son prédécesseur. Un tournoi est organisé en l\'honneur de la nouvelle Main du Roi. Au Nord, Jon Snow se prend de sympathie pour Samwell Tarly, une nouvelle recrue de la Garde de Nuit. De son côté, Tyrion Lannister, ayant quitté le Mur, se retrouve au mauvais endroit, au mauvais moment. Sur l\'autre continent, Viserys Targaryen est de plus en plus frustré…', '55', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (5, 1, 'Saison 1', 'Épisode 5', 'Le Loup et le Lion', 'À Port-Réal, les affaires politiques reprennent de plus belle. Quand le roi apprend que les Targaryen se sont alliés au peuple Dothraki, son sang ne fait qu\'un tour. En réaction, il ordonne un assassinat, contre l\'avis d\'Eddard. De son côté, ayant capturé Tyrion Lannister, Catelyn Stark l\'emmène chez sa sœur. Arya Stark, quant à elle, surprend une conversation qui menace la vie de son père…', '54', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (6, 1, 'Saison 1', 'Épisode 6', 'Une couronne d’or', 'Après avoir rendu public son profond désaccord avec le roi Robert Baratheon au sujet de l\'organisation de l\'assassinat de Daenerys Targaryen, Eddard Stark est attaqué par Jaime Lannister. L\'atmosphère à Port-Réal est plus que tendue et Eddard doit maintenant gérer de nouveaux problèmes. De son côté, à Eyrie, Tyrion Lannister est jugé pour un crime qu\'il est censé avoir commis à Winterfell. Enfin, à Vaes Dothrak, Viserys Targaryen entrevoit le fruit de ses efforts et sa récompense pour avoir donné la main de sa soeur à Khal Drogo…', '53', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (7, 1, 'Saison 1', 'Épisode 7', 'Vaincre ou mourir', 'Eddard décide qu\'il est temps d\'annoncer l\'identité du véritable père du prince Joffrey. Mourant, le souverain exige que Ned assure la régence en attendant la majorité de Joffrey. De son côté, Cersei lève une armée pour reconquérir le rang auquel son fils peut prétendre…', '58', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (8, 1, 'Saison 1', 'Épisode 8', 'Frapper d\'estoc', 'Alors que Lord Eddard Stark vient d\'être envoyé aux cachots, Cersei Lannister ordonne l\'assassinat de l\'ensemble du clan Stark. Prévenu de l\'arrestation de son père, Robb Stark met en branle les armées du nord et décide de marcher sur Port-Réal, laissant la garde de Winterfell à son frère Bran. Tyrion Lannister rejoint les armées de Lord Tywin, aidé de Bronn et des membres des Clans de la Lune rencontrés lors de sa fuite des Eyrié.', '58', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (9, 1, 'Saison 1', 'Épisode 9', 'Baelor', 'Robb Stark poursuit son avancée vers Port-Réal et décide de créer une diversion avec un plan pour le moins surprenant. De l\'autre côté du Détroit, la blessure de Khal Drogo s\'infecte et le pire est à craindre. Seule la magie semble encore capable de le sauver. À Port-Réal, lord Eddard Stark accepte de confesser ses fautes sur la place publique afin de sauver sa famille.', '56', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00'),
  (10, 1, 'Saison 1', 'Épisode 10', 'De feu et de sang', 'La terrible nouvelle se propage à travers les Sept Royaumes. Catelyn interroge Jaime Lannister à propos de la chute de son fils Bran alors que les seigneurs du Nord choisissent Robb comme nouveau roi et Jon Snow, dans la garnison de la Garde de Nuit, veut le rejoindre. Sur l\'autre continent, Daenerys doit faire face à un nouveau drame…', '53', NULL, NULL, NULL, '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `serie_episodes` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. serie_rating_systems
CREATE TABLE IF NOT EXISTS `serie_rating_systems` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `certification_country_id` int(11) DEFAULT NULL,
  `certification_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification_letter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.serie_rating_systems : ~0 rows (environ)
/*!40000 ALTER TABLE `serie_rating_systems` DISABLE KEYS */;
/*!40000 ALTER TABLE `serie_rating_systems` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.subscriptions : ~0 rows (environ)
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. subscription_items
CREATE TABLE IF NOT EXISTS `subscription_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.subscription_items : ~0 rows (environ)
/*!40000 ALTER TABLE `subscription_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_items` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT '0.00',
  `payment_method` int(11) NOT NULL DEFAULT '0',
  `plan_id` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.transactions : ~0 rows (environ)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsletter_subscription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.users : ~1 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `first_name`, `last_name`, `date_of_birth`, `gender`, `avatar`, `country_id`, `address`, `zip_code`, `city`, `newsletter_subscription`, `remember_token`, `created_at`, `updated_at`) VALUES
  (1, 'admin', 'appdevxxx@gmail.com', NULL, '$2y$10$RGgjJU9B4NW8JkdvVgjEGey/mD4PU9TcmY.b6U0ZNiDwzjWnHIdo.', 'Sébastien', 'DE SMET', '1984-06-09', 'Homme', 'media/parameters/user/avatars/admin.jpg', 61, '28 avenue Foch', '75016', 'Paris', 'Oui', 'vVAzfc8s8Hx82euUSIyMbWT9W6jMVHQcpcTBSj0EI8nqA7AAsWCr9zeC1YZA', '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. user_playlists
CREATE TABLE IF NOT EXISTS `user_playlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.user_playlists : ~1 rows (environ)
DELETE FROM `user_playlists`;
/*!40000 ALTER TABLE `user_playlists` DISABLE KEYS */;
INSERT INTO `user_playlists` (`id`, `user_id`, `film_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-01-01 00:00:00', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `user_playlists` ENABLE KEYS */;

-- Listage de la structure de la table outbuster. user_verification_tokens
CREATE TABLE IF NOT EXISTS `user_verification_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table outbuster.user_verification_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `user_verification_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_verification_tokens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
