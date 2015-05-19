<?php
use Mailgun\Mailgun;
class PasswordController extends Controller {
    
    const cookieName = "login_cookie";
    
    public function newAction($token = -1) {
        $error = false;
        $data = [];
        if (isset($_POST['token']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];
            if ($password == $password_repeat) {
                $token = $_POST['token'];
                $userPasswordReset = UserPasswordReset::where('token', '=', $token)->first();
                if ($userPasswordReset != null) {
                    $user = User::find($userPasswordReset->user_id);
                    if ($user != null) {
                        $user->password = password_hash($password, PASSWORD_BCRYPT, ["salt" => $user->salt]);
                        $user->save();
                        $userPasswordReset->delete();
                        parent::redirect('/login');
                    } else {
                        $error = true;
                    }
                } else {
                    $error = true;
                }
            } else {
                $data['errorText'] = "The passwords didn't match.";
            }
        }
        $data = ['token' => $token];
        if ($error) {
            $data['errorText'] = "Sorry we could not reset your password. You could <a href='" . PHBlog::getUrl('/password/reset') . "'>try it again</a>.";
        }
        $this->view('password/new', $data);
    }
    
    public function resetAction() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = User::where('username', '=', $email)->first();
            if ($user != null) {
                $mg = new Mailgun(Config::$keys['mailgun']);
                $domain = 'devcouch.net';
                
                $token = md5(uniqid(rand(), true));
                
                
                $userPasswordReset = UserPasswordReset::find($user->id);
                if ($userPasswordReset == null) {
                    $userPasswordReset = new UserPasswordReset();
                    $userPasswordReset->user_id = $user->id;
                }
                $userPasswordReset->token = $token;
                $userPasswordReset->save();
                
                $url = "http://localhost/phblog/password/new/$token";
                $mg->sendMessage($domain, array(
                   'from' => 'phblog-password@devcouch.net',
                   'to' => $_POST['email'],
                   'subject' => 'Reset your password',
                   'text' => "You want to reset your password! Please click this link to reset your password: $url."
                ));
                parent::redirect("/login");
            }
        }
        $this->view('password/reset');    
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderLogin($view, $data);
    }
}

?>