<?php
    foreach ($articles as $article) {
        echo "<article id='$article->id'>";
        echo "<h1>$article->headline</h1>";
        echo "<div>$article->content</div>";
        echo "</article>";
    }
?>