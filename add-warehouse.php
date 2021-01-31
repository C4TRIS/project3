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
    $warehouse = (new WarehouseMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' склад';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-warehouse.php">Склады</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-warehouse.php" method="POST">
        <div class="form-group">
            <label>Название Склада</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$warehouse->name;?>">
        </div>
        <div class="form-group">
            <label>Компания</label>
            <select class="form-control" name="company_id">
                <?= Helper::printSelectOptions($warehouse->company_id, (new CompanyMap())->arrCompanies());?>
            </select>
        </div>
        <div class="form-group">
            <label>Адрес Склада</label>
            <input type="text" class="form-control" name="address" required="required" value="<?=$warehouse->address;?>">
        </div>
        <div class="form-group">
            <label>Площадь Склада</label>
            <input type="number" class="form-control" name="square" required="required" value="<?=$warehouse->square;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveWarehouse" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="warehouse_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>