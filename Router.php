<?php

namespace MVC;

class Router{
    //almacenar las rutas que respondan a solicitudes GET
    public $getRoutes = [];
    //almacenar las rutas que respondan a solicitudes POST
    public $postRoutes = [];

    //Este método permite registrar una ruta para solicitudes GET.
    public function get($url, $fn){
        //Almacena la URL y la función en el array $getRoutes, donde la URL es la clave y la función es el valor.
        $this->getRoutes[$url] = $fn;
    }

    //Este método permite registrar una ruta para solicitudes POST.
    public function post($url, $fn){
        //Almacena la URL y la función en el array $getRoutes, donde la URL es la clave y la función es el valor.
        $this->postRoutes[$url] = $fn;
    }

    //comprobar qué función debe ejecutarse para la ruta actual, en función del método de solicitud (GET o POST).
    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null; 

        $protectedRoutes = ['/admin', '/tools/create', '/tools/update', '/tools/delete', '/categories/create', '/categories/update', '/categories/delete', '/logout'];

        //obtiene la ruta actual, devuelve la ruta a la que se accede
        $actualUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        //Determina el método de la solicitud (GET o POST)
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET'){
            //Si el método es GET, busca la función asociada a la URL actual en $getRoutes.
            $fn = $this->getRoutes[$actualUrl];
        } else{
            //Si el método es POST, busca la función asociada a la URL actual en $getRoutes.
            $fn = $this->postRoutes[$actualUrl];
        }

        if(in_array($actualUrl, $protectedRoutes) && !$auth){
            header('Location: /');
        }

        if($fn){
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    public function render($view, $elements = []){
        foreach($elements as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}