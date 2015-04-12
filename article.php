<?php
    require("comment.php");
    require("db.php");
    
    define("COMMENT_KEY", "comment");
    define("COMMENTATOR_KEY", "commentator");
    define("ADD_COMMENT_KEY", "addComment");
    define("POST_ID_KEY", "postid");
    
    class Article {
        public $id = -1;
        public $headline = "";
        public $content = "";
        public $comments = array();
      
        function getComments() {
            if (empty($this->comments)) {      
                global $conn;
                $result = $conn->query("SELECT id, commentator, comment, date from Comment where articleid = " . $this->id);
                foreach ($result as $row) {
                    $comment = new Comment();
                    $comment->comment = $row['comment'];
                    $comment->commentator = $row['commentator'];
                    $comment->id = $row['id'];
                    $comment->date = new DateTime($row['date']);
                    array_push($this->comments, $comment);
                }
            }
            return $this->comments;
        }
        
        public function displayArticle($includeComments) {
            echo "<article id=\"" . $this->id . "\">";
            echo "<h1>";
            if (!$includeComments) {
                echo "<a href='#" . $this->id . "' class='pageLink'>";
            }
            echo $this->headline;
            if (!$includeComments) {
                echo "</a>";
            }
            echo "</h1>";
            echo "<p>" . $this->content . "</p>";
            echo "<div class=\"comments\">";
            if ($includeComments) {
                echo "<h2>Comments</h2>";
                foreach ($this->comments as $comment) {
                    echo "<div class\"comment\">";
                    echo "<b>" . $comment->commentator . "</b> @ " . $comment->date->format("d.m.Y H:i") . "<br />";
                    echo "<p>" . $comment->comment . "</p>";
                    echo "</div>";
                }
                echo "<form id=\"commentForm\" action=\"index.php\" method=\"get\">";
                echo "<input type=\"hidden\" name=\"" . ADD_COMMENT_KEY . "\" value=\"true\">";
                echo "<input type=\"hidden\" name=\"" . POST_ID_KEY . "\" value=\"" . $this->id . "\">";
                echo "<label for\"" . COMMENTATOR_KEY . "\">Name:</label>";
                echo "<input type=\"input\" id=\"" . COMMENTATOR_KEY . "\" name=\"" . COMMENTATOR_KEY . "\"></input><br />";
                echo "<textarea name=\"" . COMMENT_KEY . "\" rows=\"10\" cols=\"50\"></textarea>";
                echo "<button type\"submit\">submit</button>";
                echo "</form>";
            }
            echo "</div>";
            echo "</article>";
        }
    }
    
    function getArticles() {
        $sql = "SELECT id, headline, content FROM Article a where ispage = 0";
        return loadArticlesFromDb($sql);
    }
    
    function getPages() {
        $sql = "SELECT id, headline, content FROM Article a where ispage = 1";
        return loadArticlesFromDb($sql);
    }
    
    function loadArticlesFromDb($sql) {
        $articles = array();
                
        global $conn;
        $result = $conn->query($sql);
        foreach ($result as $row) {
            $article = new Article();
            $article->id = $row['id'];
            $article->headline = $row['headline'];
            $article->content = $row['content'];
            //$article->comments = getComments($article->id);
            array_push($articles, $article);
        }
        $isInitialized = true;
        return $articles;
    }
    
?>