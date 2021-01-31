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
    $company = (new CompanyMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' компанию';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-company.php">Компании</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-company.php" method="POST">
        <div class="form-group">
            <label>Название Компании</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$company->name;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveCompany" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="company_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>