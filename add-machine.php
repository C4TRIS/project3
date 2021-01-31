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
    $machine = (new MachineMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' станок';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-machine.php">Станки</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-machine.php" method="POST">
        <div class="form-group">
            <label>Модель</label>
            <select class="form-control" name="model_id">
                <?= Helper::printSelectOptions($machine->model_id, (new ModelMap())->arrModels());?>
            </select>
        </div>
        <div class="form-group">
            <label>Компания владелец</label>
            <select class="form-control" name="company_id">
                <?= Helper::printSelectOptions($machine->company_id, (new CompanyMap())->arrCompanies());?>
            </select>
        </div>
        <div class="form-group">
            <label>Работник</label>
            <select class="form-control" name="user_id">
                <?= Helper::printSelectOptions($machine->user_id, (new WorkerMap())->arrWorkers());?>
            </select>
        </div>
        <div class="form-group">
            <label>Время эксплуатации</label>
            <input type="number" class="form-control" name="lifetime" required="required" value="<?=$machine->lifetime;?>">
        </div>
        <div class="form-group">
            <label>Дата начала работы</label>
            <input type="date" class="form-control" name="date_started" required="required" value="<?=$machine->date_started;?>">
        </div>
        <div class="form-group">
            <label>Дата списания</label>
            <input type="date" class="form-control" name="date_writeoff" value="<?=$machine->date_writeoff;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveMachine" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="machine_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>