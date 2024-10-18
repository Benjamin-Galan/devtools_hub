<?php

namespace Model;

class Admin extends ActiveRecord{
    //base de datos
    //protected porque solo accerdere a ellos desde la clase
    protected static $tabla = 'admin';
    protected static $db_columns = ['id', 'email', 'password'];

    //
    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validate()
    {
        if(!$this->email){
            self::$errors[] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$errors[] = 'El password es obligatorio';
        }

        return self::$errors;
    }

    public function userExists(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if(!$result->num_rows){
            self::$errors[] = 'El usuario no existe';
        }

        return $result;
    }

    public function checkPassword($result){
        $user = $result->fetch_object();
        
        $authenticated = password_verify($this->password, $user->password);

        if(!$authenticated){
            self::$errors[] = 'La contraseña es incorrecta'; 
        }

        return $authenticated;
    }

    public function authenticate(){
        session_start();

        //llenar el arreglo de sesion
        $_SESSION['user'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}