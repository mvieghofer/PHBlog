<?php
namespace controller;

require_once __DIR__ . '/vendor/autoload.php';
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

class ArticleController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function displayArticleAction($request) {
        $parsedown = new Parsedown();
        global $conn;
        $query = $conn->prepare("SELECT headline, content, ispage from Article where id = :id");
        $query->execute(array(':id'=>$request->id));
        $result = $query->fetch();
        $article = new Article();
        $article->id = $request->id;
        $article->headline = $parsedown->text($result['headline']);
        $article->content = $parsedown->text($result['content']);
        $article->ispage = $result['ispage'];
        
        $commentController = new CommentController();
        $article->comments =  $commentController->loadComments($article->id);
        
        $view->render('article', array("article" => article));
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
            
        global $conn;
        $result = $conn->query($sql);
        foreach ($result as $row) {
            $article = new Article();
            $article->id = $row['id'];
            $article->headline = $parsedown->text($row['headline']);
            $article->content = $parsedown->text($row['content']);
            $article->ispage = $row['ispage'];
            array_push($articles, $article);
        }
        return $articles;
    }
}
?>