<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $model = (new ModelMap())->findViewById($id);
        $modelMap = new ModelMap();
        $header = 'Просмотр Модели';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                            <li><a href="list-model.php">Модели</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-model.php?id=<?=$id;?>">Изменить</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Название Склада</th>
                                <td><?=$model->name;?></td>
                            </tr>
                            <tr>
                                <th>Компания</th>
                                <td><?=$model->type;?></td>
                            </tr>
                            <tr>
                                <th>Кол-во станков</th>
                                <td><?=$modelMap->findInstances($model->model_id)[0]->cnt;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    require_once 'template/footer.php';
?>