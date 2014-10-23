<?php

namespace app\controller;


use app\helpers\Data,
    core\Controller;

class Index extends Controller
{

    public function index()
    {
        $data = $this->model('licitacoes');
        $data->licits = $data->select();
        $moda = $this->model('modalidades');
        if($_POST)
        {
            extract($_POST);
            $sql = "titulo LIKE '%{$titulo}%'";
            if($status)
            {
                $sql .= " AND status = '$status'";
            }
            if($ano)
            {
                $sql .= " AND data_ini LIKE '%$ano%'";
            }
            if($modalidade)
            {
                $sql .= " AND modalidade = '$modalidade'";
            }
            if($data_ini && $data_end)
            {
                $horas = ' '.date('H:i:s');
                $data_ini .= $horas;
                $data_end .= $horas;
                $d_ini = Data::data($data_ini,'en');
                $d_end = Data::data($data_end,'en');
                $sql .= " AND (data_ini BETWEEN '$d_ini' AND '$d_end')";
            }
            if($processo)
            {
                $sql .= " AND processo LIKE '%$processo%'";
            }
            $data->licits = $data->select($sql);
            #echo $data->sql = $sql;
        }
        $data->modalidades = $moda->select();
        $this->render('front/index', $data);
    }
} 