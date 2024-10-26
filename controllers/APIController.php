<?php

namespace Controllers;

use Model\Category;
use Model\Tool;

class APIController{
    public static function tool(){
        //Consulta herramientas y retorna los datos en formato JSON
        $tools = Tool::all();
        echo json_encode($tools);
    }

    public static function category(){
        //Consulta herramientas y retorna los datos en formato JSON
        $categories = Category::all();
        echo json_encode($categories);
    }
}