<!doctype html>

<html lang="en">
<head>
    <title>PHBlog</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/phblog/public/css/style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <header>
            <h1><a href="<?php echo PHBlog::getUrl('/dashboard'); ?>">PHBlog</a></h1>
        </header>
        <div id="menu">
           <a id="dashboard" href='<?php echo PHBlog::getUrl('/'); ?>'>Show Blog</a>
        </div>