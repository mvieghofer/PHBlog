<div id="form-container">
    <h1>New Password</h1>
    <div id="error-panel" class="error <?php if (!isset($data['errorText'])) { echo 'hidden'; } ?>">
        <p>
        <?php
        if (isset($data['errorText'])) {
            echo $data['errorText'];
        }            
        ?>
        </p>
    </div>
    <form action="<?php echo Router::getUrl('/password/new'); ?>" method="post" id="password-form">
        <input type="hidden" name="token" value="<?php echo $data['token']; ?>" /><br />
        <input type="password" placeholder="Password" name="password" id="password" /><br />
        <input type="password" placeholder="Repeat Password" name="password_repeat" id="password_repeat" /><br />
        <button type="submit">Reset password</button>
    </form>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(function() {        
        $('#password-form').submit(function() {
            if ($('#password').val() !== $('#password_repeat').val()) {
                $('#error-panel').removeClass('hidden');
                $('#error-panel p').html('The password do not match!');
                return false;
            }
            
            if ($('#password').val().length < 8) {
                $('#error-panel').removeClass('hidden');
                $('#error-panel p').html('The password is too short.');
                return false;
            }
        });
    });
</script>