<?php

namespace Controllers;

use Model\Tool;

class APIController{
    public static function index(){
        $tools = Tool::all();
        echo json_encode($tools);
    }
}