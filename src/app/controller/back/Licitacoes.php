<?php

namespace app\controller\back;


use app\helpers\Data,
    core\Controller;

class Licitacoes extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('licitacoes');
    }

    public function index()
    {
        $data = $this->model->select();
        if($_POST)
        {
            $data = $this->model->select("(titulo LIKE '%{$_POST['s']}%' OR processo LIKE '%{$_POST['s']}%')");
        }
        $this->render('back/licitacoes/index', $data);
    }

    public function salvar($param=null)
    {
        $modalidades = $this->model('modalidades');
        if(!$param[1])
        {
            $data = (object) $_POST;
            $this->model->insert();
        }
        else
        {
            $data = $this->model->ver("id = '{$param[1]}'");
            Data::status($param[1], $data->data_end);
            $this->model->update("id = '{$param[1]}'", $data->processo);
        }

        $data->modalidades = $modalidades->select();
        $this->render('back/licitacoes/novo', $data);
    }

    public function delete($param)
    {
        $this->model->delete("id={$param[1]}");
    }
} 