<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['part_id'])) {
        $waybill = new Waybill();
        $waybill->waybill_id = Helper::clearInt($_POST['waybill_id']);
        $waybill->user_id = Helper::clearInt($_POST['user_id']);
        $waybill->part_id = Helper::clearInt($_POST['part_id']);
        $waybill->price = Helper::clearInt($_POST['price']);
        $waybill->date_recieved = Helper::clearString($_POST['date_recieved']);
        $waybill->warehouse_id = Helper::clearInt($_POST['warehouse_id']);
        $waybillMap = new WaybillMap();
        if ($waybill->validate() && $waybillMap->save($waybill)) {
            header('Location: view-waybill.php?id='.$waybill->user_id);
        } else {
            Helper::setFlash('Не удалось сохранить накладную.');
            header('Location: add-waybill.php');
        }
    }
?>