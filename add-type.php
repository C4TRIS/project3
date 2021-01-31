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
    $type = (new TypeMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' тип станка';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-type.php">Типы станков</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-type.php" method="POST">
        <div class="form-group">
            <label>Название типа</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$type->name;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveType" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="type_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>