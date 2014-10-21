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
    public static function status($int)
    {
        if($int==1)
        {
            $status = '<i class="badge badge-success">Correndo</i>';
        }
        elseif($int==2)
        {
            $status = '<i class="badge badge-important">Finalizada</i>';
        }
        else
        {
            $status = '<i class="badge">Desconhecido</i>';
        }
        return $status;
    }


    public static function rText($string, $limit=13)
    {
        $text = strip_tags($string);
        $space  = strrpos(substr($text, 0, $limit), ' ');
        $text = substr($text,0, $space);
        return $text;
    }
} 