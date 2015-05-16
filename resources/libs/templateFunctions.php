<?php
    require_once(realpath(dirname(__FILE__) . "/../config.php"));
    
    function renderContentView($contentFile, $data) {        
               
        require_once(TEMPLATES_PATH . "/header.php");
        echo '<div class="row">';
        echo '<div id="nav" class="col-xs-3">';
        require_once(TEMPLATES_PATH . "/navigation.php");
        echo "</div>";
        
        echo '<div id=\"content\" class="col-xs-9">';
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div></div></div>";
        
        require_once(TEMPLATES_PATH . "/footer.php");
    }
?>