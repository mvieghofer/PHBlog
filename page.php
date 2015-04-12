<?php
  $headline = $pageCode;
  
  global $conn;
  $query = $conn->prepare("SELECT headline, content from Article where id = :id");
  $query->execute(array(':id'=>$pageCode));
  $result = $query->fetch();
  $article = new Article();
  $article->id = $pageCode;
  $article->headline = $result['headline'];
  $article->content = $result['content'];
  $article->getComments();
  
  $article->displayArticle(true);
?>