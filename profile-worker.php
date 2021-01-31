<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    } else {
        header('Location: 404.php');
    }
    $header = 'Профиль Работника';
    $worker = (new WorkerMap())->findProfileById($id);
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
            <h1>Профиль Работника</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="list-worker.php">Работники</a></li>
                <li class="active">Профиль</li>
            </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-worker.php?id=<?=$id;?>">Изменить</a>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-hover">
                    <?php require_once '_profile.php';?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>