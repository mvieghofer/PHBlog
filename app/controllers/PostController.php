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
        $comment->articleid = $_POST['postid'];
        
        $article = Post::find($comment->articleid);
        $article->comments()->save($comment);
        
        parent::redirect("/post/show/$comment->articleid");
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
        $article = new Post();
        if ($_POST['id'] > -1) {
            $article = Post::find($_POST['id']);
        }
        $article->content = htmlspecialchars($_POST['content']);
        $article->headline = htmlspecialchars($_POST['headline']);
        $article->ispage = false;
        $article->save();
        parent::redirect('/post/edit/' . $article->id);
    }
    
    public function loadAllPostsAction() {
        $sql = "SELECT id, headline, content, ispage FROM Post where ispage = 0";
        return $this->loadPostsFromDb($sql);
    }

    public function loadAllPagesAction() {
        $sql = "SELECT id, headline, content, ispage FROM Post where ispage = 1";
        return $this->loadPostsFromDb($sql);
    }
    
    public function update($article) {
        $sql = "UPDATE Post SET headline = :headline, content = :content, ispage = :ispage WHERE id = :id";
        global $conn;
        $statement = $conn->prepare($sql);
        $statement->execute(array(':headline'=>$article->headline, ':content'=>$article->content, ':ispage'=>$article->ispage, ':id'=>$article->id));
    }
    
    public function insert($article) {
        $sql = "INSERT INTO Post (headline, content, ispage) VALUES (:headline, :content, :ispage)";
        global $conn;
        $statement = $conn->prepare($sql);
        $statement->execute(array(':headline'=>$article->headline, ':content'=>$article->content, ':ispage'=>$article->ispage));
    }

    private function loadPostsFromDb($sql) {
        $articles = array();
        $parsedown = new Parsedown();
        /*    
        global $conn;
        $result = $conn->query($sql);
        foreach ($result as $row) {
            $article = new Post();
            $article->id = $row['id'];
            $article->headline = $parsedown->text($row['headline']);
            $article->content = $parsedown->text($row['content']);
            $article->ispage = $row['ispage'];
            array_push($articles, $article);
        }*/
        return $articles;
    }
}
?>