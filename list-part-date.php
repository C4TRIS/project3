<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $header = 'Накладные на месяц';
    require_once 'template/header.php';

    if(isset($_GET['warehouse_id']) && isset($_GET['date_req'])) {
        $date = $_GET['date_req'];
        $id = $_GET['warehouse_id'];
        $waybills = (new WaybillMap())->findWaybills($id, $date);
    }
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1><?=$header;?></h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li class="active"><?=$header;?></li>
                </ol>
            </section>
        <div class="box-body">
            <form action="list-model-machine.php" method="GET">
                <div class="form-group">
                    <label>Склад</label>
                    <select class="form-control" name="warehouse_id">
                        <?= Helper::printSelectOptions($machine->warehouse_id, (new WarehouseMap())->arrWarehouses());?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Дата</label>
                    <input type="month" class="form-control" name="date_req" required="required" value="<?=$waybill->date_req;?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="" class="btn btn-primary">Вперед</button>
                </div>
            </form>
        </div>
        <?php if ($waybills) : ?>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>День</th>
                        <th>Деталь</th>
                        <th>Склад</th>
                        <th>Дата получения</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($waybills as $waybill) : ?>
                    <tr>
                        <td><?=$waybill->day;?></td>
                        <td><?=$waybill->part;?></td>
                        <td><?=$waybill->warehouse;?></td>
                        <td><?=$waybill->date_recieved;?></td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="box-body">
            <p>Не найдено ни одной детали</p>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>