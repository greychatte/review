<div class="container login">
    <div class="loginform">
        <div class="loginform-header"><?php echo $txt_title_admin_header; ?></div>
        <div class="loginform-body">
            <form action="/admin" method="post">
                <div class="input-field">
                    <input class="validate" type="text" name="login" id="login" required>
                    <label for="login"><i class="tiny material-icons">person</i><?php echo $txt_login; ?></label>
                </div>
                <div class="input-field">
                    <input class="validate" type="password" name="password" id="password" minlength="6" maxlength="32" pattern="[0-9a-zA-Z!@#$%^&*+_-]{6,32}" required>
                    <label for="password"><i class="tiny material-icons">lock</i>Пароль</label>
                    <span toggle="#password-field" class="fa-eye toggle-password"></span>
                </div>
                <button type="submit" class="btn waves-effect waves-light"><?php echo $txt_login_action; ?></button>
            </form>
        </div>
    </div>
</div>
<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye-slash");
        const input = $('input[name=password]');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>