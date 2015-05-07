<?php
    
    $navPoints = array(); //Article::getPages();
    echo "<nav><ul>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class=\"pageLink\" href=\"index.php?pageId=" . $navPoint->id . "\">" . $navPoint->headline . "</a></li>";
    }
    echo "</ul></nav>";
    
?>
<form id="hiddenForm" action="index.php" method="get">
    <input type="hidden" id="hiddenInput" name="page" />
</form>
<script type="text/javascript" src="../../javascript/uifunctions.js"></script>
