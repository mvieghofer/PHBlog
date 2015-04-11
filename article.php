<?php
    require("comment.php");
    
    class Article {
        public $id = -1;
        public $headline = "";
        public $description = "";
        public $comments = [];
    }
    
    function createComments() {
        $comments = array();
        for ($i = 0; $i < rand(0, 5); $i++) {
            $comment = new Comment();
            $comment->comment = "Lorem ipsum dolor sit amet";
            $comment->commentator = "John Doe";
            $commentDate = new DateTime();
            $comment->date = $commentDate;
            $comments[$i] = $comment;
        }
        return $comments;
    }

    function getArticles() {
        $articles = array();
                
        for ($i = 1; $i < 10; $i++) {
            $article = new Article();
            $article->id = $i;
            $article->headline = "Article " . $i;
            $article->description = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam.";
            $article->comments = createComments();
            $articles[$i] = $article;
        }
        $isInitialized = true;
        return $articles;
    }
?>