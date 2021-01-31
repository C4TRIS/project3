<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }

    $id = Helper::clearInt($_GET['id']);
    $role = Helper::clearString($_GET['role']);

    if($role == 'worker') {
        if ((new UserMap())->existsUserById($id) && !(new WorkerMap())->existsMachineByUserId($id) && !(new WorkerMap())->existsWaybillByUserId($id)) {
            (new WorkerMap())->delete($id);
        } else if ((new UserMap())->existsUserById($id) || (new WorkerMap())->existsMachineByUserId($id) || (new WorkerMap())->existsWaybillByUserId($id)) {
            Helper::setFlash('Ошибка при удалении пользователя. К нему привязаны станки или накладные');
        }
        header('Location: list-worker.php');
    }
?>