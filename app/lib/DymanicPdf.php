<?php
require_once '../classes/GeneratorPdf.php';

$var = array();

$var['path'] = $_GET["path"];
$var['id'] = $_GET["id"];
$var['user'] = $_GET["user"];

$GenPdf = new GeneratorPdf($var);
$GenPdf->Run();
