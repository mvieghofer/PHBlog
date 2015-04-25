<?php
  require("logincookie.php");
  require("db.php");
        
  if (isset($_POST["username"]) && isset($_POST["password"])) {
    global $conn;
    $statement = $conn->prepare("SElECT password FROM User WHERE username = :username");
    $statement->execute(array(':username'=>$_POST["username"]));
    $result = $statement->fetch();
    $password = hash("sha256", $_POST["password"], false);
    if ($result['password'] == $password) {
      $loginCookie = new LoginCookie();
      $loginCookie->userId = 1;
      $loginCookie->userName = $_POST["username"];
      setcookie(LOGIN_COOKIE_NAME, json_encode($loginCookie), time() + (86400 * 30), "/");
      header("Location: dashboard.php");
    } else {
      header("Location: login.php?error=true");
    }
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
    <div id="login">
      <h1>Login</h1>
      <?php
        if (isset($_GET["error"]) && $_GET["error"] == true) {
          echo "<p>An error occured. Please check you email and password.</p>";
        }
      ?>
      <form action="login.php" method="post" id="loginForm">
          <input type="text" id="username" name="username" placeholder="Email" /><br />
          <input type="password" id="password" name="password" placeholder="Password" /><br />
          <button type="submit" id="submit">submit</button>
      </form>
    </div>
</body>
</html>