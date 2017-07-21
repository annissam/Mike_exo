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
define('DB_NAME', 'hairdresser');

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
define('AUTH_KEY',         '<a?azi9Mzfh< !PXbE_|jlX-|]xBeqJPnrG=_OGL[g7&H22H7)kckY~<E=_N7W,e');
define('SECURE_AUTH_KEY',  '?S`/nUPRX[fzK!,Ne<(UE(.3L1l0s8f#=iNO+c_^ul~>]c{.)NttlKy?8qw3kHKh');
define('LOGGED_IN_KEY',    'hUJ=`s).Z=9XRIe4S6QaToxO3+6-EN}hxvg;)!EKpyA_5$_q=Iy(#R8c:88M_7Sr');
define('NONCE_KEY',        'm{u%So!f8|VI 1/7VoFj&GfEi)T^!9OPr<_I&6Ezz~Vtt-:s&<4kQwUIBqsh]8qu');
define('AUTH_SALT',        ',>q%A/!S<`o!msLSP+N_FHDvV?;9N[*4/yZ96X|a}qqhaAcG%k0DfUj2Hi7!&GO@');
define('SECURE_AUTH_SALT', '+lTF2[Otf8rk!}{E8P1T{;1dmR1:?G+4}:auJPt?+nBW7B0wo1L[cR5#6`=I9xYu');
define('LOGGED_IN_SALT',   'qa2Y|H{O*]pF}@EkgJF~vrPM=1Rx4!.;Wm  53W8-yUfOqQACP`|hhdUBmM[T95#');
define('NONCE_SALT',       '@R@Z=fGvd^&6Bt>c13nWReT*0G{2@m7#wc3NbK#*<dSs(exeMQ>r[,NIjgwt~q0D');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'hair_';

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