<?php



class MainMenuWidget extends Widget
{
    public function run()
    {
        // extract($this->vars);
        // Получение наименования найденного изделия и запись в тег <input id='#inputProductName' />
        if (($this->vars[0] != NULL) && (count($this->vars[0])>0))
        {
            $sProductName = $this->vars[0];
        }
        else
        {
            $sProductName = '';
        }

        // Генерация коллекции тегов <option /> для тега <select id="selectObjDown" />
        $optionsObjDown = '';
        if (($this->vars[1] != NULL) && (count($this->vars[1])>0))
        {
            $aObjDown = $this->vars[1];
            foreach ($aObjDown as $aObj)
            {
                $option = '<option>'.$aObj['Name'].'</option>';
                $optionsObjDown .= $option;
            }
        }
        // Генерация коллекции тегов <option /> для тега <select id="selectObjUp" />
        $optionsObjUp = '';
        if (($this->vars[2] != NULL) && (count($this->vars[2])>0))
        {
            $aObjUP = $this->vars[2];
            foreach ($aObjUP as $aObj)
            {
                $option = '<option>'.$aObj['Name'].'</option>';
                $optionsObjUp .= $option;
            }
        }
        // Генерация коллекции тегов <option /> для тега <select id="selectDocNTD" />
        $optionsDocNTD = '';
        if (($this->vars[3] != NULL) && (count($this->vars[3])>0))
        {
            $optionsDocNTD = $this->vars[3];
            foreach ($optionsDocNTD as $aObj)
            {
                $option = '<option>'.$aObj['Name'].'</option>';
                $optionsDocNTD .= $option;
            }
        }


        // Проверка режима
        $sModeSite = Session::getVelue("nMode");
        if (($sModeSite != "1") && ($sModeSite != "2"))
        {
            $sModeSite = "1";
        }
        return $this->render
        (
            'main-menu',
            array
            (
                'sProductName' => $sProductName,
                'optionsObjDown' => $optionsObjDown,
                'optionsObjUp' => $optionsObjUp,
                'optionsDocNTD' => $optionsDocNTD,
                'nMode' => $sModeSite
            )
        );
    }
}