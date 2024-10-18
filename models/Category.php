<?php

namespace Model;

class Category extends ActiveRecord
{
    //allows to identify the shape of the columns in the database to map it with the object
    protected static $db_columns = ['id', 'name', 'description'];
    protected static $tabla = 'categories';

    public $id;
    public $name;
    public $description;

    //toma un arreglo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
    }

    //referencias a la instancia de post de crear
    public function validate()
    {

        if (!$this->name) {
            self::$errors[] = "Debes añadir un nombre";
        }

        if (!$this->description) {
            self::$errors[] = "Debes añadir una descripcion";
        }
        
        return self::$errors;
    }
}
