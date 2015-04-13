<?php
    require('logincookie.php');
    //unset($_COOKIE[LOGIN_COOKIE_NAME]);
    setcookie($_COOKIE[LOGIN_COOKIE_NAME], "", time() - 3600);
    header('Location: index.php');
?>