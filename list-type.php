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
    $typeMap = new TypeMap();
    $count = $typeMap->count();
    $types = $typeMap->findAll($page*$size-$size, $size);
    $header = 'Типы станков';
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
                <a class="btn btn-success" href="add-type.php">Добавить тип станка</a>
            </div>
            <?php if (Helper::hasFlash()) :?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Ошибка</h4>
                    <?= Helper::getFlash();?>
                </div>
            <?php endif;?>
            <div class="box-body">
                <?php
                    if ($types) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Название типа</th>
                            <th>Кол-во станков</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($types as $type) {

                                echo '<tr>';
                                echo '<td><a href="view-type.php?id='.$type->type_id.'">'.$type->name.'</a> ' . '<a href="add-type.php?id='.$type->type_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$typeMap->findInstances($type->type_id)[0]->cnt.'</td>';
                                echo '<td><a href="delete-type.php?id='.$type->type_id.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'Ни одного типа станка не найдено';
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