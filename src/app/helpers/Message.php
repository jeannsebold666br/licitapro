<?php

namespace app\helpers;


class Message
{

    public static function set($msg, $tipo)
    {
        session_start();
        $msg = "
        <div class=\"alert alert-$tipo\">
        <a href=\"#\" class=\"close\" data-dismiss=\"alert\">x</a>
        $msg
        </div>
        ";
        $_SESSION['msg'] = $msg;
    }

    public static function get()
    {
        if(!empty($_SESSION['msg']))
        {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    }
} 