<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new WorkerMap())->findById($id)->validate()) {
        $worker = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = 'Schedule of Worker: '.$worker->full_name;
    $daysSchedules = (new SchedulesMap())->findByWorkerId($id);
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                <li><a href="list-worker-schedule.php">Schedule</a></li>
                <li class="active"><?=$header;?></li>
            </ol>
            </section>
            <section class="box-body">
                <h3><?=$header;?></h3>
            </section>
            <div class="box-body">
                <?php if ($daysSchedules) : ?>
                <table class="table table-bordered table-hover">
                    <?php foreach ($daysSchedules as $day) : ?>
                        <tr>
                            <th colspan="6">
                                <h4 class="center-block">
                                    <?=$day['name'];?>
                                    <a href="add-schedule.php?idUser=<?=$id;?>&idDay=<?=$day['id'];?>"><i class="fa fa-plus"></i></a>
                                </h4>
                            </th>
                        </tr>

                    <?php if ($day['machine']) : ?>
                        <?php foreach ($day['machine'] as $machine) : ?>
                            <?php foreach
                                ($machine['schedule'] as $schedule ) : ?>
                                <tr>
                                    <td><b><?=$machine['name'];?></b></td>
                                    <td>Machine id (<?=$machine['id'];?>)</td>
                                    <td><?=$schedule['part'];?></td>
                                    <td><?=$machine['warehouse'];?></td>
                                    <td><?=$machine['company'];?></td>
                                    <td><a href="delete-schedule.php?id=<?=$schedule['schedules_id'];?>&idWorker=<?=$id;?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No schedule for this day</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach;?>
                </table>
                <?php else: ?>
                    <p>No schedule</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>