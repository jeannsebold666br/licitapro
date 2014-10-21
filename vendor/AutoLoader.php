<?php

class AutoLoader
{

    public $dir = array();

    public function register()
    {
        return spl_autoload_register(array($this, 'loader'));
    }


    public function loader($file)
    {

        if(strstr($file, '\\'))
        {
            $class = str_replace('\\', DS, ltrim($file)).'.php';
        }
        else
            $class = str_replace('_', DS, $file).'.php';

        if(!empty($this->dir))
        {
            foreach($this->dir as $dir)
            {
                $file_class = rtrim($dir,'/').DS.$class;
                if(file_exists($file_class))
                    return include_once $file_class;
            }
        }

        if(file_exists($class))
        {
            return include_once $class;
        }

        if(stream_resolve_include_path($class) !== false)
        {
            return include_once $class;
        }
    }

} 