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
    $companyMap = new CompanyMap();
    $count = $companyMap->count();
    $companys = $companyMap->findAll($page*$size-$size, $size);
    $header = 'Компании';
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
                <a class="btn btn-success" href="add-company.php">Добавить компанию</a>
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
                    if ($companys) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Название</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($companys as $company) {
                                echo '<tr>';
                                echo '<td><a href="view-company.php?id='.$company->company_id.'">'.$company->name.'</a> ' . '<a href="add-company.php?id='.$company->company_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td><a href="delete-company.php?id='.$company->company_id.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'Не найдено ни одной компании';
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