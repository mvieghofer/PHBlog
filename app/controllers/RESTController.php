<?php
require_once(realpath(dirname(__FILE__) . '/../../resources/config.php'));

class RESTController extends Controller {
    public function indexAction($id = -1) {
        $json = '';
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method) {
            case 'GET':
                if ($id !== -1) {
                   $json = json_encode($this->getPost($id));
                }
                break;
            case 'POST':
                break;
            case 'DELETE':
                break;
            case 'PUT':
                break;
        }
        http_response_code(200);
        header('Content-Type: application/json');
        print $json;
    }
    
    private function getPost($id) {
        return Post::find($id);
    }
    
    private function savePost() {
    }
}
?>