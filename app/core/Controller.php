<?php
namespace core;
require_once("db.php");

class Controller {
    protected $view;
    
    public function __construct() {
        $this->view = new View();
    }
}
?>