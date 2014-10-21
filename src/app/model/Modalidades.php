<?php

namespace app\model;

use app\helpers\Message,
    library\ActiveRecord;

class Modalidades extends ActiveRecord
{
    const TABLE = 'modalidades';

    public function insert()
    {
        if($_POST)
        {
            if(!$_POST['nome'])
            {
                Message::set('Informe o nome da modalidade.', 'error');
            }
            else
            {
                if(parent::ver("nome='{$_POST['nome']}'"))
                {
                    Message::set('Já há uma modalidade com esse nome', 'error');
                }
                else
                {
                    $this->data = $_POST;
                    if(parent::insert())
                    {
                        header("location: ".BASE.'/panel/modalidades');
                    }
                    else
                    {
                        Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
                    }
                }
            }
        }
    }


    public function update($cond, $field)
    {
        if($_POST)
        {
            if((parent::ver("nome='{$_POST['nome']}'")) && ($_POST['nome']!=$field))
            {
                Message::set('Esta modalidade já existe', 'error');
            }
            else
            {
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
            header("location: ".BASE.'/panel/modalidades');
        }
        else
        {
            Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
        }
    }
} 