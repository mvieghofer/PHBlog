<?php
    require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(APP_PATH . '/core/Controller.php');
    require_once(APP_PATH . '/core/Router.php');
    
    $router = new Router();
    
    $router->get('/', 'HomeController#indexAction');
    $router->get('/404', 'HomeController#errorAction');
    
    $router->get('/login', 'LoginController#indexAction');
    
    $router->get('/logout', 'LogoutController#indexAction');
    
    $router->get('/dashboard', 'DashboardController#indexAction');
    
    $router->get('/page/\d+', 'PageController#showAction');
    $router->get('/page/new', 'PageController#newAction');
    $router->get('/page/save', 'PageController#saveAction');
    $router->get('/page/edit/\d+', 'PageController#editAction');
    
    $router->get('/post/\d+', 'PostController#showAction');
    $router->get('/post/new', 'PostController#newAction');
    $router->get('/post/save', 'PostController#saveAction');
    $router->get('/post/edit/\d+', 'PostController#editAction');
    
    $router->get('/password/new/*.*', 'PasswordController#newAction');
    $router->get('/password/reset', 'PasswordController#resetAction');
    
    $router->get('/register', 'RegisterController#indexAction');
    $router->get('/register/activate/.+', 'RegisterController#activateAction');
    
    $router->get('/api/test', 'RESTController#get');
    $router->post('/api/test', 'RESTController#post');
    $router->put('/api/test', 'RESTController#put');
    $router->delete('/api/test', 'RESTController#delete');
    
    $router->add('/api/test/multi', 'RESTController#multi', ['GET', 'POST', 'PUT', 'DELETE']);
    
    $router->run();
?>