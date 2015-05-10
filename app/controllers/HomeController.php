<?php

require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once(APP_PATH . '/core/Controller.php');
require_once(APP_PATH . '/controllers/ArticleController.php');

class HomeController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $arcticleController = new ArticleController();
        $articles = $arcticleController->loadAllArticlesAction();
        
        $this->view('home/index');
    }
}
?>