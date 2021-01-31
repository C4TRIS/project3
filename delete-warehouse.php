<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new WaybillMap())->existsWaybillByWarehouseId($id) || !(new WarehouseMap())->delete($id)) {
        Helper::setFlash('Невозможно удалить склад. Он имеет привязанные накладные.');
    }
    header('Location: list-warehouse.php');
?>