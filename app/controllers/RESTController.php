<?php
class RESTController extends Controller {
    public function get() {
        echo json_encode($this->getJSONObject('get'));
    }
    
    public function post() {
        echo json_encode($this->getJSONObject('post'));
    }
    
    public function put() {
        echo json_encode($this->getJSONObject('put'));
    }
    
    public function delete() {
        echo json_encode($this->getJSONObject('delete'));
    }
    
    public function multi() {
        echo json_encode($this->getJSONObject('multi'));
    }
    
    private function getJSONObject($method) {
        $json = new MyJSONObject();
        $json->method = $method;
        return $json;
    }
}

class MyJSONObject {
    public $method;
}
?>