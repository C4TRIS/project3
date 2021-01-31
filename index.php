<?php
    require_once 'secure.php';
    $header = 'Запросы';
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="box-body">
                <h1><?=$header;?></h1>
            </section>
        </div>
        <a href="list-date-part.php">
            <div class="box">
                <section class="box-body">
                    <h3>Количество деталей</h3>
                    <p>Количество деталей заданного наименования, отпускаемых с заданного склада за заданный месяц с разбивкой по дням.</p>
                </section>
            </div>
        </a>
        <a href="list-model-machine.php">
            <div class="box">
                <section class="box-body">
                    <h3>Список станков заданного наименования</h3>
                    <p>Список станков заданного наименования, находящихся на балансе предприятия на текущую дату – название организации, дата, номер станка, дата ввода его в эксплуатацию.</p>
                </section>
            </div>
        </a>
        <a href="list-warehouse.php">
            <div class="box">
                <section class="box-body">
                    <h3>Список складов</h3>
                    <p>Список складов – название организации, дата, номер склада, адрес</p>
                </section>
            </div>
        </a>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>