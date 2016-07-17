<?php

if ($_POST):
    if ($_POST['category'] === 'Sélectionner une catégorie'):
        header('location: ' . $url);
    endif;
endif;

if ($_GET['action']):
    if ($_GET['action'] === "createFile"):
        $create = "file";
    endif;
    if ($_GET['action'] === "createCat"):
        $create = "category";
    endif;
    if ($_GET['action'] === "comebackToList"):
        header('location: ' . $url);
    endif;
endif;
