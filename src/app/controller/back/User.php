<?php

namespace app\controller\back;

use app\model\Users,
    core\Controller;

class User extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('users');
    }

    public function index()
    {
        $data = $this->model->select();
        if($_POST)
        {
            $data = $this->model->select("(nome LIKE '%{$_POST['s']}%' OR email LIKE '%{$_POST['s']}%')");
        }
        $this->render('back/users/index', $data);
    }

    public function salvar($param=null)
    {
        if(!$param[1])
        {
            $data = (object) $_POST;
            $this->model->insert();
        }
        else
        {
            $data = $this->model->ver("id = '{$param[1]}'");
            $this->model->update("id = '{$param[1]}'", $data->email);
        }
        $this->render('back/users/novo', $data);
    }

    public function delete($param)
    {
        $this->model->delete("id={$param[1]}");
    }


    public function login()
    {
        $this->model->login();
        $data = Users::$check;
        $this->render('back/login', $data);
    }

    public function logoff()
    {
        $this->model->logoff();
    }
} 