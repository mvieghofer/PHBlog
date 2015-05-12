<?php
require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once('PostController.php');

class PageController extends PostController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function showAction($id) {
        $post = Article::find($id);
        $this->view("page/show", $post);
    }
    
    public function saveAction() {
        echo "saved page";
    }
    
    public function editAction($postid = -1) {
        $post = Article::find($postid);
        $data = [
            'post' => $post,
            'returnPath' => '/page/save'
        ];
        $this->view('post/edit', $data);
    }
    
    public function newAction() {
        $post = new Article();
        $data = [
            'post' => $post,
            'returnPath' => '/page/save'
        ];
        $this->view('post/edit', $data);
    }
}
?>