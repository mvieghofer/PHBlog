<?php
    require("pagelink.php");
    
    $navPoints = getPages();
    echo "<nav><ul>";
    echo "<li><a href=\"index.php\">Home</a></li>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class=\"pageLink\" href=\"#" . $navPoint->id . "\">" . $navPoint->headline . "</a></li>";
    }
    echo "</ul></nav>";
?>