<?php
require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once('PostController.php');

class PageController extends PostController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function showAction($id) {
        $post = Post::find($id);
        $this->view("post/show", $post);
    }
    
    public function editAction($postid = -1) {
        $post = Post::where('id', '=', $postid)->where('ispage', '=', true)->first();
        $data = [
            'post' => $post,
            'returnPath' => '/page/save'
        ];
        $this->view('post/edit', $data);
    }
    
    public function newAction() {
        $post = new Post();
        $post->ispage = true;
        $data = [
            'post' => $post,
            'returnPath' => '/page/save'
        ];
        $this->view('post/edit', $data);
    }
    
    public function saveAction() {
        $post = savePost(true);
        parent::redirect('/page/edit/' . $article->id);
    }
}
?>