<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    $idWorker = Helper::clearInt($_GET['idWorker']);
    (new SchedulesMap())->delete($id);
    header('Location: list-schedule.php?id='.$idWorker);
?>