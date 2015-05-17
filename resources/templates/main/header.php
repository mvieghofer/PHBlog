<?php
    require_once(realpath(dirname(__FILE__) . "/../header.php"));
?>
</head>
<body>
    <div class="container">
        <header>
            <h1><a href="<?php echo PHBlog::getUrl('/'); ?>">PHBlog</a></h1>
        </header>
        <div id="menu">
           <a id="dashboard" href='<?php echo PHBlog::getUrl('/dashboard'); ?>'>dashboard</a>
        </div>