<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $machine = (new MachineMap())->findViewById($id);
        if ($machine->date_writeoff == "0000-00-00") {
            $machine->date_writeoff = "Отсутсвует";
        }
        $header = 'Просмотр станка';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                            <li><a href="list-machine.php">Станки</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-machine.php?id=<?=$id;?>">Изменить</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Номер станка</th>
                                <td><?=$machine->machine_id;?></td>
                            </tr>
                            <tr>
                                <th>Модель станка</th>
                                <td><?=$machine->model;?></td>
                            </tr>
                            <tr>
                                <th>Тип станка</th>
                                <td><?=$machine->type;?></td>
                            </tr>
                            <tr>
                                <th>Ф.И.О. работника</th>
                                <td><?=$machine->full_name;?></td>
                            </tr>
                            <tr>
                                <th>Срок эксплуатации</th>
                                <td><?=$machine->lifetime;?> лет</td>
                            </tr>
                            <tr>
                                <th>Дата начала работы</th>
                                <td><?=$machine->date_started;?></td>
                            </tr>
                            <tr>
                                <th>Дата списания</th>
                                <td><?=$machine->date_writeoff;?></td>
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