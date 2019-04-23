<?php
return array
(
    'admin' => array(
        'controller' => 'admin',
        'action' => 'main'
    ),
    '' => array(
        'controller' => 'main',
        'action' => 'index'
    ),
    'main' => array(
        'controller' => 'main',
        'action' => 'index'
    ),
    'main' => array(
        'controller' => 'main',
        'action' => 'info'
    )

);

/** Описание:
 * 
 * --Текущие маршруты
 * mysite.com/web/?r=admin
 * mysite.com/web/?r=admin/index
 * mysite.com/web/?r=main
 * mysite.com/web/?r=main/index
 * mysite.com/web/?r=main/info
 * mysite.com/web/
 * 
 * 
 * --Настройка
 * Описание всех возможных маршрутов
 * -- controller => main
 * -- action => index
 * ),
 * - название_страницы => array(
 * -- controller => название_котроллера
 * -- action => название_метода_по_умолчанию
 * ),
 * ...
 *
 * --Пример
 * Добавление нового URL: mysite.com/web/?r=info/index
 * return array
 * (
 *      'admin' => array
 *      (
 *          'controller' => 'admin',
 *          'action' => 'main'
 *      ),
 *      '' => array
 *      (
 *          'controller' => 'main',
 *          'action' => 'index'
 *      ),
 *      'main' => array
 *      (
 *          'controller' => 'main',
 *          'action' => 'index'
 *      ),
 *      'info' => array
 *      (
 *          'controller' => 'info',
 *          'action' => 'index'
 *      )
 * );