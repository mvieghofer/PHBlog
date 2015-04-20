<?php
    require("pagelink.php");
    
    $articles = Article::getArticles();
    
    if (isset($_POST[COMMENT_KEY])) {
        $article = findArticle(Article::getArticlesAndPages(), $_GET["pageId"]);
        $comment = new Comment();
        $comment->date = new DateTime();
        $comment->comment = htmlspecialchars($_POST[COMMENT_KEY]);
        $comment->commentator = htmlspecialchars($_POST[COMMENTATOR_KEY]);
        Comment::insert($comment, $article->id);
        array_push($article->comments, $comment);
    }
    
    foreach($articles as $article) {
        $article->displayArticle(false);
    }
?>