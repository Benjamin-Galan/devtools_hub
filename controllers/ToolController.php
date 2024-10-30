<?php

namespace Controllers;

use Model\Category;
use Model\Tool;
use MVC\Router;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ToolController
{
    public static function index(Router $router)
    {
        //mensaje condicional
        $result = $_GET['result'] ?? null;
        $tools = Tool::all();
        $categories = Category::all();
        //se guarda el metodo all y se pasa hacia la vista

        $router->render('tools/admin', [
            'tools' => $tools,
            'categories' => $categories,
            'result' => $result
        ]);
    }

    public static function create(Router $router)
    {
        $tool = new Tool;
        $categories = Category::all();
        $errors = Tool::getErrors();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //la instancia se crea hasta recibir datos en el post
            $tool = new Tool($_POST['tool']);

            //genera un nombre unico
            $imgName = md5(uniqid(rand(), true)) . ".webp";

            //make a resize to the image with intervention
            // create new image instance (800 x 600)
            if ($_FILES['tool']['tmp_name']['image']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['tool']['tmp_name']['image']);
                // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
                $image->cover(800, 600);
                $tool->setImage($imgName);
            }

            //llama al metodo validar y los resultados asigna a errores
            $errors = $tool->validate();

            if (empty($errors)) {
                //crear la carpeta de imagenes
                //revisa si no existe
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //save image in the server
                $image->save(CARPETA_IMAGENES . $imgName);

                //la variable guarda la referencia del objeto
                //guarda en la base de datos
                $tool->save();
            }
        }

        $router->render('tools/create', [
            'tool' => $tool,
            'categories' => $categories,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        $id = validateRedirect('/admin');
        $tool = Tool::find($id);
        $categories = Category::all();
        $errors = Tool::getErrors();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar todo el post al arreglo (sus llaves y valores)
            //es como si fuera $args['name'] = $_POST['name'] ?? null;
            $args = $_POST['tool'];
            $tool->sincronizar($args);
            $errors = $tool->validate();

            //validacion de subida de archivos
            if ($_FILES['tool']['tmp_name']['image']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['tool']['tmp_name']['image']);
                $image->cover(800, 600);

                //genera un nombre unico
                $imgName = md5(uniqid(rand(), true)) . ".webp";
                $tool->setImage($imgName);
            }

            if (empty($errors)) {
                if ($_FILES['tool']['tmp_name']['image']) {
                    //almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $imgName);
                }

                $tool->save();
            }
        }

        $router->render('/tools/update', [
            'tool' => $tool,
            'errors' => $errors,
            'categories' => $categories
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id =  $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $type = $_POST['type'];
                if(validateType($type)){
                    $tool = Tool::find($id);
                    $tool->delete();
                }
            }
        }
    }
}
