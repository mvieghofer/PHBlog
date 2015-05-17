<?php

class HomeController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $articles = Post::where('ispage', '=', 0)->get();
        
        $this->view('home/index', $articles);
    }
    
    public function errorAction() {
        $this->view('404');
    }
}
?>