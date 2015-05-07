<article id="<?php echo $article->id ?>">
    <h1>
        <?php
            echo $article->headline;
        ?>
    </h1>
    <div>
        <?php
            $article->content;
        ?>
    </div>
    <div class=comments">
        <h2>Comments</h2>
            <?php
                foreach ($article->comments as $comment) {
                    echo "<div class\"comment\">";
                    echo "<b>" . $comment->commentator . "</b> @ " . $comment->date->format("d.m.Y H:i") . "<br />";
                    echo "<p>" . $comment->comment . "</p>";
                    echo "</div>";
                }
            ?>
        <form id="commentForm" action="posts/<?php echo $data['article']->id ?>" method="post">
            <input type="input" id="commentator" name="commentator" placeholder="Name"></input><br />
            <textarea name="comment"></textarea>
            <button type"submit">submit</button>
        </form>
    </div>
</article>