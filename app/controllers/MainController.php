<?php
class MainController extends Controller
{
    private $bangeDocMain = null;
    private $bangeDocAdditional = null;
    private $bangeDocNtdM1 = null;
    private $bangeDocNtdM2 = null;

    /** Обработка маршрута main/index/...
     * 
     */
    public function actionIndex()
    {
        return $this->View->render
        (
            'index',
            NULL,
            $this->aVarsView
        );
    }

    /** Обработка маршрута main/info/...
     * 
     */
    public function actionInfo()
    {
        return $this->View->render
        (
            'info',
            array
            (
                'bangeDocMain'=>$this->bangeDocMain,
                'bangeDocAdditional'=>$this->bangeDocAdditional,
                'bangeDocNtdM1'=>$this->bangeDocNtdM1
            ),
            $this->aVarsView
        );
    }
}