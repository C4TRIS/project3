<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    (new PartMap())->delete($id);
    if ((new PartMap())->existsWaybillByPartId($id) || !(new PartMap())->delete($id)) {
        Helper::setFlash('Невозможно удалить деталь. Она имеет привязанную накладную.');
    }
    header('Location: list-part.php');
?>