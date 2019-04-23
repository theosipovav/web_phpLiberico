<?php


/**
 * Class Log
 */
class Log
{
    public $isError;
    public $sError;

    /**
     * @var bool - ���� ���������/����������� �����
     */
    public $isActivate;
    /**
     * @var array - ������ �������� ��� �������� ������ ������ �����
     */
    protected $aSetting = array();

    public function __construct()
    {
        $aSettingLogs = include '../app/config/logs.php';
        $this->sMode = $aSettingLogs['mode'];
        switch ($this->sMode)
        {
            case '1':
                $this->aSetting = $aSettingLogs['file'];
                $this->isActivate = true;
                break;
            case '2':
                $this->aSetting = $aSettingLogs['mssql'];
                $this->isActivate = true;
                break;
            case '3':
                $this->aSetting = $aSettingLogs[''];
                $this->isActivate = true;
                break;
            default:
                $this->aSetting = array();
                $this->isActivate = false;
                break;
        }
    }

    public function writeLogs($sMessage = null)
    {
        switch ($this->sMode)
        {
            case '1':
                $this->wtriteLogsFiles($sMessage);
                break;
            case '2':
                $this->wtriteLogsMssql($sMessage);
                break;
            case '3':
                $this->wtriteLogsPostgresql();
                break;
            default:
                break;
        }
    }

    private function wtriteLogsFiles($sMessage)
    {
        $sDir = $this->aSetting['dir'].'user/';          // ������ ���� �� ����������� � ������

        // ������ � ������� ������������� (userlist.xml)
        //
        $pathFileXml = $sDir.'userlist.xml';            // ������ ���� �� ����� ����
        $DOMDocument = new DOMDocument();               // �������� ������� ����� ����, � �������, ���� ���� ����������� �������� ���

        // �������� ������� ����� ����, � �������, ���� ���� ����������� �������� ���
        if (!file_exists($pathFileXml))
        {
            // ���� ���������� - �������� ������ ����� �� ����������
            $DOMDocument = new DOMDocument('1.0', 'KOI8-R');
            $DOMDocument->appendChild(new DOMElement('root'));
        }
        else
        {
            // ����������, �������� �� ���� ��� ������
            if (!is_writable($pathFileXml)) { chmod("$pathFileXml", '33215'); }
            $DOMDocument->load($pathFileXml);
        }

        $DOMNodeList = $DOMDocument->getElementsByTagName('root')->item(0)->getElementsByTagName('user');   // ��������� ����� <user/>
        $isFound = false;                                                                       // ����� ���������� ����
        foreach ($DOMNodeList as $DOMNode)
        {
            if ($DOMNode->getElementsByTagName('ip')->item(0)->nodeValue ==__IP__)
            {
                $DOMNode->getElementsByTagName('name')->item(0)->nodeValue = __USER__;
                $DOMNode->getElementsByTagName('date_lost')->item(0)->nodeValue = __DATE__;
                $isFound = true;
                break;
            }
        }
        if (!$isFound)
        {
            $DOMElement = new DOMElement('user');
            $DOMDocument->getElementsByTagName('root')->item(0)->appendChild($DOMElement);
            $DOMElement->appendChild(new DOMElement('ip', __IP__));
            $DOMElement->appendChild(new DOMElement('name', __USER__));
            $DOMElement->appendChild(new DOMElement('date_create', __DATE__));
            $DOMElement->appendChild(new DOMElement('date_lost', __DATE__));
        }
        $DOMDocument->save($pathFileXml);

        // ������ ����� �� �������� ������������
        // ������ � ������ __USER__.xml
        //
        $sFileName = __IP__;                            // ��������� ������������ �����
        $sFormat = 'xml';                               // ������ ����� ����
        $pathFileXml = $sDir.$sFileName.'.'.$sFormat;   // ������ ���� �� ����� ����
        $DOMDocument = new DOMDocument();               // ����� ��� ������ � XML ��������

        // �������� ������� ����� ����, � �������, ���� ���� ����������� �������� ���
        if (!file_exists($pathFileXml))
        {
            // ���� ���������� - �������� ������ ����� �� ����������
            $DOMDocument = new DOMDocument('1.0', 'KOI8-R');
            $DOMDocument->appendChild(new DOMElement('root'));
        }
        else
        {
            // ���� ���������� - ��������� ���
            if (!is_writable($pathFileXml))
            {
                // ���� ���� ������� �� ������ - �������������� ����� �� ����
                chmod("$pathFileXml", '33215');
            }
            $DOMDocument->load($pathFileXml);
        }
        $DOMElement_Root = $DOMDocument->getElementsByTagName('root')->item(0);     // ������������� � ���� <root/>
        $DOMElement = new DOMElement('data');                                          // �������� ���� <data/>
        $DOMElement_Root->appendChild($DOMElement);                                        // ���������� ���� <data/> � ���� <root/>
        $DOMElement->appendChild(new DOMElement('user', __USER__));            // �������� ���� <user/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('ip', __IP__));                // �������� ���� <ip/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('msg', $sMessage));                    // �������� ���� <msg/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('url', __URL__));              // �������� ���� <url/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('date', __DATE__));            // �������� ���� <date/> � ������ � ���� ������
        $DOMDocument->save($pathFileXml);



        // ������ � ������� ����������� ������������� (useraction.xml)
        //
        $pathFileXml = $sDir.'useraction.xml';          // ������ ���� �� ����� ����
        $DOMDocument = new DOMDocument();               // �������� ������� ����� ����, � �������, ���� ���� ����������� �������� ���

        // �������� ������� ����� ����, � �������, ���� ���� ����������� �������� ���
        if (!file_exists($pathFileXml))
        {
            // ���� ���������� - �������� ������ ����� �� ����������
            $DOMDocument = new DOMDocument('1.0', 'KOI8-R');
            $DOMDocument->appendChild(new DOMElement('root'));
        }
        else
        {
            // ����������, �������� �� ���� ��� ������
            if (!is_writable($pathFileXml)) { chmod("$pathFileXml", '33215'); }
            $DOMDocument->load($pathFileXml);
        }

        $DOMElement = new DOMElement('data');                                                   // �������� ���� <data/>
        $DOMDocument->getElementsByTagName('root')->item(0)->appendChild($DOMElement);    // ���������� ���� <data/> � ���� <root/>
        $DOMElement->appendChild(new DOMElement('user', __USER__));                     // �������� ���� <user/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('ip', __IP__));                         // �������� ���� <ip/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('msg', $sMessage));                             // �������� ���� <msg/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('url', __URL__));                       // �������� ���� <url/> � ������ � ���� ������
        $DOMElement->appendChild(new DOMElement('date', __DATE__));                     // �������� ���� <date/> � ������ � ���� ������
        $DOMDocument->save($pathFileXml);








    }
    /**
     * ������ ������ (����) � ���� ������ MSSQL
     * @param $text string|bool - ����� ��� ������ � ������ ����� ��� FALSE � ������ ������
     * @return bool - ���������� TRUE � ������ ������ ��� FALSE � ������ ������
     */
    private function wtriteLogsMssql($text)
    {
        $LogDb = new LogDb($this->aSetting);
        if ($LogDb->isError)
        {
            error_msg($LogDb->sError);
            return false;
        }
        $sRequest = RequestsDatabase::insert_jlog(__USER__, __IP__, __URL__, $text);
        $LogDb->RunRequest($sRequest);
        return true;
    }
    private function wtriteLogsPostgresql(){}



    public function readLogListUser()
    {
        $res = array();
        switch ($this->sMode)
        {
            case '1':
                $res = $this->readLogListUser_File();
                break;
            case '2':
                $res = $this->readLogListUser_Mssql();
                break;
            case '3':
                $res = $this->readLogListUser_Postgresql();
                break;
            default:
                $this->isError = true;
                $this->sError = '������ � ������� Log->readLogListUser()';
                $this->sError = '<br>����������� �������� ���������� Log->sMode';
                break;
        }
        if ($this->isError)
        {
            return false;
        }
        return $res;
    }
    private function readLogListUser_File()
    {
        // ���������� ������� ��� ������ � ���������
        $result = array();                      // �������������� ������

        $sDir = $this->aSetting['dir'].'user/';          // ����������� � ������

        $aUserList = array();                           // �������������� ������ ��� ������� �������������
        $pathFileXml = $sDir.'userlist.xml';            // ������ ���� �� ����������� � ������

        // �������� ����� �� �������������
        if (!file_exists($pathFileXml)) { return $result;}

        // �������� ������� ����� ����, � �������, ���� ���� �����������, �� �������� ���
        $DOMDocument = new DOMDocument();
        $DOMDocument->load($pathFileXml);
        $DOMNodeList = $DOMDocument->getElementsByTagName('root')->item(0)->getElementsByTagName('user');
        foreach ($DOMNodeList as $DOMNode)
        {
            $array = array();                                                                           // �������������� ������
            $array['ip'] = $DOMNode->getElementsByTagName('ip')->item(0)->nodeValue;                    // ������ <ip> ��� ��������������� �������
            $array['name'] = $DOMNode->getElementsByTagName('name')->item(0)->nodeValue;                // ������ <name> ��� ��������������� �������
            $array['date_create'] = $DOMNode->getElementsByTagName('date_create')->item(0)->nodeValue;  // ������ <date_create> ��� ��������������� �������
            $array['date_lost'] = $DOMNode->getElementsByTagName('date_lost')->item(0)->nodeValue;      // ������ <date_lost> ��� ��������������� �������
            array_push($aUserList, $array);
        }
        $result['userlist'] = $aUserList;




        $aUserAction = array();                           // �������������� ������ ��� ������� �������������
        $pathFileXml = $sDir.'useraction.xml';            // ������ ���� �� ����������� � ������

        // �������� ����� �� �������������
        if (!file_exists($pathFileXml)) { return $result;}

        // �������� ������� ����� ����, � �������, ���� ���� �����������, �� �������� ���
        $DOMDocument = new DOMDocument();
        $DOMDocument->load($pathFileXml);
        $DOMNodeList = $DOMDocument->getElementsByTagName('root')->item(0)->getElementsByTagName('data');
        foreach ($DOMNodeList as $DOMNode)
        {
            $array = array();                                                                           // �������������� ������
            $array['ip'] = $DOMNode->getElementsByTagName('ip')->item(0)->nodeValue;                    // ������ <ip> ��� ��������������� �������
            $array['user'] = $DOMNode->getElementsByTagName('user')->item(0)->nodeValue;                // ������ <name> ��� ��������������� �������
            $array['msg'] = $DOMNode->getElementsByTagName('msg')->item(0)->nodeValue;                  // ������ <msg> ��� ��������������� �������
            $array['url'] = $DOMNode->getElementsByTagName('url')->item(0)->nodeValue;                  // ������ <url> ��� ��������������� �������
            $array['date'] = $DOMNode->getElementsByTagName('date')->item(0)->nodeValue;                // ������ <date> ��� ��������������� �������
            array_push($aUserAction, $array);
        }
        $result['useraction'] = $aUserAction;



        return $result;
    }
    private function readLogListUser_Mssql()
    {

    }
    private function readLogListUser_Postgresql()
    {
    }


    public function readLog()
    {
        $res = array();
        switch ($this->sMode)
        {
            case '1':
                $res = $this->readLog_File();
                break;
            case '2':
                $res = $this->readLog_Mssql();
                break;
            case '3':
                $res = $this->readLog_Postgresql();
                break;
            default:
                $this->isError = true;
                $this->sError = '������ � ������� Log->readLog()';
                $this->sError = '<br>����������� �������� ���������� Log->sMode';
                break;
        }
        if ($this->isError)
        {
            return null;
        }
        return $res;
    }
    private function readLog_File()
    {
        return null;
    }
    private function readLog_Mssql()
    {
        $LogDb = new LogDb($this->aSetting);
        if ($LogDb->isError)
        {
            error_msg($LogDb->sError);
            return null;
        }
        $sRequest = RequestsDatabase::select_jlog();
        $resLogDb = $LogDb->RunRequest($sRequest);
        if ($resLogDb == null)
        {
            return null;
        }
        else
        {
            $array = array();
            while ($row = odbc_fetch_array($resLogDb))
            {
                array_push($array, $row);
            }
            @odbc_free_result($resLogDb);
            return $array;
        }

    }
    private function readLog_Postgresql()
    {
        return null;
    }



    public function readLogsUser($sUserName)
    {
        $res = array();
        switch ($this->sMode)
        {
            case '1':
                $sUserName .= '.xml';
                $res = $this->readLogsUser_File($sUserName);
                break;
            case '2':
                break;
            case '3':
                break;
            default:
                break;
        }
        return $res;
    }
    private function readLogsUser_File($sFileName)
    {
        $res = array();
        // ��������� ���������� �������� ������
        $sDirUser = $this->aSetting['dir'].'user/';
        // ��������� ������� ����� �����
        $pathFileXml = $sDirUser.$sFileName;

        $DOMDocument = new DOMDocument();
        $DOMDocument->load($pathFileXml);

        $DOMNodeList = $DOMDocument->getElementsByTagName('data');
        $array = array();
        foreach ($DOMNodeList as $DOMNode)
        {
            $DOMChildNodes = $DOMNode->childNodes;
            $aData = array();
            foreach ($DOMChildNodes as $DOMChildNode)
            {
                $aData[$DOMChildNode->nodeName] = $DOMChildNode->nodeValue;

            }
            array_push($array, $aData);
        }
        $res = $array;
        debug_view_value($array);
        return $res;
    }
    private function readLogsUser_Mssql(){}
    private function readLogsUser_Postgresql(){}






    private function readLogsFiles2()
    {
        $res = array();
        // ��������� ���������� �������� ������
        $sDirUser = $this->aSetting['dir'].'user/';
        $aDirUser = scandir($sDirUser);
        $array = array();
        $DOMDocument = new DOMDocument();



        for ($n=2; $n<count($aDirUser); $n++)
        {
            $pathFileXml = $sDirUser.$aDirUser[$n];
            $DOMDocument->load($pathFileXml);
            $DOMNodeList = $DOMDocument->getElementsByTagName('data');
            foreach ($DOMNodeList as $DOMNode)
            {
                $DOMChildNodes = $DOMNode->childNodes;
                foreach ($DOMChildNodes as $DOMChildNode)
                {
                    echo $DOMChildNode->nodeName.': '.$DOMChildNode->nodeValue.'<hr/>';
                }

                exit();
            }
        }

        exit();
        $sDirError = $this->aSetting['dir'].'error/';



        debug_view_value($array);
        return $res;
    }



    /** ������������� ���������� ������ �������� ����
     * @param string - �������������� ���������� � ���
     * @return array - ���������� ������ � ���������� ��� ������ ����� ������� � ������
     */
    private function generationLogContent($sMessage)
    {
        $res = array();
        $res['msg'] = '';
        $res['user'] = '';
        $res['ip'] = '';
        $res['url'] = '';
        $res['date'] = '';
        // ��������� ���������
        if ($sMessage != null)
        {
            $res['msg'] = $sMessage;
        }
        // ��������� ����� ������������
        if (isset($_SERVER['PHP_AUTH_USER']))
        {
            $res['user'] = $_SERVER['PHP_AUTH_USER'];
        }
        else
        {
            $res['user'] = 'unknown_user';
        }
        // ��������� IP ������ ��
        $res['ip'] = $_SERVER['REMOTE_ADDR'];
        // ��������� ������� �������� URL ������������
        if (isset($_SERVER['SCRIPT_URL']))
        {
            $res['url'] = $_SERVER['SCRIPT_URL'];
            if (isset($_SERVER['QUERY_STRING']))
            {
                if (strlen($_SERVER['QUERY_STRING']>0))
                {
                    $res['url'] .= '?'.$_SERVER['QUERY_STRING'];
                }
            }
        }
        else
        {
            if (isset($_SERVER['HTTP_HOST']))
            {
                $res['url'] = $_SERVER['HTTP_HOST'];
            }
            else
            {
                if (isset($_SERVER['SERVER_NAME']))
                {
                    $res['url'] = $_SERVER['SERVER_NAME'];
                }
            }
        }
        if (isset($_SERVER['PHP_SELF']))
        {
            $res['url'] .= '/'.$_SERVER['PHP_SELF'];
            if (isset($_SERVER['QUERY_STRING']))
            {
                $res['url'] .= $_SERVER['QUERY_STRING'];

            }

        }

        // ��������� ���� ���������
        $res['date'] = date('d.m.Y H:i:s');
        return $res;
    }








}



class LogDb
{
    /**
     * @var bool|resource - ���������� � ��
     */
    protected $conn;
    /**
     * @var string - ���� �����
     */
    public $sError;
    /**
     * @var bool - ���� ������
     */
    public $isError;

    /**
     * LogDb constructor.
     * @param array $aSetting - ������ � ����������� ��� ����������
     */
    public function __construct($aSetting)
    {
        $this->conn = $this->connect($aSetting);
        if ($this->conn === false)
        {
            $this->sError = '������ ��� ������� ���������� ���������� � �� �����<br>ServiceAscon::__construct($aSetting)';
            $this->isError = true;
        }
        else
        {
            $this->isError = false;
        }
    }

    /**
     * ����������� � ��
     * @param array $aSetting - ������ � ����������� ��� ����������
     * @return resource|bool - ���������� ���������� ODBC ��� FALSE � ������ ������
     */
    public function connect($aSetting)
    {
        try
        {
            $dns = $aSetting["dns"];
            $user = $aSetting["username"];
            $password = $aSetting["password"];
            @$conn = odbc_connect($dns, $user, $password);
            if ($conn === false)
            {
                if (odbc_error())
                {
                    $this->isError = true;
                    $this->sError = odbc_errormsg();
                    return false;
                }
                else
                {
                    $this->isError = true;
                    $this->sError = "<p>�� ������� ������������ � ���� ������ �����</p><p>������� ��������� �����������: $dns, $user, $password</p>";
                    return false;
                }
            }
            else
            {
                return $conn;
            }

        }
        catch (Exception $e)
        {
            $this->isError = true;
            $this->sError = $e->getMessage();
            return false;
        }
    }

    /**
     * @param $req string - ����������� SQL ������
     * @return NULL|resource - ���������� ��������� ������� ��� NULL � ������ ������
     */
    public function RunRequest($req)
    {
        if ($this->isError) { return null;}
        $odbcResult = odbc_exec($this->conn, $req);
        if ($odbcResult)
        {
            return $odbcResult;
        }
        else
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg($this->conn);
            }
            else
            {
                $this->sError = '������ � ������ LogDb->RunRequest()';
            }
            odbc_free_result($odbcResult);
            return null;
        }
    }
}