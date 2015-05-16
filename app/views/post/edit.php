<?php
    $parsedown = new Parsedown();
    $post = $data['post'];
?>
<form action='<?php echo $data['returnPath']; ?>' method='post' id='editForm'>
<?php
    echo "<input type='hidden' name='id' value='$post->id'>";
?>
    <input name="headline" value="<?php echo $post->headline ?>" id="headline" /><br />
    <textarea name="content" id="content"><?php echo $post->content ?></textarea><br />
    <div id="formMenu">
        <a href="<?php echo PHBlog::getUrl('/dashboard'); ?>">Cancel</a>
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
<?php
    echo "<script type='text/javascript' src='" . LIBRARY_PATH . "/markdown/lib/markdown.js'></script>";
?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">