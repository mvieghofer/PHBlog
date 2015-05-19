<?php
require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

class LoginController extends Controller {
    
    const cookieName = "login_cookie";
    
    public function indexAction() {
        if (isset($_COOKIE[LoginController::cookieName])) {
            parent::redirect('dashboard');
        }
        
        $error = false;
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            
            $user = User::where('username', '=', $email)->where('is_active', '=', '1')->first();
            if ($user != null) {
                //var_dump(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["salt" => $user->salt]);
                if ($user->password === $password) {
                    $token = md5(uniqid(rand(), true));
                    $user->token = $token;
                    $user->remember = isset($_POST['remember']);
                    $this->saveUser($user);
                    parent::redirect('/dashboard');
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        }
        $data = [];
        if ($error) {
            $data = ['errorText' => 'The username or password was not correct.'];
        }
        $this->view('login/login', $data);
    }
    
    public function registerAction() {
        $this->view('login/register');
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderLogin($view, $data);
    }
    
    private function saveUser($user) {
        $expirationDate = new DateTime();
        $expirationDate->add(new DateInterval("PT24H"));
        if ($user->remember) {
            $expirationDate->add(new DateInterval('P6D'));
        }
        $user->remember_until = $expirationDate;
        $user->save();
        
        $loginCookie = new LoginCookie();
        $loginCookie->username = $user->username;
        $loginCookie->token = $user->token;
        setcookie(LoginController::cookieName, json_encode($loginCookie), $user->remember_until->getTimestamp());
    }
}

?>