<?php
function wp_auth_do_login(){
    $user_email = sanitize_text_field($_POST['user_data']['email']);
    $user_password = sanitize_text_field($_POST['user_data']['password']);

    $validation_result = wp_auth_validate_email_and_password($user_email, $user_password);

    if(!$validation_result['is_valid']){
        wp_send_json([
            "success" => false,
            "message" => $validation_result['message']
        ], 403);
    }

    $user = wp_authenticate_email_password(null, $user_email, $user_password);
    if(is_wp_error($user)){
        wp_send_json([
            "success" => false,
            "message" => "کاربری با این مشخصات در سیستم یافت نشد!"
        ], 403);
    }

    $login_result = wp_signon([
        'user_login' => $user -> user_login,
        'user_password' => $user_password,
        'remember' => false
    ]);

    if(is_wp_error($login_result)){
        wp_send_json([
            "success" => false,
            "message" => "درحال حاضر امکان ورود به سایت وجود ندارد! بعدا امتحان کنید!"
        ], 403);
    }

    wp_send_json([
        "success" => true,
        "message" => "عملیات ورود با موفقیت انجام شد"
    ], 200);

}
function wp_auth_validate_email_and_password($email, $password){
    $result = [
        "is_valid" => true,
        "message" => ""
    ];
    if(is_null($email) || empty($email)){
        $result["is_valid"] = false;
        $result["message"] = "ایمیل نمی تواند خالی باشد!";
        return $result;
    }
    if(is_null($password) || empty($password)){
        $result["is_valid"] = false;
        $result["message"] = "رمز عبور نمی تواند خالی باشد!";
        return $result;
    }
    if(!is_email($email)){
        $result["is_valid"] = false;
        $result["message"] = "ایمیل وارد شده معتبر نمی باشد!";
        return $result;
    }

    return $result;
}

function wp_auth_do_login_with_mobile(){
    $user_mobile = sanitize_text_field($_POST['user_data']['mobile']);
    $user_password = sanitize_text_field($_POST['user_data']['password']);

    $validation_result = wp_auth_validate_mobile_and_password($user_mobile, $user_password);

    if(!$validation_result['is_valid']){
        wp_send_json([
            "success" => false,
            "message" => $validation_result['message']
        ], 403);
    }

    $user = get_users([
        'meta_key' => 'user_mobile',
        'meta_value' => $user_mobile,
        'number' => 1,
        'count_total' => false
    ]);

    if($user){
        if(wp_check_password($user_password, $user[0]->data->user_pass, $user[0]->data->ID)){
            $login_result = wp_signon([
                'user_login' => $user[0]->data->user_login,
                'user_password' => $user_password,
                'remember' => false
            ]);
        }else{
            wp_send_json([
                "success" => false,
                "message" => "رمز عبور اشتباه است!"
            ], 403);
        }
    }else{
        wp_send_json([
            "success" => false,
            "message" => "کاربری با این مشخصات در سیستم وجود ندارد!"
        ], 403);
    }

    if(is_wp_error($login_result)){
        wp_send_json([
            "success" => false,
            "message" => "درحال حاضر امکان ورود به سایت وجود ندارد! بعدا امتحان کنید!"
        ], 403);
    }

    wp_send_json([
        "success" => true,
        "message" => "عملیات ورود با موفقیت انجام شد"
    ], 200);
}
function wp_auth_validate_mobile_and_password($mobile, $password){
    $result = [
        "is_valid" => true,
        "message" => ""
    ];

    if(is_null($mobile) || empty($mobile)){
        $result["is_valid"] = false;
        $result["message"] = "موبایل نمی تواند خالی باشد!";
        return $result;
    }

    if(is_null($password) || empty($password)){
        $result["is_valid"] = false;
        $result["message"] = "رمز عبور نمی تواند خالی باشد!";
        return $result;
    }

    if(!preg_match('/^[0][1-9]\d{9}$|^[1-9]\d{9}$/', $mobile)){
        $result["is_valid"] = false;
        $result["message"] = "شماره موبایل وارد شده معتر نیست!";
        return $result;
    }


    return $result;
}
add_action('wp_ajax_nopriv_wp_auth_login', 'wp_auth_do_login');
add_action('wp_ajax_nopriv_wp_auth_login_with_mobile', 'wp_auth_do_login_with_mobile');

function wp_auth_do_register(){
    $user_first_name = sanitize_text_field($_POST['user_data']['first_name']);
    $user_last_name = sanitize_text_field($_POST['user_data']['last_name']);
    $user_email = sanitize_text_field($_POST['user_data']['email']);
    $user_mobile = sanitize_text_field($_POST['user_data']['mobile']);
    $user_password = sanitize_text_field($_POST['user_data']['password']);

    $validate_result = validate_register_request($user_first_name, $user_last_name, $user_email, $user_mobile, $user_password);
    $mobile_exist = get_users([
        'meta_key' => 'user_mobile',
        'meta_value' => $user_mobile,
        'number' => 1,
        'count_total' => false
    ]);

    if(!$validate_result['is_valid']){
        wp_send_json([
            'success' => false,
            'message' => $validate_result['message']
        ], 422);
    }

    if(!empty($mobile_exist)){
        wp_send_json([
            'success' => false,
            'message' => "شماره موبایل وجود دارد!"
        ], 422);
    }



    $user_email_parts = explode("@", $user_email);

    $new_user = wp_insert_user([
       'user_login' => apply_filters('pre_user_login', $user_email_parts[0].rand(1000, 9999)),
       'user_pass' => apply_filters('pre_user_pass', $user_password),
        'user_email' => apply_filters('pre_user_email', $user_email),
        'first_name' => apply_filters('pre_user_first_name', $user_first_name),
        'last_name' => apply_filters('pre_user_last_name', $user_last_name),
        'display_name' => apply_filters('pre_user_display_name', "{$user_first_name} {$user_last_name}")
    ]);

    if(is_wp_error($new_user)){
        wp_send_json([
            'success' => false,
            'message' => "خطایی در ثبت نام شما رخ داده است! بعدا امتحان کنید!"
        ], 500);
    }

    add_user_meta($new_user, 'user_mobile', $user_mobile);

    wp_send_json([
        'success' => true,
        'message' => "ثبت نام شما با موفقیت انجام شد."
    ], 200);

}
function validate_register_request($first_name, $last_name, $email,$mobile, $password)
{
    $result = [
        "is_valid" => true,
        "message" => ""
    ];

    if(empty($first_name) || empty($last_name) || empty($email) || empty($mobile) || empty($password)){
        $result['is_valid'] = false;
        $result['message'] = "تمامی فیلدها الزامی می باشد!";
        return $result;
    }

    if(!is_email($email)){
        $result['is_valid'] = false;
        $result['message'] = "ایمیل وارد شده معتبر نیست!";
        return $result;
    }

    if(email_exists($email)){
        $result['is_valid'] = false;
        $result['message'] = "این آدرس ایمیل در دسترس نمی باشد!";
        return $result;
    }

    if(!preg_match('/^[0][1-9]\d{9}$|^[1-9]\d{9}$/', $mobile)){
        $result["is_valid"] = false;
        $result["message"] = "شماره موبایل وارد شده معتر نیست!";
        return $result;
    }

    return $result;
}
add_action('wp_ajax_nopriv_wp_auth_register', 'wp_auth_do_register');



