<?php
/**
 * Created by PhpStorm.
 * User: osipovav
 * Date: 13.02.2019
 * Time: 14:51
 */

class RequestsDatabase
{

    /**
     * @param $user - имя пользователя
     * @param $ip - IP адрес
     * @param $url - UEL адрес страницы
     * @param $text - дополнительный текст
     * @param $date - текущая дата
     * @return string
     */
    static function insert_jlog($user, $ip, $url, $text = null, $date = null)
    {
        if ($text == null) { $text = " "; }
        if ($date == null) { $date = date("Y-m-d H:i:s"); }
        $str = "USE WFA ";
        $str .= "INSERT INTO WFA.dbo.jLog(php_auth_user,remote_addr,url,text,date) ";
        $str .= "VALUES ('$user','$ip','$url','$text','$date')";
        return $str;
    }


    static function select_jlog()
    {
        return "USE WFA SELECT TOP 100 * FROM [jLog] ORDER BY date DESC";
    }
}