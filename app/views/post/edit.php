<form action="edit.php<?php if (isset($_GET["pageId"])) { echo '?pageId='.$_GET["pageId"]; } ?>" method="post" id="editForm">
    <input type="hidden" value="<?php if (!isset($_GET["pageId"])) { echo 'newpost'; } else { echo 'edit'; } ?>" name="mode">
    <?php
        if (isset($_GET["pageId"])) {
            echo "<input type='hidden' name='pageId' value='" . $_GET["pageId"] . "'>";
        }
    ?>
    <input name="headline" value="<?php echo $article->headline ?>" id="headline" /><br />
    <textarea name="content" id="content"><?php echo $article->content ?></textarea><br />
    <div id="formMenu">
        <input type="checkbox" id="ispage" name="ispage" <?php if ($article->ispage) { echo 'checked'; } ?>>Is Page</input><br />
        <a href="dashboard.php">Cancel</a>
        <button type="submit">Submit</button>
    </div>
</form>  

<div id="output"></div>        

<script type="text/javascript">
$(function() {    
            
    $("#content").resizable({
        resize: function() {
            var top = $(this).css("top");
            top = top.substring(0, top.length - 2);
            var height = $(this).css("height");
            height = height.substring(0, height.length - 2);
            var menuTop = parseInt(top) + parseInt(height) + 20;
            $("#formMenu").css("top", menuTop + "px");
        }
    });
   
    $("#headline").css("width", $("#content").css("width"));
    
    function updatePreview() {
        $("#output").html(markdown.toHTML("# " + $("#headline").val() + "\n" + $("#content").val()));
    }
    
    $("#headline").keyup(function() {
       updatePreview(); 
    });
    
    $("#content").keyup(function() {
       updatePreview(); 
    });
    
    updatePreview();
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../../public/javascript/libs/markdown/lib/markdown.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">