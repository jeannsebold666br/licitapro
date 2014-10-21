<?php
use core\Router;

class Application extends Router
{

    public function __construct()
    {
        $routes = array(
            // ROTAS FRONT END
            array(
                'route'      => '/',
                'controller' => 'index',
                'action'     => 'index'
            ),
            // ROTAS BACK END
            array(
                'route'      => '/logar',
                'controller' => 'back/user',
                'action'     => 'login'
            ),
            array(
                'route'      => '/logoff',
                'controller' => 'back/user',
                'action'     => 'logoff'
            ),
            array(
                'route'      => '/panel',
                'controller' => 'back/index',
                'action'     => 'index'
            ),
            array(
                'route'      => '/panel/usuarios',
                'controller' => 'back/user',
                'action'     => 'index'
            ),
            array(
                'route'      => '/panel/usuarios/novo@param',
                'controller' => 'back/user',
                'action'     => 'salvar'
            ),
            array(
                'route'      => '/panel/usuarios/del@param',
                'controller' => 'back/user',
                'action'     => 'delete'
            ),
            array(
                'route'      => '/panel/modalidades',
                'controller' => 'back/modalidades',
                'action'     => 'index'
            ),
            array(
                'route'      => '/panel/modalidades/nova@param',
                'controller' => 'back/modalidades',
                'action'     => 'salvar'
            ),
            array(
                'route'      => '/panel/modalidades/del@param',
                'controller' => 'back/modalidades',
                'action'     => 'delete'
            ),
            array(
                'route'      => '/panel/licitacoes',
                'controller' => 'back/licitacoes',
                'action'     => 'index'
            ),
            array(
                'route'      => '/panel/licitacoes/novo@param',
                'controller' => 'back/licitacoes',
                'action'     => 'salvar'
            ),
            array(
                'route'      => '/panel/licitacoes/del@param',
                'controller' => 'back/licitacoes',
                'action'     => 'delete'
            )
        );

        $this->_routes($routes);
    }

    public function run()
    {
        parent::run();
    }

}