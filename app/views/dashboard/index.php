<div id="articles">
    <div>
        <a href="<?php echo Router::getUrl('/post/new'); ?>" id="new">New Post</a>
    </div>
    <?php
        $articles = $data["articles"];    
    
        foreach ($articles as $article) {
            echo "<article>";
            echo "<h1>" . $article->headline . "</h1>";
            echo "<a href='" . Router::getUrl("/post/edit/$article->id") . "' class='editPost'>edit</a>";
            echo "</article>";
        }
    ?>
</div>
<div id="pages" class="dashboard-hidden">
    <div>
        <a href="<?php echo Router::getUrl('/page/new'); ?>" id="new">New Page</a>
    </div>
    <?php
        $articles = $data["pages"];  
        
        foreach ($articles as $article) {
            echo "<article>";
            echo "<h1>" . $article->headline . "</h1>";
            echo "<a href='" . Router::getUrl("/page/edit/$article->id") . "' class='editPost'>edit</a>";
            echo "</article>";
        }
    ?>
</div>