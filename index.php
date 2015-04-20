<?php
  require("article.php");

  function findArticle($articles, $articleId) {
    foreach ($articles as $article) {
      if ($article->id == $articleId) {
        return $article;
      }
    }
  }
    
  if (isset($_POST[COMMENT_KEY])) {
    $article = findArticle(Article::getArticlesAndPages(), $_GET["pageId"]);
    $comment = new Comment();
    $comment->date = new DateTime();
    $comment->comment = htmlspecialchars($_POST[COMMENT_KEY]);
    $comment->commentator = htmlspecialchars($_POST[COMMENTATOR_KEY]);
    Comment::insert($comment, $article->id);
    array_push($article->comments, $comment);
    header("Location: index.php?pageId=$article->id");
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
        <h1>PHBlog</h1>
        <a href='dashboard.php'>dashboard</a>
    </header>
    <table>
      <tr>
        <td id="nav">
            <?php require("nav.php") ?>
        </td>
        <td>
          <section id="content">
            <?php
              if (isset($_GET["pageId"])) {
                $pageId = $_GET["pageId"];
                require("page.php");
              } else {
                require("content.php");
              }
            ?>
          </section>
        </td>
      </tr>
    </table>
    <footer>
        Footer
    </footer>
</body>
</html>