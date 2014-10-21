<?php

namespace core;

/**
 * Esta é a principal classe do sitema
 * Ela contem toda a lógica de negócio
 * para trabalhar as rotas e os controladores  da nossa aplicação
 * Class Router
 * @package core
 */

abstract class Router
{
    /**
     * Error - Trait que comtem a chamda de página de erros
     * $routes - array que guardará as rotas da aplicação, definidas manualmente por nós
     */
    use Error;
    private $routes;


    /**
     * método set da propeirdade $routes
     * @param $routes
     */
    protected function _routes($routes)
    {
        $this->routes = $routes;
    }


    /**
     * Filtra a url que o usuário digitar, retirando query string(?rel=1&item=2),
     * pois nossa aplicação trabalhará apenas com urls amigáveis
     * É uma função simples, porém requer o básico de entendimento de expressões regulares
     * @return mixed|string
     */
    private function _uri()
    {
        $url = preg_replace("#([a-zA-Z0-9\/]+)(\?.*)?#", "$1", $_SERVER['REQUEST_URI']);
        if(substr_count($url,'/')>1)
            $url = rtrim($url,'/');
        return $url;
    }


    /**
     * Método run()
     * Este é concerteza o principal método da classe
     * É ele que irá comparar se a url que o usuário informou
     * é compatível com alguma das rotas que definimos
     */
    protected function run()
    {
        $url = $this->_uri();
        $_404 = '';

        array_walk($this->routes, function($r) use ($url, &$_404){

            $route_sufix_param = preg_match("/@param/", $r['route']);
            $rota   = preg_replace("/@param/", '', $r['route']);
            $preg_r = preg_quote($rota, '/');
            $route_simple = ($rota==$url);
            $url_params = preg_match("/($preg_r+)(\/.*)/", $url, $m);
            if($route_simple || ($route_sufix_param and $url_params))
            {

                $controller = $r['controller'];
                $param = explode('/', $m[2]);
                $controller{strripos($controller, '/')} = ucfirst($controller{strripos($controller, '/')});
                $class = str_replace("/", "\\", $controller);
                $file = PATH_CONTROLLER.DS.$controller.'.php';

                if(file_exists($file))
                {
                    $controller = "app\\controller\\".$class;
                    if(class_exists($controller))
                    {
                        $class = new $controller();
                        if(method_exists($class,$r['action']))
                        {
                            if($param)
                            {
                                $class->$r['action']($param);
                            }
                            else
                            {
                                $class->$r['action']();
                            }
                        }
                        else
                        {
                            $data = array('title'=>'Método Controller', 'content'=>'O método '.$r['action'].' não foi definido');
                            Error::msg($data);
                        }
                    }
                    else
                    {
                        $data = array('title'=>'Classe Controller', 'content'=>'A classe '.$controller.' não foi definida');
                        Error::msg($data);
                    }
                }
                else
                {
                    $data = array('title'=>'Arquivo Controller', 'content'=>'O controller '.$file.' não encontrado');
                    Error::msg($data);
                }
            }
            else
            {
                $_404++;
            }
        });

        if($_404==count($this->routes))
        {
            $data = array('title'=>'404 - No found', 'content'=>'A página que você procurta não existe');
            Error::msg($data);
        }
    }
}