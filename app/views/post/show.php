<?php
    $parsedown = new Parsedown();
    echo "<article id='$data->id'>";
    echo "<h1>$data->headline</h1>";
    echo "<div>" . $parsedown->text($data->content) . "</div>";
    echo "<hr class='comment-separator'><div class='comments'>";
    echo "<h2>Comments</h2>";
    foreach ($data->comments as $comment) {
        echo "<div class\"comment\">";
        echo "<b>" . $comment->commentator . "</b> @ " . date("d.m.Y H:i", strtotime($comment->date)) . "<br />";
        echo "<p>" . $comment->comment . "</p>";
        echo "</div>";
    }
    echo "<form id='commentForm' action='" . Router::getUrl('/post/addComment') . "' method='post'>";
    echo "<input type='hidden' name='postid' value='$data->id'></input>";
    echo "<input type='input' id='commentator' name='commentator' placeholder='Name'></input><br />";
    echo "<textarea name='comment' placeholder='Tell me your opinion'></textarea>";
    echo "<button type'submit'>submit</button>";
    echo "</form>";
    echo "</div>";
    echo "</article>";
?>