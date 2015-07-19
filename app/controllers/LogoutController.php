<?php

class LogoutController extends Controller {
    public function indexAction() {
        if (isset($_COOKIE[Config::$loginCookieName])) {
            $loginCookie = json_decode($_COOKIE[Config::$loginCookieName]);
            $user = User::where('token', '=', $loginCookie->token)->first();
            if ($user != null) {
                $user->token = null;
                $user->remember_until = new DateTime('yesterday');
                $user->save();
            }
            setcookie(Config::$loginCookieName, "", time() - 3600);
            setcookie(Config::$csrfTokenCookieName, "", time() - 3600);
            parent::redirect("/");
        }
    }
}
?>