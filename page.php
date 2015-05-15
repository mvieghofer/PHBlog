<?php
  $pageId = $_GET["pageId"];
  
  $article = Post::getById($pageId);
  $article->displayPost(true);
?>