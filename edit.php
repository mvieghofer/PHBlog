<?php
    require("Post.php");
    
    if (isset($_POST["mode"])) {
        $mode = $_POST["mode"];
        $article = new Post();
        $article->content = htmlspecialchars($_POST["content"]);
        $article->headline = htmlspecialchars($_POST["headline"]);
        $article->ispage = $_POST["ispage"] == "on";
        if ($mode == "edit") {
            $article->id = $_GET["pageId"];
            Post::update($article);
        } else {
            Post::insert($article);    
        }
        header("Location: dashboard.php");
    }
    
    if (isset($_GET["pageId"])) {
        $article = Post::getById($_GET["pageId"]);
    } else {
        $article = new Post();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit -
    <?php
        if (!isset($_GET["pageId"])) {
            echo $article->headline;
        } else {
            echo "New";
        }
    ?></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="libs/markdown/lib/markdown.js"></script>
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
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
</body>
</html>
