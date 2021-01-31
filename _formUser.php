<?php
    $userMap = new UserMap();
    $user = $userMap->findById($id);
?>
<div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" required="required" value="<?=$user->username;?>">
</div>
<div class="form-group">
    <label>Пароль</label>
    <input type="password" class="form-control" name="password" required="required">
</div>
<div class="form-group">
    <label>Фамилия</label>
    <input type="text" class="form-control" name="lastname" required="required" value="<?=$user->lastname;?>">
</div>
<div class="form-group">
    <label>Имя</label>
    <input type="text" class="form-control" name="firstname" required="required" value="<?=$user->firstname;?>">
</div>
<div class="form-group">
    <label>Отчество</label>
    <input type="text" class="form-control" name="patronymic" required="required" value="<?=$user->patronymic;?>">
</div>
<div class="form-group">
    <label>Дата Рождения</label>
    <input type="date" class="form-control" name="birthday" required="required" value="<?=$user->birthday;?>">
</div>
<input type="hidden" name="user_id" value="<?=$id;?>"/>