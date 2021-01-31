<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $header = 'Работники';
    require_once 'template/header.php';
    $size = 5;
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);
    } else {
        $page = 1;
    }
    $count = (new WorkerMap())->count();
    $workers = (new WaybillMap())->findWorkers($page*$size-$size, $size);
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
        <?php if ($workers) : ?>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Ф.И.О.</th>
                        <th>Кол-во накладных</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($workers as $worker) : ?>
                    <tr>
                        <td><?=$worker->full_name;?></td>
                        <td><?=$worker->count_waybill;?></td>
                        <td>
                            <a href="list-waybill.php?id=<?=$worker->user_id;?>" title="Накладные работников"><i class="fa fa-table"></i></a>&nbsp;<br>
                        </td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <div class="box-body">
            <?php Helper::paginator($count, $page, $size); ?>
        </div>
        <?php else: ?>
        <div class="box-body">
            <p>Не найдено ни одного работника</p>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>