<?php

class HomeController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $articles = Article::where('ispage', '=', 0)->get();
        
        $this->view('home/index', $articles);
    }
}
?>