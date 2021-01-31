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
    $workerMap = new WorkerMap();
    $count = $workerMap->count();
    $workers = $workerMap->findAll($page*$size-$size, $size);
    $header = 'Рабочие';
    require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <section class="content-header">
                <h1>Рабочие</h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li class="active">Список работников</li>
                </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-worker.php">Добавить работника</a>
            </div>
            <?php if (Helper::hasFlash()) :?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Ошибка</h4>
                    <?= Helper::getFlash();?>
                </div>
            <?php endif;?>
            <!-- /.box-header -->
                <div class="box-body">
                <?php
                    if ($workers) {
                ?>

                <table id="example2" class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Ф.И.О.</th>
                            <th>Username</th>
                            <th>Дата Рождения</th>
                            <th>Роль</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($workers as $worker) {
                                echo '<tr>';
                                echo '<td><a href="profile-worker.php?id='.$worker->user_id.'">'.$worker->full_name.'</a> ' . '<a href="add-worker.php?id='.$worker->user_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$worker->username.'</td>';
                                echo '<td>'.$worker->birthday.'</td>';
                                echo '<td>'.$worker->roleName.'</td>';
                                echo '<td><a href="delete-user.php?id='.$worker->user_id.'&role='.$worker->role.'"><i class="fa fa-trash"></i> Удалить</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php 
                    } else {
                        echo 'Работники не найдены';
                    } 
                ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page, $size); ?>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
<?php
    require_once 'template/footer.php';
?>