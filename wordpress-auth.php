<?php
/*
Plugin Name: wordpress auth
Plugin URI: https://mostafa-zr.com/
Description:  wordpress plugin to manage auth
Version: 1.0.0
Author: mostafa-zr
Author URI: https://mostafa-zr.com/
License: GPLv2 or later
Text Domain: wordpress-auth
Domain Path: /languages/
*/

define('WP_AUTH_DIR', plugin_dir_path(__FILE__));
define('WP_AUTH_URL', plugin_dir_url(__FILE__));
define('WP_AUTH_INC', WP_AUTH_DIR . 'inc/');
define('WP_AUTH_TPL', WP_AUTH_DIR . 'tpl/');

include WP_AUTH_INC . "functions.php";
include WP_AUTH_INC . "shortcodes.php";
include WP_AUTH_INC . "ajax.php";
if(is_admin()){
    include WP_AUTH_INC . "admin.php";
}

