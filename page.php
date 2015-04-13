<?php
  $pageId = $_GET["pageId"];
  
  $article = Article::getById($pageId);
  $article->displayArticle(true);
?>