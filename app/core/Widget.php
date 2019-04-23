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
        // Проверка переменной $view на содержимое
        if (empty($view))
        {
            echo '<h1>Переменная "'.$view.'" не определена или пуста</h1>';
            exit();
        }

        // Загрузка переменных
        if (count($vars) > 0)
        {
            extract($vars);
        }

        // Определение файла представления
        $pathFileView = '../app/widget/views/'.$view.'.php';
        if (file_exists($pathFileView))
        {
            require $pathFileView;
        }
        else
        {
            echo '<div>';
            echo '<h3>Представление "'.$view.'" не найдено.</h3>';
            echo '<a href="'.$pathFileView.'">'.$pathFileView.'"</a>';
            echo '</div>';
        }
    }


    public function run()
    {
        extract($this->vars);
    }


}
