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
    $partMap = new PartMap();
    $count = $partMap->count();
    $parts = $partMap->findAll($page*$size-$size, $size);
    $header = 'Список Деталей';
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
                <a class="btn btn-success" href="add-part.php">Добавить деталь</a>
            </div>
            <div class="box-body">
                <?php
                    if ($parts) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Название Детали</th>
                            <th>Модель Станка</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($parts as $part) {
                                echo '<tr>';
                                echo '<td><a href="view-part.php?id='.$part->part_id.'">'.$part->name.'</a> ' . '<a href="add-part.php?id='.$part->part_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$part->model.'</td>';
                                echo '<td><a href="delete-part.php?id='.$part->part_id.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'Не найдено ни одной детали';
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