<?php
    require('logincookie.php');
    setcookie($_COOKIE[LOGIN_COOKIE_NAME], "", time() - 3600);
    header('Location: index.php');
?>