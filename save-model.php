<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['model_id'])) {
        $model = new Model();
        $model->model_id = Helper::clearInt($_POST['model_id']);
        $model->type_id = Helper::clearInt($_POST['type_id']);
        $model->name = Helper::clearString($_POST['name']);
        if ((new modelMap())->save($model)) {
            header('Location: view-model.php?id='.$model->model_id);
        } else {
            if ($model->model_id) {
                header('Location: add-model.php?id='.$model->model_id);
            } else {
                header('Location: add-model.php');
            }
        }
    }
?>