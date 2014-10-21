<?php

namespace app\helpers;


class Redirect
{
    public static function url($url)
    {
        header("location: ".$url);
    }
} 