<?php
    require("pagelink.php");
    
              
    $articles = getArticles();
    
    function findArticle($articleId) {
        foreach ($articles as $article) {
            if ($article->id == $articleId) {
                return $article;
            }
        }
    }
    
    if (isset($_GET[ADD_COMMENT_KEY])) {
        $article = findArticle(POST_ID_KEY);
        $comment = new Comment();
        $comment->date = new DateTime();
        $comment->comment = $_GET[COMMENT_KEY];
        $comment->commentator = $_GET[COMMENTATOR_KEY];
        $sql = "INSERT INTO Comment (date, comment, commentator, articleid) VALUES (:date, :comment, :commentator, :articleid)";
        global $conn;
        $query = $conn->prepare($sql);
        $query->execute(array(':date'=>$comment->date->format('Y-m-d H:i:s'), ':comment'=>$comment->comment, ':commentator'=>$comment->commentator, ':articleid'=>$article->id));
        
        array_push($article->comments, $comment);
    }
    
    foreach($articles as $article) {
        $article->displayArticle(false);
    }
?>