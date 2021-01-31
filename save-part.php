<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['part_id'])) {
        $part = new Part();
        $part->part_id = Helper::clearInt($_POST['part_id']);
        $part->model_id = Helper::clearInt($_POST['model_id']);
        $part->name = Helper::clearString($_POST['name']);
        if ((new PartMap())->save($part)) {
            header('Location: view-part.php?id='.$part->part_id);
        } else {
            if ($part->part_id) {
                header('Location: add-part.php?id='.$part->part_id);
            } else {
                header('Location: add-part.php');
            }
        }
    }
?>