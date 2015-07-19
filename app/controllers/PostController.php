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
        $data = $this->getData($post, null);
        $this->view("post/show", $data);
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
        $url = $url . "/$comment->post_id";
        
        parent::redirect($url);
    }
    
    public function editAction($postid = -1) {
        $post = Post::where('id', '=', $postid)->where('ispage', '=', 0)->first();
        $data = $this->getData($post);
        $this->showEditView($data);
    }
    
    public function newAction() {
        $post = new Post();
        $post->ispage = false;
        $data = $this->getData($post);
        $this->showEditView($data);
    }
    
    public function saveAction() {
        if (strcmp($_POST['csrftoken'], $_COOKIE[Config::$csrfTokenCookieName]) !== 0) {
            $postid = $_POST['id'];
            $post = Post::where('id', '=', $postid)->where('ispage', '=', 0)->first();
            $data = $this->getData($post);
            $data['errorText'] = 'We could not save the post.';
            $this->showEditView($data);
        } else {
            $post = $this->savePost(false);
            parent::redirect('/post/edit/' . $post->id);
        }
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
    
    protected function showEditView($data) {
        $viewPath = APP_PATH . '/views/post/edit.php';
        if (file_exists($viewPath)) {
            $this->view->renderWithoutNavigation($viewPath, $data);
        }
    }
    
    protected function getData($post, $returnPath = '/post/save') {
        $data = [
            'csrftoken' => $this->updateCSRFToken('/post'),
            'post' => $post
        ];
        if ($returnPath !== null) {
            $data['returnPath'] = $returnPath;
        }
        return $data;
    }
}
?>