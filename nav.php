<?php
    require("pagelink.php");
    
    $navPoints = Article::getPages();
    echo "<nav><ul>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class=\"pageLink\" href=\"index.php?pageId=" . $navPoint->id . "\">" . $navPoint->headline . "</a></li>";
    }
    echo "</ul></nav>";
?>