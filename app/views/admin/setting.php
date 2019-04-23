<div class="admin-nav-top">
    <div class="nav-panel">
        <ul class="menu">
            <li><a href="?r=admin/main">Главная</a></li>
            <li><a href="?r=admin/setting" class="active">Настройка сервиса</a></li>
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
        <li><a href="#aBtnNav2" id="aBtnNav2" class="menu-item-a">Настройка доступа</a></li>
        <li><a href="#aBtnNav3" id="aBtnNav3" class="menu-item-a">Настройка журнала</a></li>
        <li><a href="#aBtnNav3" id="aBtnNav4" class="menu-item-a">Правка файлов конфигурации</a></li>
    </ul>
</div>
<div class="admin-content">
    <!-- ------------------------------ -->
    <!-- Сводная информаци ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav1" class="admin-content-nav show">
        <div class="container-fluid">
            <div class="row">
                <h1>Сводная информация</h1>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- Настройка доступа ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav2" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <h1>Настройка доступа</h1>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- Настройка журнала ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav3" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Настройка журнала</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <h5 class="h5">Режим записи логов в журнал:</h5>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsFiles" value="option1" <?php if ($aVarsView['sMode'] == '1'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsFiles">Запись в файловую структуру сервиса</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsMSSQL" value="option2" <?php if ($aVarsView['sMode'] == '2'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsMSSQL">Запись в базу данных MSSQL</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsPSQL" value="option3" <?php if ($aVarsView['sMode'] == '3'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsPSQL">Запись в базу данных PostgreSQL</label>
                                </div>
                            </div>
                            <div class="col-md-6 align-self-start text-right">
                                <div style="display: inline-block; text-align: center;">
                                    <div class="card text-white <?php echo $aVarsView['CardInfo']['add_css'];?>">
                                        <div class="card-header"><?php echo $aVarsView['CardInfo']['header'];?></div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $aVarsView['CardInfo']['text'];?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div style="border: 1px solid rgb(238, 238, 238); border-radius: 5px; padding: 5px 15px;">
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '1'){ echo 'show';}; ?>" id="divLogsFiles">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>Установка записи логов в файловую структуру сервиса</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            Запись логов производится в структуру сайта, доступную только для администраторов.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form >
                                            <div class="form-group">
                                                <label for="inputLogin">Директория записи логов:</label>
                                                <input type="text" class="form-control" id="inputLogin" aria-describedby="smallDir" placeholder="Директория записи логов" value="<?php echo $aVarsView['file']['dir']; ?>" disabled>
                                                <small id="smallDir" class="form-text text-muted">Директория каталога для хранения файлов логов пользователей</small>
                                            </div>
                                            <div class="form-group">
                                                <p>Наименование папок пользователей:</p>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode1" value="1">
                                                    <label class="form-check-label" for="radiosNameMode1">IP-адрес, с которого пользователь просматривает текущую страницу</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode2" value="1">
                                                    <label class="form-check-label" for="radiosNameMode2">Имя пользователя (при выполнении HTTP-аутентификации)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode3" value="1">
                                                    <label class="form-check-label" for="radiosNameMode3">IP-адрес + имя пользователя</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputLogin">Формат файла для записи логов:</label>
                                                <input type="text" class="form-control" id="inputLogin" aria-describedby="smallDir" placeholder="Директория записи логов" value="<?php echo $aVarsView['file']['format']; ?>" disabled>
                                                <small id="smallDir" class="form-text text-muted">Формат и структура файла, в которой будет производится запись логов</small>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-danger btn-lg">Удалить настройки</button>
                                                <button type="submit" class="btn btn-primary btn-lg">Применить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '2'){ echo 'show';}; ?>" id="divLogsLogsMSSQL">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>Установка записи логов в базу данных MSSQL</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            Установка соединения с базой данных происходит при помощи инструмента ODBC.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <form id="formSettingMssql" name="formSettingMssql" method="post" action="">
                                                <input type="text" class="form-control" id="inputMode" name="Mode" value="2" hidden>
                                                <div class="form-group">
                                                    <label for="inputDsn">DSN:</label>
                                                    <input type="text" class="form-control" id="inputDsn" name="Dsn" aria-describedby="smallDsn" placeholder="Указажите имя DSN" value="AsconST3D">
                                                    <small id="smallDsn" class="form-text text-muted">Имя источника базы данных (DSN) для соединения. В качестве альтернативы можно выполнить соединение и без DSN.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDatabase">Наименование базы данных:</label>
                                                    <input type="text" class="form-control" id="inputDatabase" name="Database" aria-describedby="smallDb" placeholder="Указажите имя базы данных" value="WorkstationFittersAssembler">
                                                    <small id="smallDb" class="form-text text-muted">Имя базы данных для хранения записи логов.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputUserName">Имя пользователя:</label>
                                                    <input type="text" class="form-control" id="inputUserName" name="UserName" aria-describedby="smallUserName" placeholder="Введите имя пользователя" value="sa">
                                                    <small id="smallUserName" class="form-text text-muted">Данный пользователь должен обладать правами на создание новой базы данных</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword">Пароль пользователя:</label>
                                                    <input type="password" class="form-control" id="inputPassword" name="Password" placeholder="Введите пароль пользователя" value="huj8Ieko">
                                                </div>
                                                <div class="form-group text-right">
                                                    <button id="btnSettingMssqlDelete" type="button" class="btn btn-danger btn-lg">Удалить настройки</button>
                                                    <button id="btnSettingMssqlInstall" type="button" class="btn btn-primary btn-lg">Применить</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '3'){ echo 'show';}; ?>" id="divLogsPSQL">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>Установка в базу данных PostgreSQL</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-danger">
                                            В разработке...
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab-create-mssql" data-toggle="tab" href="#tab-content-create-mssql" role="tab" aria-controls="tab-content-create-mssql" aria-selected="true">Новое соединение</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tab-conn-mssql" data-toggle="tab" href="#tab-content-conn-mssql" role="tab" aria-controls="tab-content-conn-mssql" aria-selected="false">Существующие соединение</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content tab-content-border">
                                                    <div class="tab-pane fade show active" id="tab-content-create-mssql" role="tabpanel" aria-labelledby="tab-create-mssql">
                                                        ...
                                                    </div>
                                                    <div class="tab-pane fade" id="tab-content-conn-mssql" role="tabpanel" aria-labelledby="tab-conn-mssql">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Существующие соединения</label>
                                                                <select class="form-control" id="exampleFormControlSelect1">
                                                                    <?php
                                                                    $array = include '../app/config/db.php';
                                                                    foreach ($array as $item)
                                                                    {
                                                                        echo '<option>'.$item['name'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <button type="submit" class="btn btn-danger btn-lg">Удалить настройки</button>
                                                                <button type="submit" class="btn btn-primary btn-lg">Применить</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- Правка файлов конфигурации --- -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav4" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Правка файлов конфигурации</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

