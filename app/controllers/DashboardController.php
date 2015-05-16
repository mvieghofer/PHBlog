<?php
class DashboardController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction() {
        $data = [
            "articles" => Post::where('ispage', '=', 0)->get(),
            "pages" => Post::where('ispage', '=', 1)->get()
            ];
        
        $this->view("dashboard/index", $data);
    }
}
?>