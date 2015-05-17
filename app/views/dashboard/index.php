<div id="articles">
    <div>
        <a href="<?php echo PHBlog::getUrl('/post/new'); ?>" id="new">New Post</a>
    </div>
    <?php
        $articles = $data["articles"];    
    
        foreach ($articles as $article) {
            echo "<article>";
            echo "<h1>" . $article->headline . "</h1>";
            echo "<a href='" . PHBlog::getUrl("/post/edit/$article->id") . "' class='editPost'>edit</a>";
            echo "</article>";
        }
    ?>
</div>
<div id="pages" class="dashboard-hidden">
    <div>
        <a href="<?php echo PHBlog::getUrl('/page/new'); ?>" id="new">New Page</a>
    </div>
    <?php
        $articles = $data["pages"];  
        
        foreach ($articles as $article) {
            echo "<article>";
            echo "<h1>" . $article->headline . "</h1>";
            echo "<a href='" . PHBlog::getUrl("/page/edit/$article->id") . "' class='editPost'>edit</a>";
            echo "</article>";
        }
    ?>
</div>