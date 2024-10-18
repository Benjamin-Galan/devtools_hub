<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $errors = [];
        $auth = new Admin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //crea una nueva instancia con lo que recibe en post
            $auth = new Admin($_POST);

            $errors = $auth->validate();

            if(empty($errors)){
                //verificar si el usuario existe
                $result = $auth->userExists();
                
                if(!$result){
                    $errors = Admin::getErrors();
                } else {
                    //verificar la contraseña
                    $authenticated = $auth->checkPassword($result);
                }

                //autenticar al usuario
                if($authenticated){
                    $auth->authenticate();
                } else {
                    $errors = Admin::getErrors();
                }
            }
        }

        $router->render('/auth/login', [
            'errors' => $errors
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}