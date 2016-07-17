<?php

if (isset($_POST['category'])):
    $id = $_POST['category'];
    $category = $category_manager->getName($id);
endif;

$categoryList = $category_manager->getList();

if (isset($_POST['name'])):
    if (!empty($_POST['name']) && !empty($_POST['description'])):
        $category = array(
            'name' => $_POST['name'],
            'description' => $_POST['description']
        );
        $newCategory = new Category($category);
        $category_manager->add($newCategory);
        header('location:' . $url . '/?action=createCat&name=' . $category['name'] . '&status=created');
    else:
        $msg .= "<div class='alert alert-danger text-center'>Tous les champs doivent être complétés</div>";
    endif;
endif;

if (isset($_POST['ModifyName'])):
    if (!empty($_POST['ModifyName']) && !empty($_POST['ModifyDescription'])):
        $categoryToUpdate = array(
            'id' => $_POST['id'],
            'name' => $_POST['ModifyName'],
            'description' => $_POST['ModifyDescription']
        );
        $updateCategory = new Category($categoryToUpdate);
        $category_manager->update($updateCategory);
        header('location:' . $url . '/?id=' . $categoryToUpdate['id'] . '&name=' . $categoryToUpdate['name'] . '&description=' . $categoryToUpdate['description'] . '&status=updated');
    else:
        $msg .= "<div class='alert alert-danger text-center'>Tous les champs doivent être complétés</div>";
    endif;
endif;

if (isset($_GET['status']) && $_GET['status'] === 'updated'):
    $msg .= "<div class='alert alert-success text-center'>La catégorie '" . $_GET['name'] . "' a été modifiée </div>";
endif;
if (isset($_GET['status']) && $_GET['status'] === 'created'):
    $msg .= "<div class='alert alert-success text-center'>La catégorie '" . $_GET['name'] . "' a été crée </div>";
endif;

if (isset($_POST['clickToUpdate'])):
    $idCatToUpdate = $_POST['clickToUpdate'];
    $UpdateCategory = $category_manager->getAll($idCatToUpdate);
    header('location:' . $url . '/?id=' . $UpdateCategory['id'] . '&name=' . substr($UpdateCategory['name'], 1, -1) . '&description=' . substr($UpdateCategory['description'], 1, -1));
endif;

if (isset($_POST['delete'])):
    $idCatToDelete = $_POST['delete'];
    $category_manager->delete($idCatToDelete);
    $category_manager->deleteAssociationWithFile($idCatToDelete);
    header('location:' . $url . '/?action=createCat');
endif;

