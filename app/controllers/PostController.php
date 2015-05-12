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
        $article = Article::find($id);
        
        $this->view("post/show", $article);
    }
    
    public function addCommentAction() {
        $comment = new Comment();
        $comment->commentator = $_POST['commentator'];
        $comment->comment = $_POST['comment'];
        $comment->date = new DateTime();
        $comment->articleid = $_POST['postid'];
        
        $article = Article::find($comment->articleid);
        $article->comments()->save($comment);
        
        parent::redirect("/post/show/$comment->articleid");
    }
    
    public function editAction($postid = -1) {
        
    }
    
    public function loadAllArticlesAction() {
        $sql = "SELECT id, headline, content, ispage FROM Article where ispage = 0";
        return $this->loadArticlesFromDb($sql);
    }

    public function loadAllPagesAction() {
        $sql = "SELECT id, headline, content, ispage FROM Article where ispage = 1";
        return $this->loadArticlesFromDb($sql);
    }
    
    public function update($article) {
        $sql = "UPDATE Article SET headline = :headline, content = :content, ispage = :ispage WHERE id = :id";
        global $conn;
        $statement = $conn->prepare($sql);
        $statement->execute(array(':headline'=>$article->headline, ':content'=>$article->content, ':ispage'=>$article->ispage, ':id'=>$article->id));
    }
    
    public function insert($article) {
        $sql = "INSERT INTO Article (headline, content, ispage) VALUES (:headline, :content, :ispage)";
        global $conn;
        $statement = $conn->prepare($sql);
        $statement->execute(array(':headline'=>$article->headline, ':content'=>$article->content, ':ispage'=>$article->ispage));
    }

    private function loadArticlesFromDb($sql) {
        $articles = array();
        $parsedown = new Parsedown();
        /*    
        global $conn;
        $result = $conn->query($sql);
        foreach ($result as $row) {
            $article = new Article();
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