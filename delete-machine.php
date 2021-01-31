<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if (!(new MachineMap())->delete($id)) {
        Helper::setFlash('Произошла ошибка при удалении.');
    }
    header('Location: list-machine.php');
?>