<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $size = 10;
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);
    } else {
        $page = 1;
    }
    $machineMap = new MachineMap();
    $count = $machineMap->count();
    $machines = $machineMap->findAll($page*$size-$size, $size);
    $header = 'Станки';
    require_once 'template/header.php';
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
                <a class="btn btn-success" href="add-machine.php">Добавить станок</a>
            </div>
            <?php if (Helper::hasFlash()) :?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Ошибка</h4>
                <?= Helper::getFlash();?>
            </div>
            <?php endif;?>
            <div class="box-body">
                <?php
                    if ($machines) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Модель</th>
                            <th>No</th>
                            <th>Тип</th>
                            <th>Компания</th>
                            <th>Ф.И.О. работника</th>
                            <th>Срок эксплуатации</th>
                            <th>Дата начала работы</th>
                            <th>Дата списания</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($machines as $machine) {
                                if ($machine->date_writeoff == "0000-00-00") {
                                    $machine->date_writeoff = "Отсутсвует";
                                }
                                echo '<tr>';
                                echo '<td><a href="view-machine.php?id='.$machine->machine_id.'">'.$machine->model.'</a> ' . '<a href="view-machine.php?id='.$machine->machine_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$machine->machine_id.'</td>';
                                echo '<td>'.$machine->type.'</td>';
                                echo '<td>'.$machine->company.'</td>';
                                echo '<td>'.$machine->full_name.'</td>';
                                echo '<td>'.$machine->lifetime.' лет</td>';
                                echo '<td>'.$machine->date_started.'</td>';
                                echo '<td>'.$machine->date_writeoff.'</td>';
                                echo '<td><a href="delete-machine.php?id='.$machine->machine_id.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'Станки не найдены';
                } ?>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page, $size); ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>