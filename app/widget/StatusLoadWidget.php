<?php
class StatusLoadWidget extends Widget
{
    private $sStatus = '';
    private $sMessage = '';
    private $sTimeout = '5000';
    private $sHtml = array();

    public function __construct($sStatus, $sMessage, $sTimeout = '5000')
    {
        $this->sStatus = $sStatus;
        $this->sMessage = $sMessage;
        $this->sTimeout = $sTimeout;
        parent::__construct();
    }

    public function run()
    {
        $this->sHtml['msg'] = $this->sMessage;
        $this->sHtml['time'] = $this->sTimeout;

        switch ($this->sStatus)
        {
            case 'Success':
                $this->sHtml['css'] = 'bg-success';
                $this->sHtml['title'] = '�������';
                break;
            case 'Warning':
                $this->sHtml['css'] = 'bg-warning';
                $this->sHtml['title'] = '��������!';
                break;
            case 'Error':
                $this->sHtml['css'] = 'bg-danger';
                $this->sHtml['title'] = '������!';
                break;
            default:
                $this->sHtml['css'] = 'bg-warning';
                $this->sHtml['title'] = '������!';
                $this->sMessage = '����������� ������� ��������� ��� ������� "StatusLoad"';
                break;
        }

        return $this->render
        (
            'status-load',
            array
            (
                'sClassCss' => $this->sHtml['css'],
                'sTextCatdHeader' => $this->sHtml['title'],
                'sText' => $this->sHtml['msg'],
                'sTime' => $this->sHtml['time']
            )
        );
    }
}