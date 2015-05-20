<div id="form-container">
    <h1>Login</h1>
    <div id="login-error" class="error <?php if (!isset($data['errorText'])) { echo 'hidden'; } ?>">
        <p>
        <?php
        if (isset($data['errorText'])) {
            echo $data['errorText'];
        }            
        ?>
        </p>
    </div>
    <form action="<?php echo PHBlog::getUrl('/login'); ?>" method="post" id="login-form">
        <input type="text" placeholder="Email" name="email" id="email" /><br />
        <input type="password" placeholder="Password" name="password" id="password" /><br />
        <input type="checkbox" name="remember" id="remember" /><label for="remember"><span>Remember Me</span></label>
        <button type="submit">Login</button>
    </form>
    <div class="clear"></div>
    <div id="login-options">
        <a href="<?php echo PHBlog::getUrl('/password/reset'); ?>">Forgot password</a>
        |
        <a href="<?php echo PHBlog::getUrl('/register'); ?>">Register</a>
    </div>
</div>

<script type="text/javascript">
    $(function() {        
        $('#login-form').submit(function() {
            if ($('#email').val() === "" || $('#password').val() === "") {
                $('#login-error').removeClass('hidden');
                $('#login-error p').html('The username and password are both required fields.');
                return false;
            }
        });
    });
</script>