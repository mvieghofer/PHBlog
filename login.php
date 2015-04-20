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
      echo "<p>Error. Email or password is not correct</p>";
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
    <h1>Login</h1>
    
    <form action="login.php" method="post" id="loginForm">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" /><br />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" /><br />
        <button type="submit" id="submit">submit</button>
    </form>
</body>
</html>