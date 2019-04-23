<?php
/* Исполняемый файл для AJAX запроса
 * Создание базы данных и необходимых таблиц
 *
 * Список параметров POST:
 * string Dsn - наименование источника базы данных (DSN) для соединения
 * string DataBase - наименование базы
 * string UserName - имя(логин) пользователя
 * string Password - пароль пользователя
 *
 * Возвращаемые значения:
 * array $result - массив с результирующие значениями
 * int $result['status'] - статус выполнения запроса 0/1
 * string $result['msg'] - сообщение
 */

$result = array();
$result['status'] = 0;
$result['msg'] = '';

$sDsn = filter_input(INPUT_POST, 'Dsn');
$sDataBase = filter_input(INPUT_POST, 'Database');
$sUserName = filter_input(INPUT_POST, 'UserName');
$sPassword = filter_input(INPUT_POST, 'Password');

if (($sDsn == '') || ($sDataBase == '') || ($sUserName == '') || ($sPassword == ''))
{
    $result['status'] = 0;
    $result['msg'] = 'Не найдены значение POST переменной';
    exit();
}

// Установка соединения с сервером MSSQL
@$odbcConnection = odbc_connect($sDsn, $sUserName, $sPassword);
if ($odbcConnection === false)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: '. odbc_errormsg();
        exit();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: Не удалось подключиться к базе данных АСКОН.';
        exit();
    }
}
$result['msg'] .= 'Соединение с сервером MSSQL прошло успешно.';

// Создание базы данных
$sQuery = "CREATE DATABASE $sDataBase";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "Ошибка: Не удалось создать базу данных '$sDataBase'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= "<hr/>База данных '$sDataBase' успешно создана.";

//
//
// Создание таблицы user_list
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.user_list
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    dateFirstConn date,
    dateLastConn date
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "Ошибка: Не удалось создать таблицу 'user_list'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= '<hr/>Таблица "WorkstationFittersAssembler.dbo.user_list" успешно создана.';

//
//
// Создание таблицы log_action
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.log_action
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    sUrl varchar(150),
    sMsg varchar(50),
    dateConn date,
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "Ошибка: Не удалось создать таблицу 'log_action'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= '<hr/>Таблица "WorkstationFittersAssembler.dbo.log_action" успешно создана.';

//
//
// Создание таблицы log_errors
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.log_errors
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    sMsg varchar(50),
    dateConn date,
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = 'Ошибка: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "Ошибка: Не удалось создать таблицу 'log_errors'";
    }
    odbc_free_result($odbcExec);
    exit();
}
echo '<h3>Таблица log_errors создана</h3>';
$result['msg'] .= '<hr/>Таблица "WorkstationFittersAssembler.dbo.log_errors" успешно создана.';

$result['status'] = 1;

echo json_encode($result);