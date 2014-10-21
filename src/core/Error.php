<?php

namespace core;

trait Error
{

    public static function msg($data)
    {
        require_once PATH_VIEW.DS.'error.phtml';
    }
} 