<?php
session_start();
$value = $_GET["value"];
$key = $_GET["key"];
$key1 = $_GET["key1"];
$key2 = $_GET["key2"];
$key3 = $_GET["key3"];
if (isset($key))
{
    $key1 = $key;
}

if (empty($key1))
{
    return 'error';
}

if (isset($key3))
{
    $_SESSION[$key1][$key2][$key3] = $value;
    return 'success';
}

if (isset($key2))
{
    $_SESSION[$key1][$key2] = $value;
    return 'success';
}

if (isset($key1))
{
    $_SESSION[$key1] = $value;
    return 'success';
}