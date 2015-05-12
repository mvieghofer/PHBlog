<?php
   $parsedown = new Parsedown();
   foreach($data as $article) {
      echo "<article id='$article->id'>";
      echo "<h1><a href='/post/show/$article->id'>$article->headline</a></h1>";
      echo "<div>" . $parsedown->text($article->content) . "</div>";
      echo "</article>";
   }
?>