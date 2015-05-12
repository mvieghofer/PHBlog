<?php
    require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(APP_PATH . "/core/PHBlog.php");
    require_once(APP_PATH . '/core/Controller.php');
    
    $app = new PHBlog();
?>