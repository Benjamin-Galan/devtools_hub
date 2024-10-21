<?php

namespace Controllers;

use Model\Category;
use Model\Tool;
use MVC\Router;

class PagesController
{
    public static function index(Router $router)
    {   
        $tools = Tool::get(8);
        $inicio = true;

        $router->render('pages/index', [
            'tools' => $tools,
            'inicio' => $inicio
        ]);
    }

    public static function elements(Router $router) {
        $tools = Tool::all();
        $categories = Category::all();

        $router->render('pages/elements', [
            'tools' => $tools,
            'categories' => $categories
        ]);
    }
}
