<?php

namespace library;

/**Classe base que será extendia para preparar um
 * objeto a ser passado à classe DadaMapper
 * Class ActiveRecord
 * @package library
 */

abstract class ActiveRecord
{
    public $data;

    public function __set($prop, $value)
    {
        // verifica se existe método set_<propriedade>
        if (method_exists($this, 'set'.ucfirst($prop)))
        {
            // executa o método set_<propriedade>
            call_user_func(array($this, 'set'.ucfirst($prop)), $value);
        }
        else
        {
            if ($value === NULL)
            {
                unset($this->data[$prop]);
            }
            else
            {
                // atribui o valor da propriedade
                $this->data[$prop] = $value;
            }
        }
    }

    public function __get($prop)
    {
        // verifica se existe método get_<propriedade>
        if (method_exists($this, 'get'.ucfirst($prop)))
        {
            // executa o método get_<propriedade>
            return call_user_func(array($this, 'get'.ucfirst($prop)));
        }
        else
        {
            // retorna o valor da propriedade
            if (isset($this->data[$prop]))
            {
                return $this->data[$prop];
            }
        }
    }


    /**Retorna o array existente na tabela
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * Inserção
     */
    public function insert()
    {
        if(DataMapper::_insert($this))
            return true;
        else
            return false;
    }


    /**listagem
     * @return array
     */
    public function select($cond=null)
    {
        $list = DataMapper::_select($this,$cond);
        if($list)
        {
            return $list;
        }
    }

    /**
     * @param $cond
     */
    public function update($cond)
    {
        if(DataMapper::_update($this, $cond))
        {
            return true;
        }
    }


    public function delete($cond)
    {
        if(DataMapper::_delete($this, $cond))
        {
            return true;
        }
    }


    public function ver($cond)
    {
        $data = DataMapper::find($this,$cond);
        if($data)
        {
            return $data;
        }
    }

} 