<?php

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));
require_once(DB_PATH);
    
class Router {
    private $controller = 'HomeController';
    
    private $errorMethod = 'errorAction';
    
    private $method = 'indexAction';
    
    private $params = [];
    
    private $urlMap = [];
    
    public function __construct() {
                
    }
    
    public function add($uri, $function) {
        $uri = str_replace('/', '\/', $uri);
        $this->urlMap[$uri] = $function;
    }
    
    public function run() {
        $url = '/';
        if (isset($_GET['url'])) {
            $url .=  $_GET['url'];
        }
        foreach ($this->urlMap as $key => $value) {
            if (preg_match("/^$key$/", $url)) {
                $this->mapUrl($url, $key, $value);
            }
        }
        /*if (isset($url[0])) {
            
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
        
        call_user_func_array([$this->controller, $this->method], $this->params);*/
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
        return '' . $url;
    }
    
    public static function getAbsoluteUrl($url) {
        $url = Router::getUrl($url);
        return Config::$baseUrl . $url;
    }
    
    private function mapUrl($url, $key, $function) {
        if (is_string($function)) {
            $params = $this->getParamsFromUrl($url, $key);
            $params = $params ? array_values($params) : [];
            $function = explode('#', $function);
            require_once($this->getControllerFileName($function[0]));
            $controller = new $function[0];
            call_user_func_array([$controller, $function[1]], $params);
        } else {
            call_user_func($function);
        }
    }
    
    private function getParamsFromUrl($url, $regex) {
        if (isset($url) && isset($regex)) {
            $regex = str_replace('\/', '/', $regex);
            $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
            $regex = explode('/', filter_var(rtrim($regex, '/'), FILTER_SANITIZE_URL));
            if (sizeof($url) != sizeof($regex)) {
                return [];
            }
            foreach ($url as $index => $value) {
                if ($regex[$index] == $value) {
                    unset($url[$index]);
                }
            }
            return $url;
        }
    }
}
?>