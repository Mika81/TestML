<?php

/**/
/* Debug function */
function d($arg) {
    print "<pre>";
    print_r($arg);
    print "</pre>";
}
$msg = '';
$url = 'http://test.diw.fr';
/**/

include_once 'controller/controller.php';
include_once 'controller/router.php';

$file_manager =  new FileManager($db);
$category_manager =  new CategoryManager($db);

require_once 'controller/fileController.php';
require_once 'controller/categoryController.php';
//d($_POST);
//print 'POST';
//d($_POST);
//print'GET';
//d($_GET);
include_once 'views/index.tpl.php';

?>