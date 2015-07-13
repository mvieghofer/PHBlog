<?php
    $navPoints = Post::where('ispage', '=', 1)->get();
    echo "<nav><ul>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class='pageLink' href='" . Router::getUrl("/page/$navPoint->id") . "'>" . $navPoint->headline . "</a></li>";
    }
    echo "</ul></nav>";
    
?>