<?php

require_once 'model/file/File.class.php';
require_once 'model/file/FileManager.class.php';
require_once 'model/category/Category.class.php';
require_once 'model/category/CategoryManager.class.php';

/* Database informations ($host) */
include_once 'src/database_informations.php';

/* Database connection */
try {
    $db = new PDO('mysql:host=' . $host['hostname'] . ';dbname=' . $host['db_name'], $host['user_name'], $host['user_pwd']);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . " !!!<br/>";
    die();
}
