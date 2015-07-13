<?php
    $parsedown = new Parsedown();
    $post = $data['post'];
?>
<div class="row">
    <div class="col-xs-6">
        <form action='<?php echo Router::getUrl($data['returnPath']); ?>' method='post' id='editForm'>
        <?php
            echo "<input type='hidden' name='id' value='$post->id'>";
        ?>
            <input name="headline" value="<?php echo $post->headline ?>" id="headline" /><br />
            <textarea name="content" id="post-content"><?php echo $post->content ?></textarea><br />
            
        </form>  
    </div>
    <div id="output" class="col-xs-6"></div>
</div>
<div id="formmenu-container" class="row">
    <div class="col-xs-12">
        <div id="formMenu">
            <a href="<?php echo Router::getUrl('/dashboard'); ?>">Cancel</a>
            <button type="submit" id="editform-submit">Submit</button>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    
    $('#editform-submit').click(function() {
        $('#editForm').submit();    
    });
    
    function updatePreview() {
        $("#output").html(markdown.toHTML("# " + $("#headline").val() + "\n" + $("#post-content").val()));
    }
    
    $("#headline").keyup(function() {
       updatePreview(); 
    });
    
    $("#post-content").keyup(function() {
       updatePreview(); 
    });
    
    updatePreview();
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<?php
    echo "<script type='text/javascript' src='" . Router::getUrl('/public/javascript/markdown/lib/markdown.js') . "'></script>";
?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">