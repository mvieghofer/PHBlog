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
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $conn = new PDO("mysql:host=$servername;dbname=PHBlog", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "connected successfully";
        ?>
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
              if (isset($_GET["page"])) {
                $pageCode = $_GET["page"];
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