<?php

namespace app\model;

use app\helpers\Message,
    library\ActiveRecord;

class Users extends ActiveRecord
{
    const TABLE = 'users';
    public static $check;

    public function insert()
    {
        if($_POST)
        {
            if(array_search('', $_POST))
            {
                Message::set('Todos os campos são obrigatórios.', 'error');
            }
            else
            {
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    Message::set('O email que você informou é inválido', 'warning');
                }
                elseif($_POST['pass'] != $_POST['pass2'])
                {
                    Message::set('As senhas informadas não conferem', 'warning');
                }
                else
                {
                    if(parent::ver("email='{$_POST['email']}'"))
                    {
                        Message::set('O email que você está informando já existe', 'error');
                    }
                    else
                    {
                        unset($_POST['pass2']);
                        $_POST['pass'] = md5($_POST['pass']);
                        $_POST['data'] = date('Y-m-d H:i:s');
                        $this->data = $_POST;
                        if(parent::insert())
                        {
                            header("location: ".BASE.'/panel/usuarios');
                        }
                        else
                        {
                            Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
                        }
                    }
                }
            }
        }
    }


    public function update($cond, $field)
    {
        if($_POST)
        {
            if($i=array_search('', $_POST))
            {
                unset($_POST[$i]);
            }

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                Message::set('O email que você informou é inválido', 'warning');
            }
            elseif(isset($_POST['pass']) && ($_POST['pass'] != $_POST['pass2']))
            {
                Message::set('As senhas informadas não conferem', 'warning');
            }
            else
            {
                if((parent::ver("email='{$_POST['email']}'")) && ($_POST['email']!=$field))
                {
                    Message::set('O email que você está informando já existe', 'error');
                }
                else
                {
                    unset($_POST['pass2']);
                    $_POST['pass'] = md5($_POST['pass']);
                    $this->data = $_POST;
                    if(parent::update($cond))
                    {
                        header("location: ".$_SERVER['REQUEST_URI']);
                    }
                    else
                    {
                        Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
                    }
                }
            }
        }
    }


    public function delete($cond)
    {
        if(parent::delete($cond))
        {
            header("location: ".BASE.'/panel/usuarios');
        }
        else
        {
            Message::set('Não foi possível realizar a operação. Tente novamente.', 'error');
        }
    }


    public function login()
    {
        session_start();
        if($_POST)
        {
            $email   = $_POST['email'];
            $senha   = md5($_POST['senha']);
            $lembrar = $_POST['lembrar'];
            $user = parent::ver("email='{$email}' AND pass='{$senha}'");
            if(!$user)
            {
                Message::set('Acesso negado.', 'error');
            }
            else
            {
                if($lembrar==1)
                {
                    $value = base64_encode($user->email).'&'.base64_encode($_POST['senha']);
                    setcookie('aut', $value, strtotime('+30days'),'/');
                }
                else
                {
                    setcookie('aut', '', time()-3600);
                }

                $_SESSION['aut'] = $user;
                header("location: ".BASE.'/panel');
            }
        }
        elseif(!empty($_SESSION['aut']))
        {
            header("location: ".BASE.'/panel');
        }
        elseif(!empty($_COOKIE['aut']))
        {
            $user  = explode('&', $_COOKIE['aut']);
            $email = base64_decode($user[0]);
            $senha = base64_decode($user[1]);
            $check['email'] = $email;
            $check['senha'] = $senha;
            $check['check'] = true;
            self::$check = $check;
        }
        else{}
    }

    public function logoff()
    {
        session_start();
        session_destroy();
        header("location: ".BASE.'/logar');
    }

} 