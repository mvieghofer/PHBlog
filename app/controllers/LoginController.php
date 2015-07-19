<?php
require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

class LoginController extends Controller {
        
    public function indexAction() {
        $data = [];
        $data['csrftoken'] = $this->updateCSRFToken();
        
        $this->view('login/login', $data);
    }
    
    public function loginAction() {
        $error = false;
        if (strcmp($_POST['csrftoken'], $_COOKIE[Config::$csrfTokenCookieName]) !== 0) {
            $error = true;
            $data['csrftoken'] = $this->updateCSRFToken();
        }
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            
            $user = User::where('username', '=', $email)->where('is_active', '=', '1')->first();
            if ($user != null) {
                //var_dump(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["salt" => $user->salt]);
                if ($user->password === $password) {
                    $token = md5(uniqid($email, true));
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
        $loginCookie->token = $user->token;
        setcookie(Config::$loginCookieName, json_encode($loginCookie), $user->remember_until->getTimestamp());
    }
}

?>