<div class="admin-nav-top">
    <div class="nav-panel">
        <ul class="menu">
            <li><a href="?r=admin/main">Главная</a></li>
            <li><a href="?r=admin/setting">Настройка сервиса</a></li>
            <li><a href="?r=admin/help" class="active">Справка</a></li>
        </ul>
        <div>
            <a href="#" class="btn btn-danger">Выход из ПУ</a>
        </div>
    </div>
</div>
<div class="admin-nav-right">
    <div class="nav-logo">
        <a href="#">Панель управления</a>
    </div>
    <ul>
        <li><a href="#" id="aBtnNav1" class="active" data->Сводная информация</a></li>
        <li><a href="#" id="aBtnNav2">_SERVER</a></li>
        <li><a href="#" id="aBtnNav3">_SESSION</a></li>
    </ul>
</div>
<div class="admin-content">
    <div id="divContentNav1" class="admin-content-nav active">
        <div class="container-fluid">
            <div class="row">
                <h1>Сводная информация</h1>
            </div>
        </div>
    </div>
    <div id="divContentNav2" class="admin-content-nav">
        <?php echo '<pre>'.print_r($_SERVER, true).'</pre>'?>
    </div>
    <div id="divContentNav3" class="admin-content-nav">
        <?php echo '<pre>'.print_r($_SESSION, true).'</pre>'?>
    </div>
</div>

