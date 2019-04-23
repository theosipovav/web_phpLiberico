<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str, $isExit = false)
{
    echo '<pre>'.var_dump($str).'</pre>';
    if ($isExit)
    {
        exit();
    }
}

// function debug_view_array($array, $isExit = false)
/*
function debug_view_array($array, $isExit = false)
{
    echo '<div style="position: fixed; bottom: 0px; background: #C6FFC6; left: 0px; max-height: 500px; width: 100%; overflow: auto;">';
    echo '<div style="text-align: center; border-bottom: 1px solid rgb(135, 135, 135); background: rgb(21, 131, 0) none repeat scroll 0% 0%; color: rgb(255, 255, 255); cursor: pointer;" onclick="debugFunction()">Debug</div>';
    echo '<div id="debug_view_array" style="padding: 5px">';
    echo "<pre>".print_r($array,true)."</pre>";
    echo '</div>';
    echo '</div>';
    if ($isExit)
    {
        exit();
    }
    echo '<script>
    function debugFunction() { if (document.getElementById("debug_view_array").style.display == "block") document.getElementById("debug_view_array").style.display = "none"; else document.getElementById("debug_view_array").style.display = "block";}</script>';
}
*/

// function debug_view_vars($var, $isExit = false)
/*
function debug_view_vars($var, $isExit = false)
{
    echo '<div style="position: fixed; bottom: 0px; background: #C6FFC6; left: 0px; max-height: 500px; width: 100%; overflow: auto;">';
    echo '<div style="text-align: center; border-bottom: 1px solid rgb(135, 135, 135); background: rgb(21, 131, 0) none repeat scroll 0% 0%; color: rgb(255, 255, 255); cursor: pointer;" onclick="debugFunction()">Debug</div>';
    echo '<div id="debug_view_array" style="padding: 5px">';
    echo "<pre>".print_r($var,true)."</pre>";
    echo '</div>';
    echo '</div>';
    if ($isExit)
    {
        exit();
    }
    echo '<script>
    function debugFunction() { if (document.getElementById("debug_view_array").style.display == "block") document.getElementById("debug_view_array").style.display = "none"; else document.getElementById("debug_view_array").style.display = "block";}</script>';
}
*/

function debug_view_panel($aDebugInfo)
{
    require '../app/views/layouts/default-debug.php';
}

function debug_view_value($value, $isExit = false){
    require '../app/views/debug/view-value.php';
    if ($isExit) { exit(); }
}
function alert_msg($msg)
{
    echo '<script>alert("'.$msg.'")</script>';
}

function error_msg($msg)
{
    require '../app/views/error/error-msg.php';

}
