<div id="form-container">
    <h1>Reset Password</h1>
    <div id="error-container" class="error hidden">
        <p></p>
    </div>
    <form action="<?php echo Router::getUrl('/password/reset'); ?>" method="post" id="login-form">
        <input type="text" placeholder="Email" name="email" id="email" /><br />
        <button type="submit">Reset password</button>
    </form>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(function() {        
        $('#login-form').submit(function() {
            var re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!re.test($('#email').val())) {
                $('#error-container').removeClass('hidden');
                $('#error-container p').html('The email address isn\'t a valid email address.');
                return false;
            }
        });
    });
</script>