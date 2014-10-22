<?php

namespace app\model;

use app\helpers\Data,
    app\helpers\Message,
    library\ActiveRecord;

class Licitacoes extends ActiveRecord
{
    const TABLE = 'licitacoes';

    public function insert()
    {
        $data_ini = $_POST['data_ini'] ? Data::data($_POST['data_ini'],'en') : date('Y-m-d H:i:s');
        $data_end = $_POST['data_end'] ? Data::data($_POST['data_end'],'en') : date('Y-m-d H:i:s');

        if($_POST)
        {
            while($i=array_search('', $_POST))
            {
                unset($_POST[$i]);
            }

            if(!$_POST['titulo'])
            {
                Message::set('Informe um título para licitação', 'error');
            }
            else
            {
                if(parent::ver("processo='{$_POST['processo']}'"))
                {
                    Message::set('Já existe um registro com o processo que você está informando', 'error');
                }
                else
                {
                    if(Data::dataval($data_ini,$data_end))
                    {
                        Message::set('A data de encerramento é inválida', 'error');
                    }
                    else
                    {
                        $_POST['data_ini'] = $data_ini;
                        $_POST['data_end'] = $data_end;
                        $_POST['objetivo'] = addslashes($_POST['objetivo']);
                        $this->data = $_POST;
                        if(parent::insert())
                        {
                            header("location: ".BASE.'/panel/licitacoes');
                        }
                        else
                        {
                            Message::set('Não foi possível realizar a operação', 'error');
                        }
                    }
                }
            }
        }
    }


    public function update($cond, $field=null)
    {
        $data_ini = $_POST['data_ini'] ? Data::data($_POST['data_ini'],'en') : date('Y-m-d H:i:s');
        $data_end = $_POST['data_end'] ? Data::data($_POST['data_end'],'en') : date('Y-m-d H:i:s');

        if($_POST)
        {

            if((parent::ver("processo='{$_POST['processo']}'")) && ($_POST['processo']!=$field))
            {
                Message::set('Já existe um registro com o processo que você está informando', 'error');
            }
            else
            {
                $_POST['data_ini'] = $data_ini;
                $_POST['data_end'] = $data_end;
                #$_POST['objetivo'] = addslashes($_POST['objetivo']);
                $this->data = $_POST;
                if(parent::update($cond))
                {
                    header("location: ".$_SERVER['REQUEST_URI']);
                }
                else
                {
                    Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
                }
            }
        }
    }


    public function delete($cond)
    {
        if(parent::delete($cond))
        {
            header("location: ".BASE.'/panel/licitacoes');
        }
        else
        {
            Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
        }
    }
} 