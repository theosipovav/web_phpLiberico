<?php

class Base
{

    /**
     * Base constructor.
     */
    public function __construct()
    {
    }



    public final function generetingLink()
    {

    }

    public static function viewErrorMsg($msg)
    {
        require_once '../app/views/layouts/error.php';
        exit();

    }
    public static function viewErrorTemplates($phpTemplate)
    {
        $msg = require '../app/views/error/'.$phpTemplate.'.php';
        require_once '../app/views/layouts/error.php';
        exit();
    }


    /**
     * Сгенерировать элемент <a></a>
     * @param $value - содержание элемента
     * @param $controller - наименование контроллера
     * @param $action - наименование представления
     * @param $params - массив параметорв
     * @param null $id - идентификатор ссылки
     * @param null $class - список классов для ссылки (через пробел)
     * @param null $style - код CSS
     * @param null $onclick - код JS при нажатие
     * @return string - возвращает сконструированную ссылку
     */
    public static function genLink($value, $controller, $action, $params, $id = null, $class = null, $style = null, $onclick = null)
    {
        $url = "?r=$controller/$action";
        if (count($params)>0)
        {
            $p = '';
            foreach ($params as $param)
            {
                $p .= '/'.$param;
            }
            $url .= $p;
        }
        return "<a href='$url' id='$id' class='$class' style='$style' onclick='$onclick'>$value</a>";
    }

    /**
     * Сгенерировать элемент <button></button>
     * @param $value - содержание элемента
     * @param null $id - идентификатор ссылки
     * @param null $class - список классов для ссылки (через пробел)
     * @param null $style - код CSS
     * @param null $onclick - код JS при нажатие
     * @return string - возвращает сконструированную ссылку
     */
    public static function genBtn($value, $id = null, $class = null, $style = null, $onclick = null)
    {
        $a = "<button id='$id' class='$class' style='$style' onclick='$onclick'>$value</button>";
        return $a;
    }

    /**
     * @param $value - содержание элемента
     * @param $controller - наименование контроллера
     * @param $action - наименование представления
     * @param $params - массив параметорв
     * @param null $id - идентификатор ссылки
     * @param null $class - список классов для ссылки (через пробел)
     * @param null $style - код CSS
     * @param null $onclick - код JS при нажатие
     * @return string - возвращает сконструированную ссылку
     */
    public static function genBtnLink($value, $controller, $action, $params, $id = null, $class = null, $style = null, $onclick = null)
    {
        $url = "?r=$controller/$action";
        if (count($params)>0)
        {
            $p = '';
            foreach ($params as $param)
            {
                $p .= '/'.$param;
            }
            $url .= $p;
        }
        $js = "window.location = '$url'";
        return "<button id='$id' class='$class' style='$style' onclick='$js'>$value</button>";
    }

    /**
     * 
     */
    public static function _isset()
    {
        $argc = func_get_args();
        foreach ($argc as $value)
        {
            if ($value == NULL)
            {
                return FALSE;
            }
            if ($value == null)
            {
                return FALSE;
            }
            if ($value == '')
            {
                return FALSE;
            }
        }
        return TRUE;

    }

}