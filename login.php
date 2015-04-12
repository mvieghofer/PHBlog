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
    <?php
        require("logincookie.php");
        require("db.php");
        
        if (isset($_GET["username"]) && isset($_GET["password"])) {
            global $conn;
            $statement = $conn->prepare("SElECT password FROM User WHERE username = :username");
            $statement->execute(array(':username'=>$_GET["username"]));
            $result = $statement->fetch();
            
            if ($result['password'] == $_GET['password']) {
                $loginCookie = new LoginCookie();
                $loginCookie->userId = 1;
                $loginCookie->userName = $_GET["username"];
                setcookie(LOGIN_COOKIE_NAME, json_encode($loginCookie), time() + (86400 * 30), "/");
                header("Location: dashboard.php");
            } else {
                echo "<p>Error. Email or password is not correct</p>";
            }
        }
    ?>
    <form action="login.php" method="get">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" /><br />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" /><br />
        <button type="submit">submit</button>
    </form>
</body>
</html>