<tr valign="center">
    <th scope="row">نوع ورود</th>
</tr>
<tr valign="center">
    <td>
        <label for="email-pass">ورود با ایمیل و رمز عبور</label>
        <input type="radio" name="login_type" id="email-pass" value="email" <?php echo (!$wp_auth_options['login_type'] || $wp_auth_options['login_type'] == "email")? "checked": "" ?> />
        <label for="mobile-pass">ورود با موبایل و رمز عبور</label>
        <input type="radio" name="login_type" id="mobile-pass" value="mobile" <?php echo ($wp_auth_options['login_type'] == "mobile")? "checked" : "" ?>/>
    </td>
</tr>


