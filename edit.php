<!DOCTYPE html>
<?php
    require("article.php");
    
    if (isset($_GET["mode"])) {
        $mode = $_GET["mode"];
        $article = new Article();
        $article->content = $_GET["content"];
        $article->headline = $_GET["headline"];
        $article->ispage = $_GET["ispage"] == "on";
        if ($mode == "edit") {
            $article->id = $_GET["pageId"];
            Article::update($article);
        } else {
            Article::insert($article);    
        }
        header("Location: dashboard.php");
    }
    
    if (isset($_GET["pageId"])) {
        $article = Article::getById($_GET["pageId"]);
    } else {
        $article = new Article();
    }
?>
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
    <form action="edit.php" method="get">
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
