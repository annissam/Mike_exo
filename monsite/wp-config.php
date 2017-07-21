<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'monsite');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':+S^VQ {jCS~q;dJ2TPKqMI-H;O]+G/OqL]neY/eJlO)CYMBFYEt@qZ%TS`JT4qR');
define('SECURE_AUTH_KEY',  '86P|49$=&AGOCHO4jU2rR;x:v5Ahz>h5b$xL-z]:v^cbN:p!>0#1`0&Z5b[}frzC');
define('LOGGED_IN_KEY',    '_T:b25C?=cXURC3FC@X=p93YKWwB&@G+I$gwoej*[8T>.ove*g|Rq1!C?(h3[Tk7');
define('NONCE_KEY',        'AWl-,@W/:CWVi}ZB_]]O;3J*o3JyN!eY9TLb8lgI]St%jqk?788s@@;A=`p7QWpm');
define('AUTH_SALT',        '.Yxc,vL2L0@z-G l>XhEBW#}I-WIuQ4Eq+K+nrs9U>F$=N&j_ThkXp<N[Zx[d1~]');
define('SECURE_AUTH_SALT', 'k~mZXh<ol^DqSqAVVEKt8 )JJ(5+dY~oLPHd3GkbV6`3F]KBSJt$HlEPup=7c><j');
define('LOGGED_IN_SALT',   'uW5dWR!}A/3L*G/r3I%B3ivIjM7T-edrTGx(;F7k4m*o,@+dt2fIy%gBzvK)b5k^');
define('NONCE_SALT',       '~<YVq K%-_crWyr=*EiL0S;fA)Z4[j]:hZZ$or.05|JlKvnS(H_0@7)L>q<Bp|1j');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'ms__';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');