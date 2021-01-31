<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }

    if (isset($_POST['user_id'])) {
        $user = new User();
        $user->lastname = Helper::clearString($_POST['lastname']);
        $user->user_id= Helper::clearInt($_POST['user_id']);
        $user->firstname = Helper::clearString($_POST['firstname']);
        $user->patronymic = Helper::clearString($_POST['patronymic']);
        $user->birthday = Helper::clearString($_POST['birthday']);
        $user->username = Helper::clearString($_POST['username']);
        $user->password = password_hash(Helper::clearString($_POST['password']), PASSWORD_BCRYPT);
        $user->role_id = Helper::clearInt($_POST['role_id']);

        if (isset($_POST['saveWorker'])) {
            
            $worker = new Worker();
            $worker->user_id = $user->user_id;

            if ((new WorkerMap())->save($user, $worker)) {
                header('Location: profile-worker.php?id='.$worker->user_id);
            } else {
                if ($worker->user_id) {
                    header('Location: add-worker.php?id='.$worker->user_id);
                } else {
                    header('Location: add-worker.php');
                }
            }
            exit();
        }
    }
?>