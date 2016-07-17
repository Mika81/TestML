<?php

if (empty($_POST)):
    $lastThree = $file_manager->getLastThree();
    $allFiles = $file_manager->getAllFiles();
endif;

if (isset($_POST['category'])):
    $categoryId = $_POST['category'];
    $idList = $file_manager->getIdFilesForOneCategory($categoryId);

    if (false !== $idList):
        for ($i = 0; $i < count($idList); $i++):
            $id = $idList[$i]['id_File'];
            $fileList[] = $file_manager->getList($id);
        endfor;
    endif;
endif;

if (isset($_POST['title'])):
    if (!empty($_POST['title']) && !empty($_POST['description'])):
        $file = array(
            'title' => $_POST['title'],
            'description' => $_POST['description']
        );
        $newFile = new File($file);
        $lastInsertId = $file_manager->add($newFile);
        $keys = array_keys($_POST);
        $last_key = $keys[count($keys) - 1];
        $last_key_plus = $last_key + 1;

        for ($i = 0; $i < $last_key_plus; $i++):
            $cats = $_POST[$i];
            if (is_numeric($cats)):
                $file_manager->associateCategory($lastInsertId, $cats);
            endif;
        endfor;
        $msg .= "<div class='alert alert-success text-center'>Fiche '" . $file['title'] . "' enregistrée</div>";
    else:
        $msg .= "<div class='alert alert-danger text-center'>Tous les champs doivent être complétés</div>";
    endif;
endif;

if (isset($_POST['clickToUpdateFile'])):
    $idFileToUpdate = $_POST['clickToUpdateFile'];
    $UpdateFile = $file_manager->getAll($idFileToUpdate);
    header('location:' . $url . '/?id=' . $UpdateFile['id'] . '&title=' . substr($UpdateFile['title'], 1, -1) . '&description=' . substr($UpdateFile['description'], 1, -1));
endif;

if (isset($_POST['ModifyTitle'])):
    if (!empty($_POST['ModifyTitle']) && !empty($_POST['ModifyDescription'])):
        $fileToUpdate = array(
            'id' => $_POST['id'],
            'title' => $_POST['ModifyTitle'],
            'description' => $_POST['ModifyDescription']
        );
        $updateFile = new File($fileToUpdate);
        $file_manager->update($updateFile);
        $newCategories = array();
        foreach ($_POST as $key => $value):
            if ($key !== 'id' && $key !== 'ModifyTitle' && $key !== 'ModifyDescription'):
                array_push($newCategories, $value);
            endif;
        endforeach;
        $file_manager->deleteAssociationWithCategory($fileToUpdate['id']);
        for ($i = 0; $i < count($newCategories); $i++):
            $cats = $newCategories[$i];
            $file_manager->associateCategory($fileToUpdate['id'], $cats);
        endfor;
        header('location:' . $url . '/?id=' . $fileToUpdate['id'] . '&title=' . $fileToUpdate['title'] . '&description=' . $fileToUpdate['description'] . '&status=updatedFile');
    else:
        $msg .= "<div class='alert alert-danger text-center'>Tous les champs doivent être complétés</div>";
    endif;
endif;

if (isset($_GET['status']) && $_GET['status'] === 'updatedFile'):
    $msg .= "<div class='alert alert-success text-center'>La fiche '" . $_GET['title'] . "' a été modifiée </div>";
endif;

if (isset($_POST['deleteFile'])):
    $idFileToDelete = $_POST['deleteFile'];
    $file_manager->delete($idFileToDelete);
    $file_manager->deleteAssociationWithCategory($idFileToDelete);

    header('location:' . $url);
endif;