<?php
    $servername = "dd5926.kasserver.com";
    $username = "d01deb5e";
    $password = "PHBlogPassword";
    $dbname = "d01deb5e";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>