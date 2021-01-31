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
    $part = (new PartMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' деталь';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-part.php">Детали</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-part.php" method="POST">
        <div class="form-group">
            <label>Назвнаие Детали</label>
            <input type="part" class="form-control" name="name" required="required" value="<?=$part->name;?>">
        </div>
        <div class="form-group">
            <label>Модель Станка</label>
            <select class="form-control" name="model_id">
                <?= Helper::printSelectOptions($part->model_id, (new ModelMap())->arrModels());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="savePart" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="part_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>