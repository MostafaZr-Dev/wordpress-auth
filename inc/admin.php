<?php

function wp_auth_admin_settings()
{
    add_menu_page(
        'ورود و ثبت نام',
        'ورود و ثبت نام',
        'manage_options',
        'wp_auth',
        'wp_auth_settings'
    );
}
function wp_auth_settings(){
    $wp_auth_options = get_option('wp_auth_options', []);
    if(isset($_POST['saveData']) && $_GET['page'] == 'wp_auth'){
        if($_GET['tab']){
            $tab = $_GET['tab'];
        }else{
            $tab = 'general_options';
        }
    }

    switch ($tab){
        case 'general_options':
            $wp_auth_options['is_login_active'] = isset($_POST['is_login_active']);
            $wp_auth_options['is_register_active'] = isset($_POST['is_register_active']);
            $wp_auth_options['login_form_title'] = sanitize_text_field($_POST['login_form_title']);
            $wp_auth_options['register_form_title'] = sanitize_text_field($_POST['register_form_title']);
            break;
        case 'login_options':
            if($_POST['login_type'] == "email"){
                $wp_auth_options['login_type'] = "email";
            }else{
                $wp_auth_options['login_type'] = "mobile";
            }
            break;
        case 'register_options':
            $wp_auth_options['is_first_name_active'] = isset($_POST['is_first_name_active']);
            $wp_auth_options['is_last_name_active'] = isset($_POST['is_last_name_active']);
            $wp_auth_options['is_email_active'] = isset($_POST['is_email_active']);
            $wp_auth_options['is_mobile_active'] = isset($_POST['is_mobile_active']);
            $wp_auth_options['is_password_active'] = isset($_POST['is_password_active']);
            break;
    }
    update_option('wp_auth_options', $wp_auth_options);
    include WP_AUTH_TPL . "admin/settings.php";
}

add_action('admin_menu', 'wp_auth_admin_settings');