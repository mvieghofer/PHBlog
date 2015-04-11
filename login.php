<!DOCTYPE html>
    
    <?php
        require("logincookie.php");
    
        if (isset($_GET["email"]) && isset($_GET["password"])) {
            $loginCookie = new LoginCookie();
            $loginCookie->userId = 1;
            $loginCookie->userName = $_GET["email"];
            setcookie(LOGIN_COOKIE_NAME, json_encode($loginCookie), time() + (86400 * 30), "/");
            header("Location: dashboard.php");
        }
    ?>
<html>
<head>
  <meta charset="utf-8" />
  <title>HTML5 basic skeleton</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="get">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" /><br />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" /><br />
        <button type="submit">submit</button>
    </form>
</body>
</html>