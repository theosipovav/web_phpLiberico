<?php


abstract class Controller
{
    public $route = array();            // Массив с текущем маршрутом (controller/action)
    public $value = array();            // Параметры текущего маршрута
    public $aVarsView = array();        // массив переменных для передачи их в представление
    public $isError;                    // Флаг текущей ошибки
    public $sError;                     // Текст активной ошибки

    protected $aSettingDb;

    public $View;                       // Класс отрисовки представления
    public $Log;                       // Класс для работы с логами


    /**
     * Controller - конструктор.
     * @param array $route
     * @param array $value
     * @param object $Logs
     */
    public function __construct($route, $value, $Logs)
    {
        $this->route = $route;
        $this->value = $value;
        $this->aSettingDb = require '../app/config/db.php';
        $this->View = new View($this->route);
        $this->isError = false;
        $this->sError = '';
        $this->Log = $Logs;
    }


    /**
     * Изменить контроллер
     * @param $newNameController
     */
    public function changeController($newNameController)
    {
        $this->route['controller'] = $newNameController;
    }
}