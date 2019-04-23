<?php


abstract class Controller
{
    public $route = array();            // ������ � ������� ��������� (controller/action)
    public $value = array();            // ��������� �������� ��������
    public $aVarsView = array();        // ������ ���������� ��� �������� �� � �������������
    public $isError;                    // ���� ������� ������
    public $sError;                     // ����� �������� ������

    protected $aSettingDb;

    public $View;                       // ����� ��������� �������������
    public $Log;                       // ����� ��� ������ � ������


    /**
     * Controller - �����������.
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
     * �������� ����������
     * @param $newNameController
     */
    public function changeController($newNameController)
    {
        $this->route['controller'] = $newNameController;
    }
}