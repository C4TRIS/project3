<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new TypeMap())->existsTypeById($id) && !(new ModelMap())->existsModelByTypelId($id)) {
        (new TypeMap())->delete($id);
    } else if ((new TypeMap())->existsTypeById($id) || (new ModelMap())->existsModelByTypelId($id)) {
        Helper::setFlash('Произошла ошибка при удалении типа станка. К нему привязаны модели.');
    }
    header('Location: list-type.php');
?>