<?php
/* ����������� ���� ��� AJAX �������
 * �������� ���� ������ � ����������� ������
 *
 * ������ ���������� POST:
 * string Dsn - ������������ ��������� ���� ������ (DSN) ��� ����������
 * string DataBase - ������������ ����
 * string UserName - ���(�����) ������������
 * string Password - ������ ������������
 *
 * ������������ ��������:
 * array $result - ������ � �������������� ����������
 * int $result['status'] - ������ ���������� ������� 0/1
 * string $result['msg'] - ���������
 */

$result = array();
$result['status'] = 0;
$result['msg'] = '';

$sDsn = filter_input(INPUT_POST, 'Dsn');
$sDataBase = filter_input(INPUT_POST, 'Database');
$sUserName = filter_input(INPUT_POST, 'UserName');
$sPassword = filter_input(INPUT_POST, 'Password');

if (($sDsn == '') || ($sDataBase == '') || ($sUserName == '') || ($sPassword == ''))
{
    $result['status'] = 0;
    $result['msg'] = '�� ������� �������� POST ����������';
    exit();
}

// ��������� ���������� � �������� MSSQL
@$odbcConnection = odbc_connect($sDsn, $sUserName, $sPassword);
if ($odbcConnection === false)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = '������: '. odbc_errormsg();
        exit();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = '������: �� ������� ������������ � ���� ������ �����.';
        exit();
    }
}
$result['msg'] .= '���������� � �������� MSSQL ������ �������.';

// �������� ���� ������
$sQuery = "CREATE DATABASE $sDataBase";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = '������: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "������: �� ������� ������� ���� ������ '$sDataBase'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= "<hr/>���� ������ '$sDataBase' ������� �������.";

//
//
// �������� ������� user_list
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.user_list
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    dateFirstConn date,
    dateLastConn date
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = '������: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "������: �� ������� ������� ������� 'user_list'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= '<hr/>������� "WorkstationFittersAssembler.dbo.user_list" ������� �������.';

//
//
// �������� ������� log_action
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.log_action
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    sUrl varchar(150),
    sMsg varchar(50),
    dateConn date,
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = '������: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "������: �� ������� ������� ������� 'log_action'";
    }
    odbc_free_result($odbcExec);
    exit();
}
$result['msg'] .= '<hr/>������� "WorkstationFittersAssembler.dbo.log_action" ������� �������.';

//
//
// �������� ������� log_errors
$sQuery = "
CREATE TABLE WorkstationFittersAssembler.dbo.log_errors
(
    nId int PRIMARY KEY NOT NULL IDENTITY,
    sIp varchar(50),
    sUserName varchar(50),
    sMsg varchar(50),
    dateConn date,
)";
$odbcExec = odbc_exec($odbcConnection, $sQuery);
if (!$odbcExec)
{
    if (odbc_error())
    {
        $result['status'] = 0;
        $result['msg'] = '������: '. odbc_errormsg();
    }
    else
    {
        $result['status'] = 0;
        $result['msg'] = "������: �� ������� ������� ������� 'log_errors'";
    }
    odbc_free_result($odbcExec);
    exit();
}
echo '<h3>������� log_errors �������</h3>';
$result['msg'] .= '<hr/>������� "WorkstationFittersAssembler.dbo.log_errors" ������� �������.';

$result['status'] = 1;

echo json_encode($result);