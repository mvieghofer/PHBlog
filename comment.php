<?php
    class Comment {
        public $id;
        public $commentator;
        public $comment;
        public $date;
        
        public static function insert($comment, $articleId) {
            $sql = "INSERT INTO Comment (date, comment, commentator, articleid) VALUES (:date, :comment, :commentator, :articleid)";
            global $conn;
            $query = $conn->prepare($sql);
            $query->execute(array(':date'=>$comment->date->format('Y-m-d H:i:s'), ':comment'=>$comment->comment, ':commentator'=>$comment->commentator, ':articleid'=>$articleId));
        }
    }
?>