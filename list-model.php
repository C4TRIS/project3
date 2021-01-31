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
    $modelMap = new ModelMap();
    $count = $modelMap->count();
    $models = $modelMap->findAll($page*$size-$size, $size);
    $header = 'Модели Станков';
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
                <a class="btn btn-success" href="add-model.php">Добавить модель</a>
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
                    if ($models) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Название Модели</th>
                            <th>Тип Станка</th>
                            <th>Кол-во станков</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($models as $model) {
                                echo '<tr>';
                                echo '<td><a href="view-model.php?id='.$model->model_id.'">'.$model->name.'</a> ' . '<a href="view-model.php?id='.$model->model_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$model->type.'</td>';
                                echo '<td>'.$modelMap->findInstances($model->model_id)[0]->cnt.'</td>';
                                echo '<td><a href="delete-model.php?id='.$model->model_id.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'Ни одной модели не найдено';
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