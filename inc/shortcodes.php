<?php
function wp_auth_login_handler($attr, $content = null){
    $wp_auth_option = get_option('wp_auth_options', []);
    if(isset($wp_auth_option['is_login_active']) && !$wp_auth_option['is_login_active']){
        return "<div><p class='no-login'>امکان ورود در حال حاضر وجود ندارد!</p></div>";
    }
    include WP_AUTH_TPL . "front/login.php";
}

function wp_auth_register_handler($attr, $content = null){
    $wp_auth_option = get_option('wp_auth_options', []);
    if(isset($wp_auth_option['is_register_active']) && !$wp_auth_option['is_register_active']){
        return "<div><p class='no-login'>امکان ثبت نام در حال حاضر وجود ندارد!</p></div>";
    }
    include WP_AUTH_TPL . "front/register.php";
}

add_shortcode('wp_auth_login', 'wp_auth_login_handler');
add_shortcode('wp_auth_register', 'wp_auth_register_handler');