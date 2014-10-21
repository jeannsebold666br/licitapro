<?php
date_default_timezone_set('America/Sao_Paulo');
define('PATH_ROOT', dirname(__DIR__));
define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']);
define('BASE', 'http://licita.dev');
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('PATH_MODEL', PATH_ROOT.DS.'src'.DS.'app'.DS.'model');
define('PATH_VIEW', PATH_ROOT.DS.'src'.DS.'app'.DS.'view');
define('PATH_CONTROLLER', PATH_ROOT.DS.'src'.DS.'app'.DS.'controller');
set_include_path(PATH_ROOT.DS.'src'.PS.PATH_ROOT.DS.'vendor'.PS.get_include_path());
define('DB_TYPE', 'my');
