<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'megalux');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', '');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'nd`_tG0OwG1geKOc.,c= fhH{m*&(6CS(OL?J<Y?=`~G{;`zB7ON*3Z+$idnbNSm');
define('SECURE_AUTH_KEY', 'DHz_OLE 07M0U47#f-MvV-fJmM<yPrASak^e*8^!mJ =$g6Oy&TP<X,d*)g;wPVJ');
define('LOGGED_IN_KEY', 'F-}9&@YK0K2`Mc[2B{CWoKj1<a5t14b-ht,&deZ.pHn)a7uwDu,F_WM-$nQmt-MC');
define('NONCE_KEY', 'U$b/By^{V/Bf87J}R9*agIS8`L`Ow?>~L8ZH:U9[<Me@z4G s{|#xdHI;S@@#?2 ');
define('AUTH_SALT', 'C^HL5fk^5}[#=3H~!UV[,&=dwxPA^tmSKOg(y; f?H-Yz{q:8AdNYo@:$MjA*} &');
define('SECURE_AUTH_SALT', '%9uuFKU8qGDc%!lWQ>O:m#rG]tSNu;a{9x=x>wj2tOFVi0%D:|K/&RA6L[|igVMf');
define('LOGGED_IN_SALT', '(.!kkd}.K]WR,j1wk>f)Z2.[nY}`PdyqdC4dUQVT=RzCsi))6N_<mI`R6Djv3=JW');
define('NONCE_SALT', '~&T>Fpu/kD^8z9t9gwK/kTc;AXW39Fu/ev99S<#5e--X32LPC<;60V4OB] ^&uz<');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'tgBhj4D_';


/**
 * Multisite
*/
define('WP_ALLOW_MULTISITE', true);

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/megalux/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', true);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

