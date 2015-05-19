<?php
    require_once(realpath(dirname(__FILE__) . "/../config.php"));
    
    function renderContentView($contentFile, $data) {        
        require_once(TEMPLATES_PATH . "/main/header.php");
        echo '<div class="row">';
        echo '<div id="nav" class="col-xs-3">';
        require_once(TEMPLATES_PATH . "/main/navigation.php");
        echo "</div>";
        
        echo '<div id="content" class="col-xs-9">';
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div></div><!-- row -->";
        
        require_once(TEMPLATES_PATH . "/main/footer.php");
    }
    
    function renderDashboardView($contentFile, $data) {        
        require_once(TEMPLATES_PATH . "/dashboard/header.php");
        echo '<div class="row">';
        echo '<div id="nav" class="col-xs-3">';
        require_once(TEMPLATES_PATH . "/dashboard/navigation.php");
        echo "</div>";
        
        echo '<div id="content" class="col-xs-9">';
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div></div><!-- row -->";
        
        require_once(TEMPLATES_PATH . "/dashboard/footer.php");
    }
    
    function renderWithoutNavigation($contentFile, $data) {
        require_once(TEMPLATES_PATH . "/edit/header.php");
        echo '<div class="row">';        
        echo '<div id="content" class="col-xs-12">';
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div></div><!-- row -->";
        
        require_once(TEMPLATES_PATH . "/edit/footer.php");
    }
    
    function renderLoginView($contentFile, $data) {
        require_once(TEMPLATES_PATH . "/login/header.php");
        echo '<div class="row">';
        
        echo '<div id="content" class="col-xs-12">';
        if (file_exists($contentFile)) {
            require_once($contentFile);
        } else {
            require_once(TEMPLATES_PATH . "/error.php");
        }
        echo "</div></div><!-- row -->";
        
        require_once(TEMPLATES_PATH . "/login/footer.php");
    }
?>