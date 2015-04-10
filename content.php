<?php
    class Article {
        public $id = -1;
        public $headline = "";
        public $description = "";
    }

    function getArticles() {
        $articles = array();
                
        for ($i = 1; $i < 10; $i++) {
            $article = new Article();
            $article->id = $i;
            $article->headline = "Article " . $i;
            $article->description = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam.";
            $articles[$i] = $article;
        }
            
        return $articles;
    }
              
    foreach(getArticles() as $article) {
        echo "<article id=\"" . $article->id . "\">";
        echo "<h1>" . $article->headline . "</h1>";
        echo "<p>" . $article->description . "</p>";
        echo "</article>";
    }
?>