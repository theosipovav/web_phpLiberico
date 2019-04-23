<?php
//header('Content-Type: text/html; charset=KOI8-R');
require_once "../classes/ServiceAscon.php";
$aConfigDb = require_once "../config/db.php";

$aRes = array();


$aRes["status"] = "";
$aRes["data"] = "";

$sName = $_GET["name"];

$sNameCoding = mb_detect_encoding($sName);


if ($sNameCoding == "UTF-8")
{
    $sNameNew = iconv('UTF-8', 'KOI8-R', $sName);
    if (strlen($sNameNew) > 3)
    {
        $sName = $sNameNew;
    }
}
if (strlen($sName) <= 3)
{
    $aRes["status"] = "warning";
    $aRes["data"] = array();
    $aRes["data"]["objs"] = "";
    $aRes["data"]["res"] = "Введите более трех символа...";
}
else
{
    $serviceAscon = new ServiceAscon($aConfigDb["mssqlST3D"]);
    $aMainObj = $serviceAscon->getMainObj($sName);
    if ($serviceAscon->isError)
    {
        $aRes["status"] = "error";
        $aRes["data"] = $serviceAscon->sError;
    }
    else
    {
        $aRes["status"] = "success";
        $aRes["data"] = array();
        if (count($aMainObj) == 0)
        {
            $aRes["data"]["objs"] = "";
            $aRes["data"]["res"] = "Изделий не найдено.";
        }
        else
        {
            $aRes["data"]["objs"] = array();
            for ($n=0; $n<count($aMainObj); $n++)
            {
                array_push($aRes["data"]["objs"], $aMainObj[$n]['stKeyAttr']);
            }
            $aRes["data"]["res"] = "Найдено: " + count($aMainObj) + " изделий.";
        }
    }
}


if ($aRes["status"] == "success")
{
    if (count($aRes["data"]["objs"]) > 1)
    {
        $htmlRes = "";
        $htmlUl = '<ul id="ulListObjs">';
        for ($n=0; $n<count($aRes["data"]["objs"]); $n++)
        {
            $sName = $aRes["data"]["objs"][$n];
            $htmlUl .= '<li><a href="#" onclick="fInsertNameObj(\''.$sName.'\')" >'.$sName.'</a></li>';
        }
        $htmlUl .= '</ul>';
        $htmlFooter = '<div id="divListObjsResult" style="color: #007d00">Найдено: ' .count($aRes["data"]["objs"]).' изделий.</div>';

        $htmlRes = $htmlUl . $htmlFooter;
    }
    else
    {
        if ($aRes["status"] == "warning")
        {
            $htmlRes = '<ul id="ulListObjs"></ul><div id="divListObjsResult">По названию '.$sName.' объектов не найдено...</div>';
        }
        else
        {
            $htmlRes = '<ul id="ulListObjs"></ul><div id="divListObjsResult">Введите более трех символа...</div>';
        }
        $htmlRes = '<ul id="ulListObjs"></ul><div id="divListObjsResult">По названию '.$sName.' объектов не найдено...</div>';
    }

}
else
{
    $htmlRes = '<ul id="ulListObjs"></ul><div id="divListObjsResult" style="color: #7d0000">Ошибка при поиске...</div>';

}

print_r($htmlRes);