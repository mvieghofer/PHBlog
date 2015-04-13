<?php
    require("pagelink.php");
    
    $articles = Article::getArticles();
    
    function findArticle($articles, $articleId) {
        foreach ($articles as $article) {
            if ($article->id == $articleId) {
                return $article;
            }
        }
    }
    
    if (isset($_GET[ADD_COMMENT_KEY])) {
        $article = findArticle(Article::getArticlesAndPages(), $_GET[POST_ID_KEY]);
        $comment = new Comment();
        $comment->date = new DateTime();
        $comment->comment = $_GET[COMMENT_KEY];
        $comment->commentator = $_GET[COMMENTATOR_KEY];
        Comment::insert($comment, $article->id);
        array_push($article->comments, $comment);
    }
    
    foreach($articles as $article) {
        $article->displayArticle(false);
    }
?>