<?php
/* INFO autoload.php
 * Автоматическое подключение базовых классов, контроллеров и виджетов
 * 
 */

/** Подключение основных классов
 * 
 */
require_once '../app/core/Base.php';
require_once '../app/core/Function.php';
require_once '../app/core/Session.php';
require_once '../app/core/Controller.php';
require_once '../app/core/DataBase.php';
require_once '../app/core/View.php';
require_once '../app/core/Router.php';
require_once '../app/core/Widget.php';
require_once '../app/core/Log.php';

/** Автоматическая инициализация контроллеров
 * 
 */
$sNameSpaceClass = '../app/controllers/';
$aFiles = scandir($sNameSpaceClass);
foreach ($aFiles as $file){
    if ($file == "." || $file == "..") continue;
    $pathinfo = pathinfo($file);
    if (isset($pathinfo['extension']))
    {
        if ($pathinfo['extension'] == 'php')
        {
            require_once $sNameSpaceClass.$pathinfo['basename'];
        }
    }
}

/** Автоматическая инициализация виджетов
 * 
 */
$sNameSpaceClass = '../app/widget/';
$aFiles = scandir($sNameSpaceClass);
foreach ($aFiles as $file){
    if ($file == "." || $file == "..") continue;
    $pathinfo = pathinfo($file);
    if (isset($pathinfo['extension']))
    {
        if ($pathinfo['extension'] == 'php')
        {
            require_once $sNameSpaceClass.$pathinfo['basename'];
        }
    }
}

/** Автоматическая инициализация классов 
 * 
 */
$sNameSpaceClass = '../app/classes/';
$aFiles = scandir($sNameSpaceClass);
foreach ($aFiles as $file){
    if ($file == "." || $file == "..") continue;
    $pathinfo = pathinfo($file);
    if (isset($pathinfo['extension']))
    {
        if ($pathinfo['extension'] == 'php')
        {
            require_once $sNameSpaceClass.$pathinfo['basename'];
        }
    }
}