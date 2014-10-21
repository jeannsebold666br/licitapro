<?php

namespace app\helpers;


class Log
{
    private $msg;

    public static function e($cod, $line, $file, $msg)
    {
        $filelog = PATH_ROOT.'/error.log';
        if(file_exists($filelog))
            $content = file_get_contents($filelog);

        $data = date('d/m/Y H:i:s');
        $text = "{$data} - Error:: {$msg}, Código:{$cod}, linha: {$line}, arquivo: {$file} \n";
        file_put_contents($filelog, $text.$content);
    }
} 