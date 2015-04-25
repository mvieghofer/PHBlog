<?php
    require("Article.php");
    
    if (isset($_POST["mode"])) {
        $mode = $_POST["mode"];
        $article = new Article();
        $article->content = htmlspecialchars($_POST["content"]);
        $article->headline = htmlspecialchars($_POST["headline"]);
        $article->ispage = $_POST["ispage"] == "on";
        if ($mode == "edit") {
            $article->id = $_GET["pageId"];
            Article::update($article);
        } else {
            Article::insert($article);    
        }
        header("Location: edit.php?pageId=$article->id");
    }
    
    if (isset($_GET["pageId"])) {
        $article = Article::getById($_GET["pageId"]);
    } else {
        $article = new Article();
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
</head>

<body>
    <form action="edit.php<?php if (isset($_GET["pageId"])) { echo '?pageId='.$_GET["pageId"]; } ?>" method="post">
        <input type="hidden" value="<?php if (!isset($_GET["pageId"])) { echo 'newpost'; } else { echo 'edit'; } ?>" name="mode">
        <?php
            if (isset($_GET["pageId"])) {
                echo "<input type='hidden' name='pageId' value='" . $_GET["pageId"] . "'>";
            }
        ?>
        <input name="headline" value=" <?php echo $article->headline ?> " /><br />
        <input type="checkbox" name="ispage" <?php if ($article->ispage) { echo 'checked'; } ?>>Is Page</input><br />
        <textarea name="content" value="" cols="150" rows="50"><?php echo $article->content ?></textarea><br />
        <button type="submit">Submit</button>
    </form>


</body>
</html>
