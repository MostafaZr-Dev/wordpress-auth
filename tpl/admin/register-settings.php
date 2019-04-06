<tr valign="center">
    <th scope="row">نمایش فیلد های ثبت نام</th>
</tr>
<tr valign="center">
    <td>
        <label for="first_name">نام</label>
        <input type="checkbox" name="is_first_name_active" id="first_name" <?php echo $wp_auth_options['is_first_name_active'] ? "checked" : "" ?>/>
        <label for="last_name">نام خانوادگی</label>
        <input type="checkbox" name="is_last_name_active" id="last_name" <?php echo $wp_auth_options['is_last_name_active'] ? "checked" : "" ?>/>
        <label for="email">ایمیل</label>
        <input type="checkbox" name="is_email_active" id="email" <?php echo $wp_auth_options['is_email_active'] ? "checked" : "" ?>/>
        <label for="mobile">موبایل</label>
        <input type="checkbox" name="is_mobile_active" id="mobile" <?php echo $wp_auth_options['is_mobile_active'] ? "checked" : "" ?>/>
        <label for="password">رمزعبور</label>
        <input type="checkbox" name="is_password_active" id="password" <?php echo $wp_auth_options['is_password_active'] ? "checked" : "" ?>/>
    </td>
</tr>
