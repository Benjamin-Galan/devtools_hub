<?php
 
function connectDB(){
    $db = new mysqli('localhost', 'root', 'root', 'devtools_hub_db');

    if(!$db){
        echo "Error en la conexion";
        exit;
    }

    return $db;
}