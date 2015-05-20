<?php
require_once('LoginController.php');
class DashboardController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderDashboard($view, $data);
    }
    
    public function indexAction() {
        if (isset($_COOKIE[Config::$loginCookieName])) {
            
        } else {
            parent::redirect('login');
        }
        $data = [
            "articles" => Post::where('ispage', '=', 0)->get(),
            "pages" => Post::where('ispage', '=', 1)->get()
            ];
        
        $this->view("dashboard/index", $data);
    }
}
?>