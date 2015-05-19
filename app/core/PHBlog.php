<?php

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));
require_once(DB_PATH);
    
class PHBlog {
    private $controller = 'HomeController';
    
    private $errorMethod = 'errorAction';
    
    private $method = 'indexAction';
    
    private $params = [];
    
    public function __construct() {
        $url = $this->parseUrl();
        
        if (isset($url[0])) {
            $controllerName = $this->getControllerName($url[0]);
            if (file_exists($this->getControllerFileName($controllerName))) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                $this->method = $this->errorMethod;
            }
        }
    
        require_once($this->getControllerFileName($this->controller));
    
        $this->controller = new $this->controller;
        
        if ($this->method !== $this->errorMethod && isset($url[1])) {
            if (method_exists($this->controller, $url[1] . 'Action')) {
                $this->method = $url[1] . 'Action';
                unset($url[1]);
            }
        }
        
        $this->params = $url ? array_values($url) : [];
        
        call_user_func_array([$this->controller, $this->method], $this->params);        
    }
    
    protected function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
    
    protected function getControllerFileName($controllerName) {
        return APP_PATH . '/controllers/' . $controllerName . '.php';
    }
    
    protected function getControllerName($param) {
        return ucfirst($param) . 'Controller';
    }
    
    public static function getUrl($url) {
        if (substr($url, 0, 1) !== '/') {
            $url = '/' . $url;
        }
        return '/phblog' . $url;
    }
    
    public function isLoggedId($token) {
        $user = User::where('token', '=', $token)->first();
        return $user->remember_until >= new DateTime();
    }
}
?>