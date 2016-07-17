<?php

include_once 'views/header.tpl.php';
include_once 'views/nav.tpl.php';
if (isset($create)):
    if ($create === "file"):
        include_once 'views/createFile.tpl.php';
    else:
        if ($create === "category"):
            include_once 'views/createCategory.tpl.php';
        endif;
    endif;
else:
    if (isset($_GET['id']) && isset($_GET['name'])):
        include_once 'views/updateCategory.tpl.php';
    elseif (isset($_GET['id']) && isset($_GET['title'])):
        include_once 'views/updateFile.tpl.php';
    else:
        if (empty($_POST)):
            include_once 'views/homepage.tpl.php';
        else:
            if (isset($_POST['category'])):
                include_once 'views/list.tpl.php';
            endif;
        endif;
    endif;
endif;

include_once 'views/footer.tpl.php';
