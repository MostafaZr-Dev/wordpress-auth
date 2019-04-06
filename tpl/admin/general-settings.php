<tr valign="center">
    <th scope="row">فعال بودن ورود</th>
    <td>
        <input type="checkbox"
               name="is_login_active" <?php echo $wp_auth_options['is_login_active'] ? "checked" : "" ?> />
    </td>
</tr>
<tr valign="center">
    <th scope="row">فعال بودن ثبت نام</th>
    <td>
        <input type="checkbox"
               name="is_register_active" <?php echo $wp_auth_options['is_register_active'] ? "checked" : "" ?> />
    </td>
</tr>
<tr valign="center">
    <th scope="row">عنوان فرم ورود</th>
    <td>
        <input type="text" name="login_form_title"
               value="<?php echo isset($wp_auth_options['login_form_title']) ? $wp_auth_options['login_form_title'] : '' ?>"/>
    </td>
</tr>
<tr valign="center">
    <th scope="row">عنوان فرم ثبت نام</th>
    <td>
        <input type="text" name="register_form_title"
               value="<?php echo isset($wp_auth_options['register_form_title']) ? $wp_auth_options['register_form_title'] : '' ?>"/>
    </td>
</tr>
