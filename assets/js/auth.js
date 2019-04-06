jQuery(document).ready(function ($) {
    $('#loginForm').on('submit', function (event) {
        event.preventDefault();

        let user_email, user_mobile, type;
        if(document.querySelector('#user-email')){
            type = "login_with_email";
            user_email = $("#user-email").val();
        }
        if(document.querySelector('#user-mobile')){
            type  = "login_with_mobile";
            user_mobile = $("#user-mobile").val();
        }
        let user_password = $("#user-password").val();
        let notify = $(".alert");

        if(type === "login_with_email"){
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'wp_auth_login',
                    user_data: {
                        email: (user_email)? user_email : "",
                        password: user_password
                    }
                },
                success: function (response) {

                    if(response.success){
                        let message = response.message;
                        notify.removeClass('alert-error').addClass('alert-success');
                        notify.html(`<p>${message}</p>`);
                        notify.css('display', 'block');
                        setTimeout(function () {
                            window.location.href = "/";
                        }, 2000);
                    }
                },
                error: function (error) {

                    if(error){
                        let message = error.responseJSON.message;
                        notify.addClass('alert-error');
                        notify.html(`<p>${message}</p>`);
                        notify.css('display', 'block');
                        notify.delay(2000).hide(300);

                    }
                }
            });
        }

        if(type === "login_with_mobile"){
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'wp_auth_login_with_mobile',
                    user_data: {
                        mobile: (user_mobile)? user_mobile: "",
                        password: user_password
                    }
                },
                success: function (response) {

                    if(response.success){
                        let message = response.message;
                        notify.removeClass('alert-error').addClass('alert-success');
                        notify.html(`<p>${message}</p>`);
                        notify.css('display', 'block');
                        setTimeout(function () {
                            window.location.href = "/";
                        }, 2000);
                    }
                },
                error: function (error) {

                    if(error){
                        let message = error.responseJSON.message;
                        notify.addClass('alert-error');
                        notify.html(`<p>${message}</p>`);
                        notify.css('display', 'block');
                        notify.delay(2000).hide(300);

                    }
                }
            });
        }

    });

    $('#registerForm').on('submit', function (event) {
        event.preventDefault();

        let user_first_name = $("#user_first_name").val();
        let user_last_name = $("#user_last_name").val();
        let user_email = $("#user_email").val();
        let user_mobile = $("#user_mobile").val();
        let user_password = $("#user_password").val();
        let notify = $(".alert");

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            dataType: 'json',
            data: {
                action: 'wp_auth_register',
                user_data:{
                    first_name: user_first_name,
                    last_name: user_last_name,
                    email: user_email,
                    mobile: user_mobile,
                    password: user_password
                }
            },
            success: function (response) {
                if(response.success){
                    let message = response.message;
                    notify.removeClass('alert-error');
                    notify.addClass('alert-success');
                    notify.html(`<p>${message}</p>`);
                    notify.css('display', 'block');
                    setTimeout(function () {
                        window.location.href = "/login";
                    }, 2000);
                }
            },
            error: function (error) {
                if(error){
                    let message = error.responseJSON.message;
                    notify.addClass('alert-error');
                    notify.html(`<p>${message}</p>`);
                    notify.css('display', 'block');
                    notify.delay(2000).hide(300);
                }
            }
        });
    });

});