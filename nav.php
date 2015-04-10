
<script type="text/javascript">
    function switchPage(id) {
      $("#hiddenInput").val(id);
      $("#hiddenForm").submit();
    }
    
    $(function() {
       $(".pageLink").click(function() {
        var href = $(this).attr("href");
        if (href.substring(0, 1) == "#") {
            href = href.substring(1, href.length);
        }
        switchPage(href);
       });
    });
</script>

<?php
    $navPoints = ["one", "two", "three"]; //TODO load from db
    echo "<nav><ul>";
    echo "<li><a href=\"index.php\">Home</a></li>";
    foreach ($navPoints as $navPoint) {
        echo "<li><a class=\"pageLink\" href=\"#" . $navPoint . "\">" . $navPoint . "</a></li>";
    }
    echo "</ul></nav>";
?>


<form id="hiddenForm" action="index.php" method="get">
    <input type="hidden" id="hiddenInput" name="page" />
</form>