<?php

namespace library;
use app\helpers\Log,
    db\Db;

/**Classe que espera por um objeto para
 * persisti-lo no banco de dados
 * Class DataMapper
 * @package library
 */
class DataMapper
{

    /**Recebe um objeto e o insere no banco
     * @param $obj
     * @throws \Exception
     */
    public static function _insert($obj)
    {
        try
        {
            $table = $obj::TABLE;
            $data  = $obj->getData();
            $data['id'] = self::lastId($table)+1;

            $sql = "INSERT INTO {$table} ";

            foreach($data as $key=>$val)
            {
                $names[]   = "{$key}";
                $holders[] = ":{$key}";
            }
            $names   = implode(', ',$names);
            $holders = implode(', ',$holders);
            $sql .= "($names) VALUES ($holders)";
            $stmt = Db::conn()->prepare($sql);
            foreach($data as $key=>$val)
            {
                $stmt->bindValue(":{$key}", $val);
            }
            echo $sql;
            if($stmt->execute())
            {
                return true;
            }
        }
        catch(\PDOException $e)
        {
            Log::e($e->getCode(),$e->getLine(),$e->getFile(),$e->getMessage());
        }
    }

    /**Seleciona uma lista de objetos no banco
     * @param $obj
     * @param string $campos
     * @param null $cond
     * @return array
     */
    public static function _select($obj, $cond=null)
    {
        try
        {
            $table = $obj::TABLE;
            $sql = "SELECT * FROM $table";
            if($cond) $sql .= " WHERE $cond";
            $stmt = Db::conn()->prepare($sql);
            if($stmt->execute())
            {
                if($stmt->rowCount()>=1)
                {
                    return $stmt->fetchAll(\PDO::FETCH_OBJ);
                }
            }
        }
        catch(\PDOException $e)
        {
            Log::e($e->getCode(),$e->getLine(),$e->getFile(),$e->getMessage());
        }
    }

    /** Atualiza objetos no banco
     * @param $obj
     * @param $cond
     * @throws \Exception
     */
    public static function _update($obj, $cond)
    {
        try
        {
            $table = $obj::TABLE;
            $data  = $obj->getData();

            $sql = "UPDATE {$table} SET ";

            foreach($data as $key=>$val)
            {
                $new_data[]   = "{$key}=:{$key}";
            }
            $holders = implode(', ', $new_data);
            $sql .= "$holders WHERE $cond";
            $stmt = Db::conn()->prepare($sql);
            foreach($data as $key=>$val)
            {
                $stmt->bindValue(":{$key}", $val);
            }

            if($stmt->execute())
            {
                return true;
            }
        }
        catch(\PDOException $e)
        {
            Log::e($e->getCode(),$e->getLine(),$e->getFile(),$e->getMessage());
        }
    }


    /**Deleta um objeto da tabela
     * @param $obj
     * @param $cond
     * @return bool
     * @throws \Exception
     */
    public static function _delete($obj, $cond)
    {
        try
        {
            $table = $obj::TABLE;
            $sql  = "DELETE FROM $table WHERE $cond";
            $stmt = Db::conn()->query($sql);
            if($stmt->execute())
            {
                return true;
            }
        }
        catch(\PDOException $e)
        {
            Log::e($e->getCode(),$e->getLine(),$e->getFile(),$e->getMessage());
        }
    }


    /**Pesquisa um objeto no banco
     * @param $obj
     * @param string $campos
     * @param $cond
     * @return mixed
     * @throws \Exception
     */
    public static function find($obj, $cond)
    {
        try
        {
            $table = $obj::TABLE;
            $sql  = "SELECT * FROM $table WHERE $cond";
            $stmt = Db::conn()->prepare($sql);
            if($stmt->execute())
            {
                if($stmt->rowCount()==1)
                {
                    return $stmt->fetch(\PDO::FETCH_OBJ);
                }
            }
        }
        catch(\PDOException $e)
        {
            Log::e($e->getCode(),$e->getLine(),$e->getFile(),$e->getMessage());
        }
    }


    /**Retorna a sempre o último id inserido
     * da tabela especificada
     * @param $table
     * @return mixed
     */
    private static function lastId($table)
    {
        $conn = Db::conn()->prepare("SELECT max(id) FROM {$table}");
        $conn->execute();
        $max = $conn->fetch(\PDO::FETCH_ASSOC);
        return $max['max(id)'];
    }
} 