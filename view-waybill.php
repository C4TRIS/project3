<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $waybill = (new WaybillMap())->findViewById($id);
        $header = 'Накладная';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                            <li><a href="list-waybill.php?id=<?=$waybill->user_id;?>">Накладные</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Номер накладной</th>
                                <td><?=$waybill->waybill_id;?></td>
                            </tr>
                            <tr>
                                <th>Склад</th>
                                <td><?=$waybill->warehouse;?></td>
                            </tr>
                            <tr>
                                <th>Ф.И.О.</th>
                                <td><?=$waybill->full_name;?></td>
                            </tr>
                            <tr>
                                <th>Деталь</th>
                                <td><?=$waybill->part;?></td>
                            </tr>
                            <tr>
                                <th>Дата Получения</th>
                                <td><?=$waybill->date_recieved;?></td>
                            </tr>
                            <tr>
                                <th>Цена</th>
                                <td><?=$waybill->price;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    require_once 'template/footer.php';
?>