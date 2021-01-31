<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);

    if (!(new MachineMap())->existsMachineByModelId($id) && !(new PartMap())->existsPartByModelId($id)) {
        (new ModelMap())->delete($id);
    } else if ((new MachineMap())->existsMachineByModelId($id) || (new PartMap())->existsPartByModelId($id)) {
        Helper::setFlash('Невозможно удалить модель. Она имеет привязанные станки или детали.');
    }
    header('Location: list-model.php');
?>