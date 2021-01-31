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
    $model = (new ModelMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' модель';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-model.php">Модели</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-model.php" method="POST">
        <div class="form-group">
            <label>Название Модели</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$model->name;?>">
        </div>
        <div class="form-group">
            <label>Тип Станка</label>
            <select class="form-control" name="type_id">
                <?= Helper::printSelectOptions($model->type_id, (new TypeMap())->arrTypes());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="saveModel" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="model_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>