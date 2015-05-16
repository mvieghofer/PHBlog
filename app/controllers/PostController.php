<?php
require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once('HomeController.php');

class PostController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $homeController = new HomeController();
        $homeController->indexAction();
    }
    
    public function showAction($id) {
        $post = Post::find($id);
        $this->view("post/show", $post);
    }
    
    public function addCommentAction() {
        $comment = new Comment();
        $comment->commentator = $_POST['commentator'];
        $comment->comment = $_POST['comment'];
        $comment->date = new DateTime();
        $comment->post_id = $_POST['postid'];
        
        $post = Post::find($comment->post_id);
        $post->comments()->save($comment);
        
        $url = '/';
        if ($post->ispage) {
            $url = $url . 'page';
        } else {
            $url = $url . 'post';
        }
        $url = $url . "/show/$comment->post_id";
        
        parent::redirect($url);
    }
    
    public function editAction($postid = -1) {
        $post = Post::where('id', '=', $postid)->where('ispage', '=', 0)->first();
        $data = [
            'post' => $post,
            'returnPath' => '/post/save'
        ];
        $this->view('post/edit', $data);
    }
    
    public function newAction() {
        $post = new Post();
        $post->ispage = false;
        $data = [
            'post' => $post,
            'returnPath' => '/post/save'
        ];
        $this->view('post/edit', $data);
    }
    
    public function saveAction() {
        $post = savePost(false);
        parent::redirect('/post/edit/' . $article->id);
    }
    
    protected function savePost($ispage) {
        $post = new Post();
        if (!empty($_POST['id']) && $_POST['id'] > -1) {
            $post = Post::find($_POST['id']);
        }
        $post->content = htmlspecialchars($_POST['content']);
        $post->headline = htmlspecialchars($_POST['headline']);
        $post->ispage = $ispage;
        $post->save();
        return $post;
    }
}
?>