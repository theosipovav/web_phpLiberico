<?php
class AdminController extends Controller
{
    protected $aAccess = array();

    public function __construct(array $route, array $value, $Logs)
    {
        if (!$this->verificationAccess())
        {
            Base::viewErrorMsg('��� �������');
        }
        parent::__construct($route, $value, $Logs);
    }

    public function actionMain()
    {
        $this->View->layout = 'default-admin';

        //
        // ������� ����������
        // ��������� ���� ����������� ��������� �����
        $aRoutes = array();
        $array = require '../app/config/routes.php';
        foreach ($array as $key => $val){
            $item = array();
            array_push($item, $key);
            array_push($item, $val);
            array_push($aRoutes, $item);
        }
        $sRoutes = '';
        for ($n = 0; $n < count($aRoutes); $n++)
        {
            $sNamePage = $aRoutes[$n][0];
            $sController = ucfirst($aRoutes[$n][1]['controller']).'Controller';
            $sAction = 'action'.ucfirst($aRoutes[$n][1]['action']);
            if (isset($_SERVER['SCRIPT_URI']))
            {
                $sUrl = $_SERVER['SCRIPT_URI'].'?r='.$aRoutes[$n][1]['controller'].'<span style="color: rgb(0, 185, 22);">/'.$aRoutes[$n][1]['action'].'</span>';
            }
            else
            {
                $sUrl = $_SERVER['HTTP_HOST'].'/'.$_SERVER['PHP_SELF'].'/?r='.$aRoutes[$n][1]['controller'].'<span style="color: rgb(0, 185, 22);">/'.$aRoutes[$n][1]['action'].'</span>';
            }
            $sRoutes .= '<tr><th scope="row">'.$n.'</th><td>'.$sNamePage.'</td><td>'.$sController.'</td><td>'.$sAction.'</td><td style="font-style: italic;">'.$sUrl.'</td></tr>';
        }
        $this->aVarsView['sRoutes'] = $sRoutes;

        // ��������� ���� ������������ ��
        $aDb = array();
        $array = require '../app/config/db.php';
        foreach ($array as $key => $val){
            $item = array();
            array_push($item, $key);
            array_push($item, $val);
            array_push($aDb, $item);
        }
        $sDb = '';
        for ($n = 0; $n < count($aDb); $n++)
        {
            $sNameConnection = $aDb[$n][0];
            $sTypeDb = $aDb[$n][1]['type'];
            $sNameServer = $aDb[$n][1]['server'];
            $sNameDb = $aDb[$n][1]['database'];
            $sDb .= '<tr><th scope="row">'.$n.'</th><td>'.$sNameConnection.'</td><td>'.$sTypeDb.'</td><td>'.$sNameServer.'</td><td>'.$sNameDb.'</td></tr>';
        }
        $this->aVarsView['sDb'] = $sDb;

        //
        // ������ �������������

        //
        // ������ �����
        $array = $this->Log->readLogListUser();
        $this->aVarsView['userlist'] = $array['userlist'];
        $array['log'] = $this->Log->readLog();
        $this->aVarsView['log'] = $array['log'];
        // ��������� �������������
        return $this->View->render
        (
            'main',
            NULL,
            $this->aVarsView
        );
    }

    public function actionSetting()
    {
        $this->View->layout = 'default-admin';


        /******************************************************/
        /* ��������� ������� **********************************/
        $this->aVarsView['CardInfo'] = array();     // ������ � ������� ��� ����� � ����������� � ������� ������� �������
        $this->aVarsView['file'] = array();
        $this->aVarsView['mssql'] = array();

        $aParamLogs = include '../app/config/logs.php';

        switch ($aParamLogs['mode'])
        {
            case '1':
                $this->aVarsView['sMode'] = '1';
                // ���������� ������ �����
                $sDirFull = $_SERVER['SCRIPT_FILENAME'];
                $sDirFull = trim($sDirFull, '/');
                $sDirFull = rtrim($sDirFull   , '/');
                $aDirFull = explode('/', $sDirFull);
                $sDir = '/';
                foreach ($aDirFull as $item)
                {
                    if ($item == 'web') { break;}
                    $sDir .= $item.'/';
                }
                $sDir .= 'app/logs/';
                $this->aVarsView['file']['dir'] = $sDir;

                // ������������ ����� �������������
                $this->aVarsView['file']['name_mode'] = $aParamLogs['file']['name_mode'];

                // ������ ����� ��� ������ �����
                $this->aVarsView['file']['format'] = $aParamLogs['file']['format'];

                // ����� � ����������� � ������� ������� �������
                $this->aVarsView['CardInfo']['add_css'] = 'bg-success';
                $this->aVarsView['CardInfo']['header'] = '������ ����� ��������!';
                $this->aVarsView['CardInfo']['text'] = '������ � �������� ��������� �������.';

                break;
            case '2':
                $this->aVarsView['sMode'] = '2';

                // ����� � ����������� � ������� ������� �������
                $this->aVarsView['CardInfo']['add_css'] = 'bg-success';
                $this->aVarsView['CardInfo']['header'] = '������ ����� ��������!';
                $this->aVarsView['CardInfo']['text'] = '������ � ���� ������ MSSQL.';
                break;
            case '3':
                $this->aVarsView['sMode'] = '3';

                // ����� � ����������� � ������� ������� �������
                $this->aVarsView['CardInfo']['add_css'] = 'bg-success';
                $this->aVarsView['CardInfo']['header'] = '������ ����� ��������!';
                $this->aVarsView['CardInfo']['text'] = '������ � ���� ������ PostgreSQL.';

                break;
            default:
                $this->aVarsView['sMode'] = '';

                // ����� � ����������� � ������� ������� �������
                $this->aVarsView['CardInfo']['add_css'] = 'bg-warning';
                $this->aVarsView['CardInfo']['header'] = '��������!';
                $this->aVarsView['CardInfo']['text'] = '������ ����� ���������.';

                break;
        }


        // ��������� �������������
        return $this->View->render
        (
            'setting',
            null,
            $this->aVarsView
        );
    }

    public function actionHelp()
    {
        $this->View->layout = 'default-admin';


        // ��������� �������������
        return $this->View->render
        (
            'help',
            NULL,
            $this->aVarsView
        );
    }


    /** �������� ������� �������� ������������ � ������ ����������
     * @return bool - ���������� TRUE, ���� ������ ��������, � FALSE � �������� ������.
     */
    private function verificationAccess()
    {
        $this->aAccess = include '../app/config/access.php';
        $sIP = $_SERVER['REMOTE_ADDR'];
        if (in_array($sIP, $this->aAccess['ip']))
        {
            return true;
        }
        return false;
    }
}