<?php
class DashboardController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $data = [
            "articles" => Post::where('ispage', '=', 0)->get(),
            "pages" => Post::where('ispage', '=', 1)->get()
            ];
        
        $this->view("dashboard/index", $data);
    }
    
    public function loadComments($articleId) {
        $comments = array();
        global $conn;
        $statement = $conn->prepare("SELECT id, commentator, comment, date from Comment where articleid = :articleId");
        $result = $statement->execute(array(':articleId'=>$articleId));
        foreach ($result as $row) {
            $comment = new Comment();
            $comment->comment = $row['comment'];
            $comment->commentator = $row['commentator'];
            $comment->id = $row['id'];
            $comment->date = new DateTime($row['date']);
            array_push($comments, $comment);
        }
        return $this->comments;
    }
        
    public static function insert($comment, $articleId) {
        $sql = "INSERT INTO Comment (date, comment, commentator, articleid) VALUES (:date, :comment, :commentator, :articleid)";
        global $conn;
        $query = $conn->prepare($sql);
        $query->execute(array(':date'=>$comment->date->format('Y-m-d H:i:s'), ':comment'=>$comment->comment, ':commentator'=>$comment->commentator, ':articleid'=>$articleId));
    }
}
?>