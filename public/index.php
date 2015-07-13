<?php
    require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(APP_PATH . '/core/Controller.php');
    require_once(APP_PATH . '/core/Router.php');
    
    $router = new Router();
    
    $router->add('/', 'HomeController#indexAction');
    $router->add('/404', 'HomeController#errorAction');
    
    $router->add('/login', 'LoginController#indexAction');
    
    $router->add('/logout', 'LogoutController#indexAction');
    
    $router->add('/dashboard', 'DashboardController#indexAction');
    
    $router->add('/page/\d+', 'PageController#showAction');
    $router->add('/page/new', 'PageController#newAction');
    $router->add('/page/save', 'PageController#saveAction');
    $router->add('/page/edit/\d+', 'PageController#editAction');
    
    $router->add('/post/\d+', 'PostController#showAction');
    $router->add('/post/new', 'PostController#newAction');
    $router->add('/post/save', 'PostController#saveAction');
    $router->add('/post/edit/\d+', 'PostController#editAction');
    
    $router->add('/password/new/*.*', 'PasswordController#newAction');
    $router->add('/password/reset', 'PasswordController#resetAction');
    
    $router->add('/register', 'RegisterController#indexAction');
    $router->add('/register/activate/.+', 'RegisterController#activateAction');
    
    $router->run();
?>