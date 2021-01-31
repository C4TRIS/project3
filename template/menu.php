<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">

      <li <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"': '';?>>
        <a href="index.php"><i class="fa fa-calendar"></i><span>Главная</span></a>
      </li>

      <li class="header">Запросы</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-date-part.php')?'class="active"': '';?>>
        <a href="list-date-part.php"><i class="fa fa-calendar"></i><span>Детали на дату</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-model-machine.php')?'class="active"': '';?>>
        <a href="list-model-machine.php"><i class="fa fa-calendar"></i><span>Поиск станков</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-warehouse.php')?'class="active"':'';?>>
        <a href="list-warehouse.php"><span>Склады</span></a>
      </li>

      <li class="header">Пользователи</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-worker.php')?'class="active"':'';?>>
        <a href="list-worker.php"><i class="fa fa-users"></i><span>Работники</span></a>
      </li>

      <li class="header">Справочники</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-part.php')?'class="active"':'';?>>
        <a href="list-part.php"><span>Детали</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-company.php')?'class="active"':'';?>>
        <a href="list-company.php"><span>Компании</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-type.php')?'class="active"':'';?>>
        <a href="list-type.php"><span>Типы Станков</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-model.php')?'class="active"':'';?>>
        <a href="list-model.php"><span>Модели Станков</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-worker-waybill.php')?'class="active"':'';?>>
        <a href="list-worker-waybill.php"><span>Накладные</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-machine.php')?'class="active"':'';?>>
        <a href="list-machine.php"><span>Станки</span></a>
      </li>
      
    </ul>
  </section>
</aside>