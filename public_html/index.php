<?php /*
  require("Article.php");

  function findArticle($articles, $articleId) {
    foreach ($articles as $article) {
      if ($article->id == $articleId) {
        return $article;
      }
    }
  }
    
  if (isset($_POST[COMMENT_KEY])) {
    $article = findArticle(Article::getArticlesAndPages(), $_GET["pageId"]);
    $comment = new Comment();
    $comment->date = new DateTime();
    $comment->comment = htmlspecialchars($_POST[COMMENT_KEY]);
    $comment->commentator = htmlspecialchars($_POST[COMMENTATOR_KEY]);
    Comment::insert($comment, $article->id);
    array_push($article->comments, $comment);
    header("Location: index.php?pageId=$article->id");
  }*/
?>

<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

    require_once(APP_PATH . "/controller/HomeController.php");
    require_once(APP_PATH . "/controller/ArticleController.php");
    
    $klein = new \Klein\Klein();
    
    $homeController = new HomeController();
    $articleController = new ArticleController();
    
    $klein->respond('GET', '/', $homeController->displayHomeAction());
    $klein->respond('GET', '/index', $homeController->displayHomeAction());
    $klein->respond('GET', '/home', $homeController->displayHomeAction());
    $klein->respond('GET', '/post/[:id]', $articleController->displayArticleAction($request));
    
    renderLayoutWithContentfile("home.php", array());
?>