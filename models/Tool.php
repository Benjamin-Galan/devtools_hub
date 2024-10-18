<?php

namespace Model;

class Tool extends ActiveRecord
{
    //allows to identify the shape of the columns in the database to map it with the object

    protected static $db_columns = ['id', 'name', 'image', 'description', 'url', 'category_id'];
    protected static $tabla = 'tools';

    public $id;
    public $name;
    public $image;
    public $description;
    public $url;
    public $category_id;

    //toma un arreglo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
    }

    //referencias a la instancia de post de crear
    public function validate()
    {

        if (!$this->name) {
            self::$errors[] = "Debes añadir un nombre";
        }

        if (!$this->image) {
            self::$errors[] = "La imagen es obligatoria";
        }

        if (!$this->description) {
            self::$errors[] = "Debes añadir una descripcion";
        }

        if (!$this->category_id) {
            self::$errors[] = "Selecciona una categoría";
        }

        return self::$errors;
    }

    public static function countByCategoryId($categoryId) {
        $query = "SELECT COUNT(*) as count FROM " . static::$tabla . " WHERE category_id = " . self::$db->escape_string($categoryId);
        $result = self::$db->query($query);
        $count = $result->fetch_assoc();

        return (int)$count['count'];
    }
}
