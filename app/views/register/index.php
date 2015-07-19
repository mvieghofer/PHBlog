<div id="form-container">
    <h1>Register</h1>
    <div id="error-container" class="error <?php if (!isset($data['errorText'])) { echo 'hidden'; } ?>">
        <p>
        <?php
        if (isset($data['errorText'])) {
            echo $data['errorText'];
        }            
        ?>
        </p>
    </div>
    <form action="<?php echo Router::getUrl('/register'); ?>" method="post" id="register-form">
        <input type="hidden" name="csrftoken" value="<?php echo $data['csrftoken'] ?>"><br />
        <input type="text" placeholder="Email" name="email" id="email" /><br />
        <input type="text" placeholder="First Name" name="first" id="first" /><br />
        <input type="text" placeholder="Last Name" name="last" id="last" /><br />
        <input type="password" placeholder="Password" name="password" id="password" /><br />
        <input type="password" placeholder="Repeat Password" name="password_repeat" id="password_repeat" /><br />
        <button type="submit">Register</button>
    </form>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(function() {     
        $('#register-form').submit(function() {
            var re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!re.test($('#email').val())) {
                $('#error-container').removeClass('hidden');
                $('#error-container p').html('The email address isn\'t a valid email address.');
                return false;
            }
            
            if ($('#password').val() !== $('#password_repeat').val()) {
                $('#error-container').removeClass('hidden');
                $('#error-container p').html('The password do not match!');
                return false;
            }
            
            if ($('#password').val().length < 8) {
                $('#error-container').removeClass('hidden');
                $('#error-container p').html('The password is too short.');
                return false;
            }
            
            if ($('#email').val() === "" || $('#password').val() === "") {
                $('#error-container').removeClass('hidden');
                $('#error-container p').html('The username and password are both required fields.');
                return false;
            }
        });
    });
</script>