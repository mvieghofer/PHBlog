<?php
    require("article.php");
    
    define("COMMENT_KEY", "comment");
    define("COMMENTATOR_KEY", "commentator");
    define("ADD_COMMENT_KEY", "addComment");
    define("POST_ID_KEY", "postid");
              
    $articles = getArticles();
    
    if (isset($_GET[ADD_COMMENT_KEY])) {
        $comments = $articles[$_GET[POST_ID_KEY]]->comments;
        $comment = new Comment();
        $comment->date = new DateTime();
        $comment->comment = $_GET[COMMENT_KEY];
        $comment->commentator = $_GET[COMMENTATOR_KEY];
        array_push($comments, $comment);
        $articles[$_GET[POST_ID_KEY]]->comments = $comments;
    }
    
    foreach($articles as $article) {
        echo "<article id=\"" . $article->id . "\">";
        echo "<h1>" . $article->headline . "</h1>";
        echo "<p>" . $article->description . "</p>";
        echo "<div class=\"comments\">";
        echo "<h2>Comments</h2>";
        foreach ($article->comments as $comment) {
            echo "<div class\"comment\">";
            echo "<b>" . $comment->commentator . "</b> @ " . $comment->date->format("d.m.Y H:i") . "<br />";
            echo "<p>" . $comment->comment . "</p>";
            echo "</div>";
        }
        echo "<form id=\"commentForm\" action=\"index.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"" . ADD_COMMENT_KEY . "\" value=\"true\">";
        echo "<input type=\"hidden\" name=\"" . POST_ID_KEY . "\" value=\"" . $article->id . "\">";
        echo "<label for\"" . COMMENTATOR_KEY . "\">Name:</label>";
        echo "<input type=\"input\" id=\"" . COMMENTATOR_KEY . "\" name=\"" . COMMENTATOR_KEY . "\"></input><br />";
        echo "<textarea name=\"" . COMMENT_KEY . "\" rows=\"10\" cols=\"50\"></textarea>";
        echo "<button type\"submit\">submit</button>";
        echo "</form>";
        echo "</div>";
        echo "</article>";
    }
?>