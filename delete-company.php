<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new WarehouseMap())->existsWarehouseByCompanyId($id) || (new WarehouseMap())->existsMachineByCompanyId($id) || !(new CompanyMap())->delete($id)) {
        Helper::setFlash('Невозможно удалить компанию. К ней привязаны склады или станки.');
    }
    header('Location: list-company.php');
?>