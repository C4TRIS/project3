<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    $idWaybill = Helper::clearInt($_GET['idWaybill']);
    if(!(new WaybillMap())->delete($id)) {
        Helper::setFlash('Произошла ошибка при удалении накладной.');
    }
    header('Location: list-waybill.php?id='.$idWaybill);
?>