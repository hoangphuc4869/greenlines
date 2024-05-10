<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'greenlines' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'E.z,6t<*AK*`9{XkM<y>w7KYd)rb:2J6km89{i5Ng-*ACTAt/m=}5%4;s!r;[^G0' );
define( 'SECURE_AUTH_KEY',  ')@}Ttb$/DjNpx/yRRv3icpu+%g]%a@XvsLUZC.V+qGg:)76xe,GCN[6HQ%}3L.y8' );
define( 'LOGGED_IN_KEY',    'o#HSb@8~)}b[<&YH`m_AsPOzQHyq^=%AovO|Q}(@WQ^SRM<3k_:t*4@2b0b_TJd+' );
define( 'NONCE_KEY',        'p{c|k1CEXBTC9O-=3rb&<oyRW.36R)NShSD^MV,4XL=H>CCirc=l5P}Rapb5[:ud' );
define( 'AUTH_SALT',        'FiU^jg+}+I7VJRt-VPg;0[jl%xz|3)v:$}{TdUNB+6iB(gnZP]k_}X=>~hd9:mwm' );
define( 'SECURE_AUTH_SALT', ',S e-%l]n?.ErZ;,1]]:SN3o opkNnHAOfR]Mnkr*,Ui5{4$y,magt-V5<1]??}~' );
define( 'LOGGED_IN_SALT',   'mrVT]J^ya{`)y+b{_EU>+LC>f3;Ig,MgO,8(z?R|aG[8hjg_N)U+,<*X@,;A}~|4' );
define( 'NONCE_SALT',       'REN({Lf}!,BdImg>q-8?TKh{}JkKu}]Yxbm6V7_w<6lJHE{T)j7Q[bM__FM_)>8@' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
