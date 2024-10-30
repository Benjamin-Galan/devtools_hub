<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'functions.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/build/images/');

function includeTemplate(string $name, bool $inicio = false){
    include TEMPLATES_URL . "/{$name}.php";
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function isAuth() : bool {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
    return false;
}

function s($html):string{
    $s = htmlspecialchars($html);
    return $s;
}

function validateType($type){
    $types = ['category', 'tool'];

    return in_array($type, $types);
}

function showAlerts($code){
    $message = '';

    switch($code){
        case 1:
            $message = 'Creado Correctamente';
            break;
        case 2:
            $message = 'Actualizado correctamente';
            break;
        case 3:
            $message = 'Eliminado correctamente';
            break;
        case 4:
            $message = 'No puedes eliminar esta categoría porque tiene herramientas asociadas. Elimina las herramientas primero.';    
            break;
        default:
            $message = false;
            break;
    }

    return $message;
}

function validateRedirect(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }

    return $id;
}