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
     * Отрисовка представления
     * @param string $view - файл представления, которые необходимо прорисовать
     * @param array $vars - массив переменных для импорта их в текущую таблицу символов
     * @param array $aVarsView - массив переменных для стандратного обращения к ним (через массив)
     */
    public function render($view = '', $vars = NULL, $aVarsView = NULL)
    {
        // Определение файла представления
        if ($view != '')
        {
            $this->view = $this->route['controller'].'/'.$view;
        }
        // Загрузка переменных
        if (($vars != NULL) && ($vars != ''))
        {
            extract($vars);
        }
        // Загрузка файла представления и файла шаблона
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
                echo '<h1>Шаблон "'.$pathFileLoyout.'" не найден.</h1>';
            }
        }
        else
        {
            echo '<h1>Представление "'.$pathFileView.'" не найдено.</h1>';
        }
    }

    public function render2($controller, $view = 'index', $vars = array())
    {
        // Проверка наименования контроллера
        if (empty($controller)){
            echo '<h1>Не задано имя котроллера</h1>';
            return ;
        }
        // Определение файла представления
        if ($view != 'index')
        {
            $this->view = $this->route['controller'].'/'.$view;
        }
        // Загрузка переменных
        extract($vars);
        // Загрузка файла представления и файла шаблона
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
                echo '<h1>Шаблон "'.$pathFileLoyout.'" не найден.</h1>';
            }
        }
        else
        {
            echo '<h1>Представление "'.$pathFileView.'" не найдено.</h1>';
        }
    }

}