<?php
    require_once 'autoload.php';
    session_start();
    $message = 'Войдите';
    if (isset($_SESSION['role'])) {
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $username = Helper::clearString($_POST['username']);
        $password = Helper::clearString($_POST['password']);
        $userMap = new UserMap();
        $user = $userMap->auth($username, $password);
        if ($user) {
            $_SESSION['id'] = $user->user_id;
            $_SESSION['role'] = $user->sys_name;
            $_SESSION['roleName'] = $user->name;
            $_SESSION['full_name'] = $user->full_name;
            header('Location: index.php');
            exit;
        } else {
            $message = '<span style="color:red;">Логин или пароль не верны</span>';
        }
    }
    require_once 'template/login.php';
?>