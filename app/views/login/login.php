<div id="form-container">
    <h1>Login</h1>
    <div class="error hidden">
        <p>The username or password was not correct.</p>
    </div>
    <form action="<?php echo PHBlog::getUrl('/login/login'); ?>" method="post">
        <input type="text" placeholder="Email" name="login" /><br />
        <input type="password" placeholder="Password" name="password" /><br />
        <button type="submit">Login</button>
    </form>
    <div class="clear"></div>
    <div id="login-options">
        <a href="<?php echo PHBlog::getUrl('/login/reset'); ?>">Forgot password</a>
        |
        <a href="<?php echo PHBlog::getUrl('/login/register'); ?>">Register</a>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var url = window.location.search;
        url = url.substring(1);
        parts = url.split('&');
        for (i = 0; i < parts.length; i++) {
            entry = parts[i].split('=');
            if (entry[0] === 'error' && entry[1] === 'true') {
                $('.error').removeClass('hidden');
            }
        }
        window.history.pushState("", "", window.location.origin + window.location.pathname);
    });
</script>