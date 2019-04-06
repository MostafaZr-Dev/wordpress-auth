<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h1 class="header-options">تنظیمات ورود و ثبت نام</h1>

    <?php include WP_AUTH_TPL . "admin/tabs-settings.php"; ?>

    <form action="" method="post">
        <table class="widefat fixed table-auth">
            <?php
            switch ($active_tab) {
                case 'general_options':
                    include WP_AUTH_TPL . 'admin/general-settings.php';
                    break;
                case 'login_options':
                    include WP_AUTH_TPL . 'admin/login-settings.php';
                    break;
                case 'register_options':
                    include WP_AUTH_TPL . 'admin/register-settings.php';
                    break;
            }
            ?>
            <tr valign="top">
                <td style="text-align: center">
                    <input type="submit" name="saveData" class="button button-auth" value="ذخیره سازی"/>
                </td>
            </tr>
        </table>
    </form>
</div>