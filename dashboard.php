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
    </header>
    <div>
        <?php
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
    <form action="dashboard.php" method="get" id="dashboardForm">
        <input type="hidden" id="articleId">
    </form>
    <footer>
        Footer
    </footer>
</body>
</html>