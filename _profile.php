<?php
    $user = (new UserMap())->findProfileById($id);
    if ($user) {
?>
<tr>
    <th>Username</th>
    <td><?=$user->username;?></td>
</tr>
<tr>
    <th>Фамилия</th>
    <td><?=$user->lastname;?></td>
</tr>
<tr>
    <th>Имя</th>
    <td><?=$user->firstname;?></td>
</tr>
<tr>
    <th>Отчество</th>
    <td><?=$user->patronymic;?></td>
</tr>
<tr>
    <th>Дата Рождения</th>
    <td><?=$user->birthday;?></td>
</tr>
<tr>
    <th>Роль</th>
    <td><?=$user->role;?></td>
</tr>
<?php } ?>