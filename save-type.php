<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['type_id'])) {
        $type = new Type();
        $type->type_id = Helper::clearInt($_POST['type_id']);
        $type->name = Helper::clearString($_POST['name']);
        if ((new TypeMap())->save($type)) {
            header('Location: view-type.php?id='.$type->type_id);
        } else {
            if ($type->type_id) {
                header('Location: add-type.php?id='.$type->type_id);
            } else {
                header('Location: add-type.php');
            }
        }
    }
?>