<?php

class LoginController extends Controller {
    public function indexAction() {
        $this->view('login/login');
    }
    
    public function loginAction() {
        if (!isset($_POST['login']) || !isset($_POST['password'])) {
            parent::redirect('/login');
        }
        
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $user = User::where('username', '=', $login)->first();
        if ($user != null && $user->password === $password) {
            parent::redirect('/dashboard');
        } else {
            parent::redirect('/login?error=true');
        }
    }
    
    public function resetAction() {
        $this->view('login/reset');    
    }
    
    public function registerAction() {
        $this->view('login/register');
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderLogin($view, $data);
    }
}

?>