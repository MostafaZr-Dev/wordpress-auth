<div class="auth-wrapper">
    <div class="alert" style="display: none">

    </div>
    <div class="login-wrapper">
        <?php if (isset($wp_auth_option['login_form_title'])): ?>
            <h2><?php echo $wp_auth_option['login_form_title'] ?></h2>
        <?php endif; ?>
        <form action="" method="post" id="loginForm">
            <?php if (!$wp_auth_option['login_type'] || $wp_auth_option['login_type'] == "email"): ?>
                <div class="form-row">
                    <label for="user-email">ایمیل :</label>
                    <input type="email" name="user-email" id="user-email">
                </div>
            <?php endif; ?>
            <?php if ($wp_auth_option['login_type'] == "mobile"): ?>
                <div class="form-row">
                    <label for="user-mobile">موبایل :</label>
                    <input type="text" name="user-mobile" id="user-mobile">
                </div>
            <?php endif; ?>
            <div class="form-row">
                <label for="user-password">کلمه عبور :</label>
                <input type="password" name="user-password" id="user-password">
            </div>
            <div class="form-row">
                <button name="submit-login">ورود به سایت</button>
            </div>
        </form>
    </div>
</div>