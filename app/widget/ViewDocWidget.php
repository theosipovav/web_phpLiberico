<?php

/**
 * Class ViewDocWidget
 * Виджет для просмотра документации
 * @param array - по умолчанию класс "extends Widget" принимает массив "vars" с переменными
 * ключи <vars>:
 * -- (int|string) id - обязательный, уникальный, идентификатор виджета и элемета "<object></object>"
 * -- (array) value - не обязательный, массив с инфомрацией по каждому документу
 */
class ViewDocWidget extends Widget
{
    public function run()
    {
        // extract($this->vars);
        $isHide = '1';
        if (isset($this->vars['hide']))
        {
            if ($this->vars['hide'] == '1')
            {
                $isHide = '1';
            }
            else
            {
                $isHide = '0';
            }
        }

        $htmlObjectId = $this->vars['id'];
        $docs = $this->vars['value'];
        // генерация коллекции option для <select></select>
        switch ($htmlObjectId)
        {
            case 'objectDocMain':
                $options = $this->generatorHtmlOptionForDoc($htmlObjectId, $docs);
                break;
            case 'objectDocAdditional':
                $options = $this->generatorHtmlOptionForDoc($htmlObjectId, $docs);
                break;
            case 'objectDocNtdM1':
                $options = $this->generatorHtmlOptionForDoc($htmlObjectId, $docs);
                break;
            case 'objectDocNtdM2':
                $options = $this->generatorHtmlOptionForDoc($htmlObjectId, $docs);
                break;
            default:
                $options = '';
                return;
        }

        $sPathFile = 'files/demo.pdf';
        if (count($docs)>0)
        {
            $doc = $docs[0];
            if (isset($doc['Dir']) && isset($doc['DirFolder']) && isset($doc['DirSubFolder']) && isset($doc['FileDd']) && isset($doc['File']))
            {
                $pathinfo = pathinfo($doc['File']);
                if (($pathinfo['extension'] == 'pdf') || ($pathinfo['extension'] == 'PDF'))
                {
                    $sPathFile = $this->getPathPdf($doc['Dir'], $doc['DirFolder'], $doc['DirSubFolder'], $doc['FileDd'], $doc['File']);
                    $sPathFile = '../app/lib/DymanicPdf?path='.$sPathFile;
                }
                else
                {
                    if (isset($doc['Id']))
                    {
                        $sPathFile = "../app/lib/DymanicPdf?id=".$doc['Id']."&user=".$_SERVER["PHP_AUTH_USER"];
                    }
                }

            }

        }


        return $this->render(
            'view-doc',
            array(
                'path' => $sPathFile,
                'options' => $options,
                'htmlObjectId' => $htmlObjectId,
                'isHide' => $isHide
            )
        );
    }

    /**
     * Формирование физического адреса места хранения PDF файла
     * @param $dir - фрагмент места хранения файла 1/4
     * @param $folder - фрагмент места хранения файла 2/4
     * @param $subfolder - фрагмент места хранения файла 3/4
     * @param $subsubfolder - фрагмент места хранения файла 4/4
     * @param $file - наименование файла
     * @return string - возвращает сформированный физический путь до места хранения PDF файла
     */
    protected function getPathPdf($dir, $folder, $subfolder, $subsubfolder, $file)
    {
        $dir = '/mnt/AsconFA';
        $folder = substr_replace('00000000', $folder, 8 - strlen($folder));
        $subfolder = substr_replace('00000000', $subfolder, 8 - strlen($subfolder));
        return $dir.'/'.$folder.'/'.$subfolder.'/'.$subsubfolder.'/'.$file;
    }

    /**
     * Генерирование HTML элемента "<option></option>"
     * Выпадающий список с найденной документацией
     * @param string $id - идентификатор элемета "<object></object>"
     * @param array $docs - массив с инфомрацией по каждому документу
     * @return string - возвращает сформированный элемент "<option></option>"
     */
    protected function generatorHtmlOptionForDoc($id, $docs)
    {
        // генерация коллекции option для <select></select>

        $options = '';
        if (count($docs))
        {
            foreach ($docs as $doc)
            {
                /* $doc
                 * array(), keys: [Id],[Type],[TypeId],[State],[StateId],[Name],[Ver],[TypeLink],[LinkTypeId],[File],[FileDd],[Dir],[DirFolder],[DirSubFolder]
                 */
                $option = '';
                $pathinfo = pathinfo($doc['File']);
                if (($pathinfo['extension'] == 'pdf') || (($pathinfo['extension'] == 'PDF')))
                {
                    $path = $this->getPathPdf($doc['Dir'], $doc['DirFolder'], $doc['DirSubFolder'], $doc['FileDd'], $doc['File']);
                    $param = '?path='.urlencode($path);
                }
                else
                {
                    $user = $_SERVER['PHP_AUTH_USER'];
                    $param = '?id='.urlencode($doc['Id']).'&user='.urlencode($user);
                }
                $option = "<option onclick=' viewDoc(\"$id\",\"$param\")'><span class='ion-chevron-right'></span>".$doc['Name'].' - '.$doc['Type']."</option>";
                $options .= $option;
            }
        }
        return $options;
    }
}