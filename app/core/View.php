<?php

require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));
require_once(LIBRARY_PATH . "/templateFunctions.php");

class View {
    
    public function render($template, $data) {
        renderLayoutWithContentfile($template, $data);
    }
}

?>