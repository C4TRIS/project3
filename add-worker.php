<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $worker = (new WorkerMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' работника';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-worker.php">Работники</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-user.php" method="POST">
    <?php require_once '_formUser.php'; ?>
        <input type="hidden" name="role_id" value="2"/>
        <div class="form-group">
            <button type="submit" name="saveWorker" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>