<?php

class Widget
{
    protected $vars = array();
    protected $view;

    /**
     * Widget constructor.
     * @param $vars $aParams
     */
    public function __construct($vars = array())
    {
        $this->vars = $vars;
        $this->run();
    }

    public function render($view, $vars = array())
    {
        // �������� ���������� $view �� ����������
        if (empty($view))
        {
            echo '<h1>���������� "'.$view.'" �� ���������� ��� �����</h1>';
            exit();
        }

        // �������� ����������
        if (count($vars) > 0)
        {
            extract($vars);
        }

        // ����������� ����� �������������
        $pathFileView = '../app/widget/views/'.$view.'.php';
        if (file_exists($pathFileView))
        {
            require $pathFileView;
        }
        else
        {
            echo '<div>';
            echo '<h3>������������� "'.$view.'" �� �������.</h3>';
            echo '<a href="'.$pathFileView.'">'.$pathFileView.'"</a>';
            echo '</div>';
        }
    }


    public function run()
    {
        extract($this->vars);
    }


}
