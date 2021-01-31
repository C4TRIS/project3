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
    if ((new WorkerMap())->findById($id)) {
        $waybill = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = 'Добавить накладную : '.$waybill->full_name;
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-worker-waybill.php">Накладные работников</a></li>
        <li><a href="list-waybill.php?id=<?=$id;?>">Накладная работника</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
<?php if (Helper::hasFlash()) :?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Ошибка</h4>
        <?= Helper::getFlash();?>
    </div>
<?php endif;?>
    <form action="save-waybill.php" method="POST">
        <div class="form-group">
            <label>Склад</label>
            <select class="form-control" name="warehouse_id">
                <?= Helper::printSelectOptions($waybill->warehouse_id, (new WarehouseMap())->arrWarehouses());?>
            </select>
        </div>
        <div class="form-group">
            <label>Деталь</label>
            <select class="form-control" name="part_id">
                <?= Helper::printSelectOptions($waybill->part_id, (new PartMap())->arrParts());?>
            </select>
        </div>
        <div class="form-group">
            <label>Цена</label>
            <input type="number" class="form-control" name="price" required="required" value="<?=$waybill->price;?>">
        </div>
        <div class="form-group">
            <label>Дата Получения</label>
            <input type="date" class="form-control" name="date_recieved" required="required" value="<?=$waybill->date_recieved;?>">
        </div>
        <input type="hidden" name="user_id" value="<?=$id;?>" />
        <div class="form-group">
            <button type="submit" name="saveWaybill" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>