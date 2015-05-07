<?php
namespace controller;

class HomeController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function displayHomeAction() {
        $arcticleController = new ArticleController();
        $articles = $arcticleController->displayAllArticlesAction();
        
        $view->render("home", array("articles" => $articles));
    }
}
?>