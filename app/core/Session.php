<?php


class Session
{
    static $name = 'WorkstationFittersAssembler';

    /**
     *
     */
    static function open()
    {
        $isSession = session_id();
        if (empty ($isSession))
        {
            session_start();
        }
    }

    /**
     *
     */
    static function close()
    {

    }

    /**
     * @param $key
     * @return bool - возвращает значение переменной или FALSE в случае ошибки
     */
    static function getVelue($key)
    {
        try
        {
            if (isset($_SESSION[$key]))
            {
                return $_SESSION[$key];
            }
            else
            {
                return null;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }


    /**
     * @param $key
     * @param $val
     * @return bool
     */
    static function setValue($key, $val)
    {
        try
        {
            $_SESSION[$key] = $val;
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    static function setValueK2($key1, $key2, $val)
    {
        try
        {
            $_SESSION[$key1][$key2] = $val;
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    static function setValueK3($key1, $key2, $key3, $val)
    {
        try
        {
            $_SESSION[$key1][$key2][$key3] = $val;
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }


    /**
     * @return mixed
     */
    static function getSession()
    {
        return $_SESSION;
    }



    static function cleaner()
    {
        session_unset();
    }
}