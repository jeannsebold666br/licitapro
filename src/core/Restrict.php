<?php

namespace core;

use app\model\Users;

class Restrict
{
    private static $verify;

    private function __construct(){}

    public static function verify()
    {
        if(!self::$verify)
        {
            session_start();
            $user = new Users();
            if($user->ver("email='{$_SESSION['aut']->email}' AND pass='{$_SESSION['aut']->pass}'"))
            {
                self::$verify = true;
            }
            else
            {
                session_destroy();
                header("location: ".BASE.'/logar');
            }
        }
    }
} 