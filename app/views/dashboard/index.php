<table id="dashboardTable">
    <tr>
        <td id="nav">
            <nav class="dashboardMenu">
                <ul>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Pages</a></li>
                </ul>            
            </nav>            
        </td>
        <td>
            <div id="articles" class="dashboardContent">
                <div>
                    <a href="/post/edit" id="new">New Article</a>
                </div>
                <?php
                    $articles = $data["articles"];    
                
                    foreach ($articles as $article) {
                        echo "<article>";
                        echo "<h1>" . $article->headline . "</h1>";
                        echo "<a href='/post/edit$article->id' class='editArticle'>edit</a>";
                        echo "</article>";
                    }
                ?>
            </div>
            <div id="pages" class="dashboardContent dashboard-hidden">
                <div>
                    <a href="/post/edit" id="new">New Page</a>
                </div>
                <?php
                    $articles = $data["pages"];  
                    
                    foreach ($articles as $article) {
                        echo "<article>";
                        echo "<h1>" . $article->headline . "</h1>";
                        echo "<a href='/post/edit$article->id' class='editArticle'>edit</a>";
                        echo "</article>";
                    }
                ?>
            </div>
        </td>
    </tr>
</table>

<script type="text/javascript">
    $(function() {
        $("#user").hover(
            function() {
                $("#submenu").addClass("submenu");
                $("#submenu").removeClass("submenu-hidden");
            },
            function () {
                $("#submenu").addClass("submenu-hidden");
                $("#submenu").removeClass("submenu");
            }
        );
        
        $("nav.dashboardMenu a").click(function(e) {
            var category = $(e.target).text();
            if (category == "Articles") {
                $("#pages").addClass("dashboard-hidden");
                $("#articles").removeClass("dashboard-hidden");
            } else {
                $("#articles").addClass("dashboard-hidden");
                $("#pages").removeClass("dashboard-hidden");
            }
        });
    });
</script>