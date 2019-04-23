<?php

/* Исполняемый файл для AJAX запроса
 * Редактирование файла конфигурации для логов
 *
 * Список параметров POST:
 * string pathFile - полный путь до файла
 * string Content - содержимое файла
 *
 * Возвращаемые значения:
 * array $result - массив с результирующие значениями
 * int $result['status'] - статус выполнения запроса 0/1
 * string $result['msg'] - сообщение
 */

$result = array();
$result['status'] = 0;
$result['msg'] = '';

$sMode = filter_input(INPUT_POST, 'Mode');

$sMode = '2';                                               // ________________debug

switch ($sMode)
{
    case '1':
        break;
    case '2':
        $sDataBase = filter_input(INPUT_POST, 'Database');
        $sUserName = filter_input(INPUT_POST, 'UserName');
        $sPassword = filter_input(INPUT_POST, 'Password');

        $sDataBase = 'WorkstationFittersAssembler';         // ________________debug
        $sUserName = 'sa';                                  // ________________debug
        $sPassword = 'huj8Ieko';                            // ________________debug


        $jsonIn = file_get_contents('../config/logs.json', true);

        $aConfigLogs = json_decode($jsonIn, true);

        $aConfigLogs['mode'] = '2';
        $aConfigLogs['mssql']['dsn'] = $sDsn;
        $aConfigLogs['mssql']['database'] = $sDataBase;
        $aConfigLogs['mssql']['username'] = $sUserName;
        $aConfigLogs['mssql']['password'] = $sPassword;

        $jsonOut = json_encode($aConfigLogs);

        $fileLogs = fopen('../config/logs.json', 'w');
        fwrite($fileLogs, $jsonOut);
        fclose($fileLogs);

        $result['status'] = 0;
        $result['msg'] = "Выполнено.";

        break;
    case '3':
        $result['status'] = 0;
        $result['msg'] = "Ошибка: неизвестный режим записи логов.";
        break;
    default:
        $result['status'] = 0;
        $result['msg'] = "Ошибка: неизвестный режим записи логов.";
        break;
}



