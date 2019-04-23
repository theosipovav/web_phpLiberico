<?php

/**
 * Class Router
 * 
 */
class Router{

    protected $aRoutes = array();   // Коллекция всех доступных маршрутов
    protected $aParams = array();   // Параметры текущего маршрута
    protected $aValue = array();    // Значения для текущего маршрута

    protected $sController;         // Наименование действущего контролера
    protected $sAction;             // Наименование действующего метода
    protected $sUrl;                // Входящая URL строка, после параметра r

    protected $Log;                 // Класс для работы с логами


    function __construct()
    {
        $arr = require '../app/config/routes.php';
        foreach ($arr as $key => $val){
            $this->initRouters($key, $val);
        }
        $this->Log = new Log();
    }

    /**
     * ������������� �������� � ��� ����������
     * ������ � #this->aRoutes ��� ��������� ��������
     * @param string $sRoute - ��� ��������
     * @param array $aParams - ��������� ��������: ���������� � ��� action ����� �� ���������
     */
    public function initRouters($sRoute, $aParams){
        $this->aRoutes[$sRoute] = $aParams;
    }

    /**
     * �������� ������� ��������
     * ������ ��������� URL �� ���������, ����� action � ���� ����������
     */
    public function analysisRoute()
    {
        //$this->url = filter_input(INPUT_GET, "r", FILTER_NULL_ON_FAILURE);
        $this->sUrl = filter_input(INPUT_GET, "r");
        $sUrl = $this->sUrl;
        $sUrl = trim($sUrl, '/');
        $sUrl = rtrim($sUrl, '/');
        // �������� �������� � �����: {a}/{b]/{...}
        foreach ($this->aRoutes as $sRoute => $params)
        {
            // $sRoute - ��� �������� {a}
            // $params - ��������� ��������: ���������� � action �����
            $sRoute_forMatch = str_replace("/", '\/', $sRoute);
            $sRoute_forMatch = "/^$sRoute_forMatch*/i";
            if ($sRoute == '')
            {
                // ��� �������� �� ���������
                if ($sUrl == '')
                {
                    // ��� ����� �������� �� ��������� URL ������ ���� ������
                    $this->aParams = $params;
                    $this->aValue = $this->initValueRouter($sUrl, $sRoute);
                    return true;
                }
            }else{
                // ���������������� �������
                if (preg_match($sRoute_forMatch, $sUrl,$matches))
                {
                    $aUrl = explode('/', $sUrl);
                    // ����������� ����� �����������
                    $this->sController = $aUrl[0];
                    $this->aParams['controller'] = $aUrl[0];
                    // ����������� ����� action ������
                    if (empty($aUrl[1]))
                    {
                        $this->sAction = $params['action'];
                        $this->aParams['action'] = $params['action'];
                        $this->aValue = array();
                    }
                    else
                    {
                        $this->sAction = $aUrl[1];
                        $this->aParams['action'] = $aUrl[1];
                        // ����������� ����������
                        for ($n=2; $n<count($aUrl); $n++)
                        {
                            array_push($this->aValue, $aUrl[$n]);
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * ������������� �������� ��� �������� ��������
     * @param string $sUrl
     * @param string $sRoute
     * @return array
     */
    public function initValueRouter($sUrl, $sRoute){
        $sValues = str_replace($sRoute, '', $sUrl);
        $sValues = trim($sValues,'/');
        return explode('/', $sValues);
    }



    public function run(){
        if ($this->Log->isActivate == true)
        {
            $this->Log->writeLogs();
        }
        if ($this->analysisRoute())
        {
            $pathFileController = 'app/controllers/' . ucfirst($this->aParams['controller']) . 'Controller.php';
            $pathFileAction = 'app/views/'.$this->aParams['controller'].'/'.$this->aParams['action'] . '.php';
            $sNameClassController = ucfirst($this->aParams['controller']).'Controller';
            $sNameMethodController = 'action'.ucfirst($this->aParams['action']);
            if (class_exists($sNameClassController))
            {
                if (method_exists($sNameClassController, $sNameMethodController))
                {
                    $Controller = new $sNameClassController($this->aParams, $this->aValue, $this->Log);
                    $Controller->$sNameMethodController();
                }else
                    {
                    $str = '�� ����� ������ ������� �����: ' . $this->sUrl;
                    $str .= '<br>������������ �����: <span style="font-style: italic; border-bottom: 1px solid rgb(0, 0, 0);">'.$this->sAction.'</span>';
                    Base::viewErrorMsg($str);
                }
            }else
                {
                $str = '�� ����� ������ ������� �����: ' . $this->sUrl;
                $str .= '<br>������������ �����: <span style="font-style: italic; border-bottom: 1px solid rgb(0, 0, 0);">'.$this->sController.'</span>';
                Base::viewErrorMsg($str);
            }
        }else
            {
            $str = '�� ����� ������ ������� �����: ' . $this->sUrl;
            Base::viewErrorMsg($str);
        }
    }



    public function getDebugInfo()
    {
        $res = array();
        array_push($res, $this->aRoutes);
        array_push($res, $this->aParams);
        array_push($res, $this->aValue);
        return $res;
    }
}