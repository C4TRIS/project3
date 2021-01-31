<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $warehouse = (new WarehouseMap())->findViewById($id);
        $header = 'Просмотр Склада';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                            <li><a href="list-warehouse.php">Склады</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-warehouse.php?id=<?=$id;?>">Изменить</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Название Склада</th>
                                <td><?=$warehouse->name;?></td>
                            </tr>
                            <tr>
                                <th>Компания</th>
                                <td><?=$warehouse->company;?></td>
                            </tr>
                            <tr>
                                <th>Адрес</th>
                                <td><?=$warehouse->address;?></td>
                            </tr>
                            <tr>
                                <th>Площадь</th>
                                <td><?=$warehouse->square;?> кв. метров</td>
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