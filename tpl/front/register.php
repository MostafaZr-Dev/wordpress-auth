<div class="auth-wrapper">
    <div class="alert" style="display: none">

    </div>
    <div class="register-wrapper">
        <?php if (isset($wp_auth_option['register_form_title'])): ?>
            <h2><?php echo $wp_auth_option['register_form_title'] ?></h2>
        <?php endif; ?>
        <form action="" method="post" id="registerForm">
            <?php if ($wp_auth_option['is_first_name_active']): ?>
                <div class="form-row">
                    <label for="user_first_name">نام :</label>
                    <input type="text" name="user_first_name" id="user_first_name">
                </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['is_last_name_active']): ?>
            <div class="form-row">
                <label for="user_last_name"> نام خانوادگی :</label>
                <input type="text" name="user_last_name" id="user_last_name">
            </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['is_email_active']): ?>
            <div class="form-row">
                <label for="user_email">ایمیل :</label>
                <input type="email" name="user_email" id="user_email">
            </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['is_mobile_active']): ?>
                <div class="form-row">
                    <label for="user_mobile">موبایل :</label>
                    <input type="text" name="user_mobile" id="user_mobile">
                </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['is_password_active']): ?>
                <div class="form-row">
                    <label for="user_password">کلمه عبور :</label>
                    <input type="password" name="user_password" id="user_password">
                </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['is_first_name_active'] || $wp_auth_option['is_last_name_active'] || $wp_auth_option['is_email_active'] || $wp_auth_option['is_password_active']): ?>
            <div class="form-row">
                <button name="submit_register">ثبت نام</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>