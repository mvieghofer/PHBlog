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

<form id="hiddenForm" action="index.php" method="get">
    <input type="hidden" id="hiddenInput" name="page" />
</form>