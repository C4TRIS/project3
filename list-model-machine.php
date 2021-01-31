<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $header = 'Станки у предприятия';
    require_once 'template/header.php';
    if(isset($_GET['model_id'])) {
        $id = $_GET['model_id'];
        $machines = (new MachineMap())->findMachineById($id);
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
                        <label>Модель станка</label>
                        <select class="form-control" name="model_id">
                            <?= Helper::printSelectOptions($machine->model_id, (new ModelMap())->arrModels());?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="" class="btn btn-primary">Вперед</button>
                    </div>
                </form>
            </div>
        <?php if ($machines) : ?>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Модель станка</th>
                        <th>Номер станка</th>
                        <th>Компания</th>
                        <th>Дата начала работы</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($machines as $machine) : ?>
                    <tr>
                        <td><?=$machine->model;?></td>
                        <td><?=$machine->machine_id;?></td>
                        <td><?=$machine->company;?></td>
                        <td><?=$machine->date_started;?></td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="box-body">
            <p>Не найдено ни одного станка</p>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>