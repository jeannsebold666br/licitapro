<?php

namespace core;


class Controller
{
    use Error;

    protected function model($model)
    {
        $file = PATH_MODEL.DS.$model.'.php';
        if(file_exists($file))
        {
            require_once $file;
            $model{strripos($model, '/')} = ucfirst($model{strripos($model, '/')});
            $model = str_replace('/','\\', $model);
            $class = "app\\model\\".$model;
            return $class = new $class();
        }
        else
        {
            $data = array(
                'title' => 'Página não encontrada',
                'body'  => '<h1>404 - Not Found</h1> - A Model '.$file.' Não pode ser encontrada'
            );
            $this->render('error', $data);
        }
    }

    protected function render($view, $data=null)
    {
        $view = PATH_VIEW.DS.$view.'.phtml';
        if(file_exists($view))
        {
            require_once $view;
        }
        else
        {
            $data = array(
                'title' => 'Página não encontrada',
                'body'  => '<h1>404 - Not Found</h1> - A página '.$view.' Não pode ser encontrada'
            );
            Error::msg($data);
        }
    }
} 