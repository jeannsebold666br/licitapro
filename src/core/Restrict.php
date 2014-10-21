<?php

namespace core;


class Restrict
{
    private static $verify;

    private function __construct(){}

    public static function verify()
    {
        if(!self::$verify)
        {
            session_start();
            if(!empty($_SESSION['aut']))
            {
                self::$verify = true;
            }
            else
            {
                session_destroy();
                header("location: ".BASE.'/admin');
            }
        }
    }
} 