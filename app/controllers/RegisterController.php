<?php

use Mailgun\Mailgun;
class RegisterController extends Controller {
    public function indexAction() {
        $data = [];
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $user = new User();
            $user->username = $_POST['email'];
            if (User::where('username', '=', $user->username)->count() > 0) {
                $data['errorText'] = 'A user with this email address exists already';
            } else {
                $user->salt = $this->getSalt();
                $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["salt" => $user->salt]);
                $user->is_active = false;
                if (isset($_POST['first'])) {
                    $user->first_name = $_POST['first'];    
                }
                if (isset($_POST['last'])) {
                    $user->last_name = $_POST['last'];
                }
                $user->save();
                
                $pendingUsers = new PendingUsers();
                $pendingUsers->user_id = $user->id;
                $pendingUsers->token = md5(uniqid($user->username, true));
                $pendingUsers->save();
                
                $mg = new Mailgun(Config::$keys['mailgun']);
                $domain = 'devcouch.net';
                
                $url = PHBLog::getAbsoluteUrl("/register/activate/$pendingUsers->token");
                $username = " " . $user->first_name;
                $mg->sendMessage($domain, array(
                   'from' => 'phblog-account@devcouch.net',
                   'to' => $_POST['email'],
                   'subject' => 'Activate your account',
                   'text' => "Hi$username! You just created a PHBlog account. That's awesome! Please click this link to activate your account: $url."
                ));
            }
        }
        $this->view('register/index', $data);
    }
    
    public function activateAction($token) {
        $data = [];
        $pendingUser = PendingUsers::where('token', '=', $token)->first();
        if ($pendingUser != null) {
            $user = User::find($pendingUser->user_id);
            if ($user != null) {
                $user->is_active = true;
                $user->save();
                $pendingUser->delete();
                $data['msg'] = "Your user was successfully activated";
                $data['success'] = 'true';
            } else {
                $data['msg'] = "Your account cannot be activated. Maybe you have already done that?";
                $data['success'] = 'false';
            }
        } else {
            $data['msg'] = "Your account cannot be activated. Maybe you have already done that?";
            $data['success'] = 'false';
        }
        $this->view('register/activate', $data);
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderLogin($view, $data);
    }
    
    private function getSalt() {
        $characters = 'abcdefghijklmnopqrstuvwxyzABZDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $salt = '';
        for ($i = 0; $i < 22; $i++) {
             $salt .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $salt;
    }
}
?>