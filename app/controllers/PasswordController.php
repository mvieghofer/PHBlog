<?php
use Mailgun\Mailgun;
class PasswordController extends Controller {
    
    public function showNewAction($token) {
        $data = [];
        $data['csrftoken'] = $this->updateCSRFToken();
        $data['token'] = $token;
        $this->view('password/new', $data);
    }
    
    public function newAction() {
        $error = false;
        $data = [];
        if (strcmp($_POST['csrftoken'], $_COOKIE[Config::$csrfTokenCookieName]) !== 0) {
            $error = true;
        } else if (isset($_POST['token']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {
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
        $data['csrftoken'] = $this->updateCSRFToken();
        $data = ['token' => $token];
        if ($error) {
            $data['errorText'] = "Sorry we could not reset your password. You could <a href='" . Router::getUrl('/password/reset') . "'>try it again</a>.";
        }
        $this->view('password/new', $data);
    }
    
    public function resetAction() {
        $data = [];
        if (strcmp($_POST['csrftoken'], $_COOKIE[Config::$csrfTokenCookieName]) !== 0) {
            $data['errorText'] = "Sorry, your request couldn't be processed.";
        } else if (isset($_POST['email'])) {
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
                
                $url = Router::getAbsoluteUrl("/password/new/$token");
                $mg->sendMessage($domain, array(
                   'from' => 'phblog-password@devcouch.net',
                   'to' => $_POST['email'],
                   'subject' => 'Reset your password',
                   'text' => "You want to reset your password! Please click this link to reset your password: $url."
                ));
                parent::redirect("/login");
            }
        }
        $data['csrftoken'] = $this->updateCSRFToken();
        $this->view('password/reset', $data);    
    }
    
    public function showResetAction() {
        $data = [];
        $data['csrftoken'] = $this->updateCSRFToken();
        $this->view('password/reset', $data);    
    }
    
    protected function renderView($view, $data = []) {
        $this->view->renderLogin($view, $data);
    }
}

?>