<?php
function wp_load_assets(){
    wp_register_style('wp_auth_style', WP_AUTH_URL . "assets/css/auth.css");
    wp_enqueue_style('wp_auth_style');

    wp_register_script('wp_auth_script', WP_AUTH_URL . "assets/js/auth.js", ['jquery']);
    wp_enqueue_script('wp_auth_script');
}
function wp_admin_load_assets(){
    wp_register_style('wp_admin_auth_style', WP_AUTH_URL . "assets/css/admin-auth.css");
    wp_enqueue_style('wp_admin_auth_style');
}
add_action('wp_enqueue_scripts', 'wp_load_assets');
add_action('admin_enqueue_scripts', 'wp_admin_load_assets');
