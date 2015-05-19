<?php

require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once(LIBRARY_PATH . "/templateFunctions.php");

class View {
    
    public function renderContent($template, $data) {
        renderContentView($template, $data);
    }
    
    public function renderDashboard($template, $data) {
        renderDashboardView($template, $data);
    }
    
    public function renderWithoutNavigation($template, $data) {
        renderWithoutNavigation($template, $data);
    }
    
    public function renderLogin($template, $data) {
        renderLoginView($template, $data);
    }
}

?>