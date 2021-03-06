<?php

namespace app\helpers;

class Data
{
    /** Formatar data
     * @param $datetime
     * @param string $format
     * @param bool $hora
     * @return string
     */
    public static function data($datetime, $format='en', $hora=false)
    {
        $date = explode(' ', $datetime);

        if($format=='en')
        {
            $data = explode('/', $date[0]);
            $res = "{$data[2]}-{$data[1]}-{$data[0]} {$date[1]}";
        }
        elseif($format=='br')
        {
            $data = explode('-', $date[0]);
            $res = "{$data[2]}/{$data[1]}/{$data[0]}";
            if($hora) $res .= " {$date[1]}";
        }
        else
        {
            $res = 'Format Inválid';
        }
        return $res;
    }

    public static function dataval($data_inicial, $data_final)
    {
        $ini = new \DateTime(date($data_inicial));
        $end = new \DateTime(date($data_final));
        if($end<$ini)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    /**Captura o nome de uma modalidade especificada
     * @param $id
     * @return mixed
     */
    public static function modalidade($id)
    {
        $modalidade = new \app\model\Modalidades();
        $modalidade = $modalidade->ver("id=$id");
        return $modalidade->nome;
    }


    /** Processa o status
     * @param $int
     * @return string
     */
    public static function status($id, $data=null)
    {
        $d1 = new \DateTime();
        $d2 = new \DateTime($data);
        if($d1>$d2)
        {
            $licit = new \app\model\Licitacoes();
            $licit->data = array('status'=>2);
            $licit->update("id='{$id}'");
            $status = '<i class="badge badge-important">Finalizada</i>';
        }
        else
        {
            $licit = new \app\model\Licitacoes();
            $licit->data = array('status'=>1);
            $licit->update("id='{$id}'");
            $status = '<i class="badge badge-success">Correndo</i>';
        }
        return $status;
    }

    public static function rText($string, $limit=13)
    {
        $text = strip_tags($string);
        if(strlen($string)>$limit)
        {
            $space  = strrpos(substr($text, 0, $limit), ' ');
            $text = substr($text,0, $space);
        }
        return $text;
    }
} 