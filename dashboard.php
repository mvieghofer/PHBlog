<?php
          
    require("logincookie.php");
          
    if (isset($_COOKIE[LOGIN_COOKIE_NAME])) {
        $loginCookie = json_decode($_COOKIE[LOGIN_COOKIE_NAME]);
    } else {
        header("Location: login.php");
    }
    
    //if (isset($_GET["articleId"])) {
    //    header("Location: edit.php?articleId=" . $_GET["articleId"]);
    //}
?>

<!DOCTYPE html>
<html>
  
<head>
  <meta charset="utf-8" />
  <title>HTML5 basic skeleton</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <header>
        <h1>PHBlog - Dashboard</h1>
    </header>
    <div>
        <?php
            require("db.php");
            require("article.php");
    
            $articles = getArticles();
            foreach ($articles as $article) {
                echo "<article>";
                echo "<h1>" . $article->headline . "</h1>";
                echo "<a href='#" . $article->id . "' class='editArticle'>edit</a>";
                echo "</article>";
            }
        ?>
    </div>
    <form action="edit.php" method="get" id="editForm">
        <input type="hidden" id="articleId">
    </form>
    <footer>
        Footer
    </footer>
    <script type="text/javascript">
        function editPage(articleId) {
            $("#articleId").val(articleId);
            $("#editForm").submit();
        }
        
        $(function() {
            $(".editArticle").click(function() {
                var href = $(this).attr("href");
                if (href.substring(0, 1) == "#") {
                    href = href.substring(1, href.length);
                }
                editPage(href);
            });
        });
    </script>
</body>
</html>