<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['warehouse_id'])) {
        $warehouse = new Warehouse();
        $warehouse->warehouse_id = Helper::clearInt($_POST['warehouse_id']);
        $warehouse->company_id = Helper::clearInt($_POST['company_id']);
        $warehouse->name = Helper::clearString($_POST['name']);
        $warehouse->address = Helper::clearString($_POST['address']);
        $warehouse->square = Helper::clearInt($_POST['square']);
        if ((new WarehouseMap())->save($warehouse)) {
            header('Location: view-warehouse.php?id='.$warehouse->warehouse_id);
        } else {
            if ($warehouse->warehouse_id) {
                header('Location: add-warehouse.php?id='.$warehouse->warehouse_id);
            } else {
                header('Location: add-warehouse.php');
            }
        }
    }
?>