<?php

namespace Model;

class ActiveRecord
{

    //base de datos
    protected static $db;
    //allows to identify the shape of the columns in the database to map it with the object
    protected static $db_columns = [];
    protected static $tabla = '';

    protected static $errors = [];

    public static function setdb($database)
    {
        self::$db = $database;
    }

    //iterates over each column in database
    public function attributes()
    {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    public function sanitize()
    {
        $attributes = $this->attributes();
        $sanitized = [];

        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }

        return $sanitized;
    }

    public function setImage($image)
    {
        //elimina la imagen previa
        if (!is_null($this->id)) {
            $this->deleteImage();
        } 

        if ($image) {
            $this->image = $image;
        }
    }

    public function deleteImage()
    {
        //comprobar si el archivo existe
        $fileExists = file_exists(CARPETA_IMAGENES . $this->image);

        if ($fileExists) {
            unlink(CARPETA_IMAGENES . $this->image);
        }
    }

    public static function getErrors()
    {
        return static::$errors;
    }

    //referencias a la instancia de post de crear
    public function validate()
    {
        static::$errors = [];
        return static::$errors;
    }

    public function save()
    {
        if (!is_null($this->image) && !is_null($this->id)) {
            //actualizamos
            $this->update();
        } else {
            //creamos
            $this->create();
        }

        return $result;
    }

    public function create()
    {
        //sanitizar los datos
        $attributes = $this->sanitize();

        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        if ($result) {
            header('Location: /admin?result=1');
        }
    }

    public function update()
    {
        //sanitizar los datos
        $attributes = $this->sanitize();

        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1; ";

        $result = self::$db->query($query);

        if ($result) {
            header('Location: /admin?result=2');
        }
    }

    //lista todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $result = self::consultSQL($query);

        return $result;
    }

    //obtener detetminado numero de registros
    public static function get($cant)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cant;
        
        $result = self::consultSQL($query);

        return $result;
    }

    public function delete()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id =  " . self::$db->escape_string($this->id) . " LIMIT 1;";

        $result = self::$db->query($query);

        if ($result) {
            $this->deleteImage();
            header('Location: /admin?result=3');
        }

        return $result;
    }

    //busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $result = self::consultSQL($query);

        return array_shift($result);
    }

    public static function consultSQL($query)
    {
        //consultar la base de datos
        $result = self::$db->query($query);

        //iterar los resultados y los guarda como un array de objetos
        $array = [];
        while ($reg = $result->fetch_assoc()) {
            $array[] = static::createObject($reg);
        }

        //liberar la memoria
        $result->free();

        //retornar los resultados
        return $array;
    }
    //objetos que se quedan en memoria
    protected static function createObject($reg)
    {
        $object = new static;

        foreach ($reg as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    //sincronoza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
