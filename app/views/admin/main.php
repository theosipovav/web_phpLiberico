<div class="admin-nav-top">
    <div class="nav-panel">
        <ul class="menu">
            <li><a href="?r=admin/main" class="active">Главная</a></li>
            <li><a href="?r=admin/setting">Настройка сервиса</a></li>
            <li><a href="?r=admin/help">Справка</a></li>
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
        <li><a href="#aBtnNav1" id="aBtnNav1" class="menu-item-a active">Сводная информация</a></li>
        <li><a href="#aBtnNav2" class="menu-item-a">Журнал</a></li>
        <ul>
            <li><a href="#aBtnNav2_1" id="aBtnNav2_1" class="menu-item-a">Журнал пользователей</a></li>
            <li><a href="#aBtnNav2_2" id="aBtnNav2_2" class="menu-item-a">Журнал логов</a></li>
            <li><a href="#aBtnNav2_3" id="aBtnNav2_3" class="menu-item-a">...</a></li>
            <li><a href="#aBtnNav2_4" id="aBtnNav2_4" class="menu-item-a">...</a></li>
        </ul>
    </ul>
</div>
<div class="admin-content">
    <!-- ------------------------------ -->
    <!-- Сводная информаци ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav1" class="admin-content-nav show">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Сводная информация</h1>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                    <h3 class="h3">Действующие адреса сайта</h3>
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование страницы</th>
                            <th scope="col">Контроллер</th>
                            <th scope="col">Метод по умолчанию</th>
                            <th scope="col">URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $aVarsView['sRoutes'];?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                    <h3 class="h3">Подключенные базы данных</h3>
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование подключения</th>
                            <th scope="col">Тип БД</th>
                            <th scope="col">Сервер</th>
                            <th scope="col">Наименование БД</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $aVarsView['sDb'];?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- Журнал ----------------------- -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav2" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Журнал</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="divContentNav2_1" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Журнал пользователей</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th><th scope="col">IP адрес</th><th scope="col">Имя пользователя</th><th scope="col">Дата первого посещения</th><th scope="col">Дата последнего посещения</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($n=0; $n<count($aVarsView['userlist']); $n++)
                        {
                            $sIp = $aVarsView['userlist'][$n]['ip'];
                            $sName = $aVarsView['userlist'][$n]['name'];
                            $sDateCreate = $aVarsView['userlist'][$n]['date_create'];
                            $sDateLost = $aVarsView['userlist'][$n]['date_lost'];
                            echo '<tr><th scope="row">'.$n.'</th><td>'.$sIp.'</td><td>'.$sName.'</td><td>'.$sDateCreate.'</td><td>'.$sDateLost.'</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="divContentNav2_2" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Журнал логов</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя пользователя</th>
                            <th scope="col">IP</th>
                            <th scope="col">URL</th>
                            <th scope="col">Дата последнего посещения</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($n=0; $n<count($aVarsView['log']); $n++)
                        {
                            echo '<tr>';
                            echo '<th scope="row">'.$n.'</th>';
                            echo '<td>'.$aVarsView['log'][$n]['php_auth_user'].'</td>';
                            echo '<td>'.$aVarsView['log'][$n]['remote_addr'].'</td>';
                            echo '<td><a href="'.$aVarsView['log'][$n]['url'].'" target="_blank" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="'.$aVarsView['log'][$n]['url'].'">Адрес перехода</a></td>';
                            echo '<td>'.$aVarsView['log'][$n]['date'].'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="divContentNav2_3" class="admin-content-nav">
        <div class="container-fluid">
        </div>
    </div>
    <div id="divContentNav2_4" class="admin-content-nav">
        <div class="container-fluid">
        </div>
    </div>
</div>

