<?php
          
    require("logincookie.php");
          
    if (isset($_COOKIE[LOGIN_COOKIE_NAME])) {
        $loginCookie = json_decode($_COOKIE[LOGIN_COOKIE_NAME]);
    } else {
        header("Location: login.php");
    }
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
        <a href="logout.php">Logout</a>
        <a href="edit.php">New Article</a>
    </header>
    <div>
        <?php
            require("db.php");
            require("article.php");
    
            $articles = Article::getArticlesAndPages();
            foreach ($articles as $article) {
                echo "<article>";
                echo "<h1>" . $article->headline . "</h1>";
                echo "<a href='edit.php?pageId=" . $article->id . "' class='editArticle'>edit</a>";
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
</body>
</html>