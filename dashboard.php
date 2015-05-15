<?php
          
    require("logincookie.php");
    require("db.php");
    require("article.php");            
    
    define("ARTICLE_NAME", "Posts");      
    define("POSTS_NAME", "Pages");
    
    if (isset($_COOKIE[LOGIN_COOKIE_NAME])) {
        $loginCookie = json_decode($_COOKIE[LOGIN_COOKIE_NAME]);
    } else {
        header("Location: login.php");
    }
    
    if (isset($_POST["category"])) {
        $category = $_POST["category"];
        header("Location: dashboard.php");
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
    <div id="menu">
        <div id="user">
            <?php echo "Hello, $loginCookie->username" ?>
            <div id="submenu" class="submenu-hidden">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <div>
        <table id="dashboardTable">
            <tr>
                <td id="nav">
                    <nav class="dashboardMenu">
                        <ul>
                            <li><a href="#"><?php echo ARTICLE_NAME ?></a></li>
                            <li><a href="#"><?php echo POSTS_NAME ?></a></li>
                        </ul>            
                    </nav>            
                </td>
                <td>
                    <div id="articles" class="dashboardContent">
                        <div>
                            <a href="edit.php" id="new">New Post</a>
                        </div>
                        <?php
                            $articles = Post::getPosts();    
                        
                            foreach ($articles as $article) {
                                echo "<article>";
                                echo "<h1>" . $article->headline . "</h1>";
                                echo "<a href='edit.php?pageId=" . $article->id . "' class='editPost'>edit</a>";
                                echo "</article>";
                            }
                        ?>
                    </div>
                    <div id="pages" class="dashboardContent dashboard-hidden">
                        <div>
                            <a href="edit.php" id="new">New Page</a>
                        </div>
                        <?php
                            $articles = Post::getPages();    
                            
                            foreach ($articles as $article) {
                                echo "<article>";
                                echo "<h1>" . $article->headline . "</h1>";
                                echo "<a href='edit.php?pageId=" . $article->id . "' class='editPost'>edit</a>";
                                echo "</article>";
                            }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <footer>
        
    </footer>
    
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
                if (category == "Posts") {
                    $("#pages").addClass("dashboard-hidden");
                    $("#articles").removeClass("dashboard-hidden");
                } else {
                    $("#articles").addClass("dashboard-hidden");
                    $("#pages").removeClass("dashboard-hidden");
                }
            });
        });
    </script>
</body>
</html>