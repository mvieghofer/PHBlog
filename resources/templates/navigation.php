<?php
    $navPoints = Article::where('ispage', '=', 1)->get();
    echo "<nav><ul>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class=\"pageLink\" href=\"/post/show/$navPoint->id\">" . $navPoint->headline . "</a></li>";
    }
    echo "</ul></nav>";
    
?>
<form id="hiddenForm" action="index.php" method="get">
    <input type="hidden" id="hiddenInput" name="page" />
</form>
<script type="text/javascript" src="../public/javascript/uifunctions.js"></script>
