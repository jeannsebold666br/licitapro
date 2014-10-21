<?php

namespace app\controller\back;

use core\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->render('back/index');
    }
} 