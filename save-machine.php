<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['machine_id'])) {
        $machine = new Machine();
        $machine->machine_id = Helper::clearInt($_POST['machine_id']);
        $machine->model_id = Helper::clearInt($_POST['model_id']);
        $machine->date_started = Helper::clearString($_POST['date_started']);
        $machine->date_writeoff = Helper::clearString($_POST['date_writeoff']);
        $machine->lifetime = Helper::clearString($_POST['lifetime']);
        $machine->user_id = Helper::clearInt($_POST['user_id']);
        $machine->company_id = Helper::clearInt($_POST['company_id']);
        if ((new MachineMap())->save($machine)) {
            header('Location: view-machine.php?id='.$machine->machine_id);
        } else {
            if ($machine->machine_id) {
                header('Location: add-machine.php?id='.$machine->machine_id);
            } else {
                header('Location: add-machine.php');
            }
        }
    }
?>