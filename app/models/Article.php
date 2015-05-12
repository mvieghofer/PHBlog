<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent {
    
    protected $fillable = array('headline', 'content', 'ispage');
    
    public function comments() {
        return $this->hasMany('Comment', 'articleid');
    }
    /*const COMMENT_KEY = "comment";
    const COMMENTATOR_KEY = "commentator";
    
    public function display($includeComments) {
        $parsedown = new Parsedown();
        echo "<article id=\"" . $this->id . "\">";
        echo "<h1>";
        if (!$includeComments) {
            echo "<a href='index.php?pageId=" . $this->id . "' class='pageLink'>";
        }
        echo $this->headline;
        if (!$includeComments) {
            echo "</a>";
        }
        echo "</h1>";
        echo "<p>" . $parsedown->text($this->content) . "</p>";
        echo "<div class=\"comments\">";
        if ($includeComments) {
            echo "<h2>Comments</h2>";
            foreach ($this->comments as $comment) {
                echo "<div class\"comment\">";
                echo "<b>" . $comment->commentator . "</b> @ " . $comment->date->format("d.m.Y H:i") . "<br />";
                echo "<p>" . $comment->comment . "</p>";
                echo "</div>";
            }
            echo "<form id=\"commentForm\" action=\"index.php?pageId=$this->id\" method=\"post\">";
            echo "<label for\"" . COMMENTATOR_KEY . "\">Name:</label>";
            echo "<input type=\"input\" id=\"" . COMMENTATOR_KEY . "\" name=\"" . COMMENTATOR_KEY . "\"></input><br />";
            echo "<textarea name=\"" . COMMENT_KEY . "\" rows=\"10\" cols=\"50\"></textarea>";
            echo "<button type\"submit\">submit</button>";
            echo "</form>";
        }
        echo "</div>";
        echo "</article>";
    }*/
    
    
}
    
    
    
?>