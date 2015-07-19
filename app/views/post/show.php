<?php
    $parsedown = new Parsedown();
    $post = $data['post'];
    $csrftoken = $data['csrftoken'];
    echo "<article id='$post->id'>";
    echo "<h1>$post->headline</h1>";
    echo "<div>" . $parsedown->text($post->content) . "</div>";
    echo "<hr class='comment-separator'><div class='comments'>";
    echo "<h2>Comments</h2>";
    foreach ($post->comments as $comment) {
        echo "<div class\"comment\">";
        echo "<b>" . $comment->commentator . "</b> @ " . date("d.m.Y H:i", strtotime($comment->date)) . "<br />";
        echo "<p>" . $comment->comment . "</p>";
        echo "</div>";
    }
    echo "<form id='commentForm' action='" . Router::getUrl('/post/addComment') . "' method='post'>";
    echo "<input type='hidden' name='csrftoken' value='$csrftoken'></input>";
    echo "<input type='hidden' name='postid' value='$post->id'></input>";
    echo "<input type='input' id='commentator' name='commentator' placeholder='Name'></input><br />";
    echo "<textarea name='comment' placeholder='Tell me your opinion'></textarea>";
    echo "<button type'submit'>submit</button>";
    echo "</form>";
    echo "</div>";
    echo "</article>";
?>