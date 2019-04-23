<?php

class View
{
    public $view;
    public $layout = 'default';
    public $route;

    /**
     * View constructor.
     * @param string $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $this->route['controller'].'/'.$this->route['action'];

    }


    /**
     * ��������� �������������
     * @param string $view - ���� �������������, ������� ���������� �����������
     * @param array $vars - ������ ���������� ��� ������� �� � ������� ������� ��������
     * @param array $aVarsView - ������ ���������� ��� ������������ ��������� � ��� (����� ������)
     */
    public function render($view = '', $vars = NULL, $aVarsView = NULL)
    {
        // ����������� ����� �������������
        if ($view != '')
        {
            $this->view = $this->route['controller'].'/'.$view;
        }
        // �������� ����������
        if (($vars != NULL) && ($vars != ''))
        {
            extract($vars);
        }
        // �������� ����� ������������� � ����� �������
        $pathFileView = '../app/views/'.$this->view.'.php';
        $pathFileLoyout = '../app/views/layouts/'.$this->layout.'.php';
        if (file_exists($pathFileView))
        {
            ob_start();
            require $pathFileView;
            $content = ob_get_contents();
            ob_end_clean();
            if (file_exists($pathFileLoyout))
            {
                require '../app/views/layouts/'.$this->layout.'.php';
            }
            else
            {
                echo '<h1>������ "'.$pathFileLoyout.'" �� ������.</h1>';
            }
        }
        else
        {
            echo '<h1>������������� "'.$pathFileView.'" �� �������.</h1>';
        }
    }

    public function render2($controller, $view = 'index', $vars = array())
    {
        // �������� ������������ �����������
        if (empty($controller)){
            echo '<h1>�� ������ ��� ����������</h1>';
            return ;
        }
        // ����������� ����� �������������
        if ($view != 'index')
        {
            $this->view = $this->route['controller'].'/'.$view;
        }
        // �������� ����������
        extract($vars);
        // �������� ����� ������������� � ����� �������
        $pathFileView = '../app/views/'.$this->view.'.php';
        $pathFileLoyout = '../app/views/layouts/'.$this->layout.'.php';
        if (file_exists($pathFileView))
        {
            ob_start();
            require $pathFileView;
            $content = ob_get_contents();
            ob_end_clean();
            if (file_exists($pathFileLoyout))
            {
                require '../app/views/layouts/'.$this->layout.'.php';
            }
            else
            {
                echo '<h1>������ "'.$pathFileLoyout.'" �� ������.</h1>';
            }
        }
        else
        {
            echo '<h1>������������� "'.$pathFileView.'" �� �������.</h1>';
        }
    }

}