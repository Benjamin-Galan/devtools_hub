<?php

namespace Controllers;

use Model\Category;
use MVC\Router;

class CategoryController{

    public static function create(Router $router){
        $category = new Category;
        $errors = Category::getErrors();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //instanciar una nueva categoria
            //arreglo de vendedores
            $category = new Category($_POST['category']);
        
            //validar que no haya campos vacios
            $errors = $category->validate();
        
            //guardar si no hay errores
            if (empty($errors)) {
                $result = $category->save();
            }
        }

        $router->render('categories/create', [
            'category' => $category,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router){
        $id = validateRedirect('/admin');

        $category = Category::find($id);
        $errors = Category::getErrors();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //asignar los valores
            $args = $_POST['category'];
            
            //sincronizar el objeto en memoria con los nuevos datos que el usuario envia
            $category->sincronizar($args);
        
            //validacion
            $errors = $category->validate();
        
            if(empty($errors)){
                $category->update();
            }
        }

        $router->render('categories/update', [
            'category' => $category,
            'errors' => $errors
        ]);
    }

    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $type = $_POST['type'];

                if(validateType($type)){
                    $category = Category::find($id);
                    $category->delete();
                }
            }
        }
    }
}