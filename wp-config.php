<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'BeSeed_group');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'j/T:>2_i$]fIKDfPFNu?c6LL{>x3Cwj6O9);-tOPC)=MsMO)5sIh h*hRgi(e6$|');
define('SECURE_AUTH_KEY',  'zoEe40(SG> |5}31Cot?S1%T+!/-{N:9wo_dA0Y<*FIf1:z#w[wq77T%J&]<UZUT');
define('LOGGED_IN_KEY',    'j20Nd,ySejNS/Xz!/PGH$mkEy#*7E4FSeOB]{e(+7O0a.U7,*K!;ZOZ<i{rl>t_Z');
define('NONCE_KEY',        '$5km3zfvwd.J oc7DBSN,Am6NXtbwtWX6+gE{I>9.6@-.svXzbZQQ`Qf2.POT u#');
define('AUTH_SALT',        'Gtr*BU|Q!lIY5/mw x2YkDzRPi7eIir$77oJlw~IMh>U_p:0F$s&8Hpne3GxE|yF');
define('SECURE_AUTH_SALT', ',9ig})Fvv7r{_4|aUUm3;;>?2hGN#u%8Z/|qu8b|vCjT1O]6lup>EFnM*ck(.akQ');
define('LOGGED_IN_SALT',   ';5AFR36nkX><;1AU@U=*6~B5pAk6uGpnu*&o<_36S*j2-Dq^5K$@K0I:/?fA4-4u');
define('NONCE_SALT',       'M|+i~4il]X*v(pOEVZmkifN|/uuoql}}3K9u<k626*JU(HfWfPide4HLq95=|+bK');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
