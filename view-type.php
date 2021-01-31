<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $typeMap = new TypeMap();
        $type = $typeMap->findViewById($id);
        $header = 'Тип станка';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                            <li><a href="list-type.php">Типы станков</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-type.php?id=<?=$id;?>">Изменить</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Название Типа</th>
                                <td><?=$type->name;?></td>
                            </tr>
                            <tr>
                                <th>Кол-во станков</th>
                                <td><?=$typeMap->findInstances($type->type_id)[0]->cnt;?></td>
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