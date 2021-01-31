<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new WorkerMap())->findById($id)) {
        $worker = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = "Накладные работника: ".$worker->full_name;
    $waybills = (new WaybillMap())->findByWorkerId($id);
    $i = 1;
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
        <section class="content-header">
            <h1><?=$header;?></h1>
            <ol class="breadcrumb">
                <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="list-worker-waybill.php">Работники</a></li>
                <li class="active"><?=$header;?></li>
            </ol>
        </section>
        <div class="box-body">
            <a class="btn btn-success" href="add-waybill.php?id=<?=$id;?>">Добавить накладную</a>
        </div>
        <?php if (Helper::hasFlash()) :?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i>Ошибка</h4>
                <?= Helper::getFlash();?>
            </div>
        <?php endif;?>
            <div class="box-body">
            <?php if ($waybills) : ?>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Склад</th>
                        <th>Деталь</th>
                        <th>Дата получния</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

            <?php foreach ($waybills as $waybill) : ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$waybill->warehouse;?></td>
                    <td><?=$waybill->part;?></td>
                    <td><?=$waybill->date_recieved;?></td>
                    <td><?=$waybill->price;?></td>
                    <td><a href="delete-waybill.php?id=<?=$waybill->waybill_id;?>&idwaybill=<?=$id;?>"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php $i++; endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Не найдено ни одной накладной</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>