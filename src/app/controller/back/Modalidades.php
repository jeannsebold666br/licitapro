<?php

namespace app\controller\back;

use core\Controller;

class Modalidades extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('modalidades');
    }

    public function index()
    {
        $data = $this->model->select();
        $this->render('back/licitacoes/modalidades/index', $data);
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
            $this->model->update("id = '{$param[1]}'", $data->nome);
        }
        $this->render('back/licitacoes/modalidades/novo', $data);
    }

    public function delete($param)
    {
        $this->model->delete("id={$param[1]}");
    }
} 