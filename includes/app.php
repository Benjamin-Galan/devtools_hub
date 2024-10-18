<?php

require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;
$db = connectDB();

//conectarnos a la base de datos
ActiveRecord::setdb($db);
