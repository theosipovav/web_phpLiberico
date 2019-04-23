<?php


abstract class Fn
{
    public static function viewErrorMsg($msg)
    {
        require_once '../app/views/error/fatal-error.php';
        exit();
    }

    public static function genLink($controller, $action, $params, $id = null, $class = null, $style = null)
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
        return "<a></a>";
    }



    public static function _isset(){
        $argc = func_get_args();
        debug_view_value($argc, true);

    }


}