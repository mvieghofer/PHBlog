<?php
    require_once(realpath(dirname(__FILE__) . "/../config.php"));
    
    function renderLayoutWithContentfile($contentFile, $data) {        
        /*if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }*/
        
        require_once(TEMPLATES_PATH . "/header.php");
        
        echo "<div id=\"nav\">";
        require_once(TEMPLATES_PATH . "/navigation.php");
        echo "</div>";
        
        echo "<div id=\"content\">";
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div>";
        
        require_once(TEMPLATES_PATH . "/footer.php");
    }
?>