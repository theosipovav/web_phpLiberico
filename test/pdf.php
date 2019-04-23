<?php

class GeneratorPdf
{
    protected $path, $id, $user;
    protected $db;

    public function __construct($vars)
    {
        $this->path = $vars['path'];
        $this->id = $vars['id'];
        $this->user = $vars['user'];

        $this->db = 'ST3D5';
    }


    /**
     * Генерация файла PDF по физическому адресу
     * @param $path
     * @return false|int
     */
    protected function genPdfOfPath($path)
    {
        $pathinfo = pathinfo($path);

        if (($pathinfo['extension'] == 'pdf') || ($pathinfo['extension'] == 'PDF'))
        {
            header('Content-type: application/pdf');
            return readfile("$path");
        }
        else
        {
            echo '<h1>Файл имеет неверный формат</h1><p>'.$pathinfo['filename'].'</p>';
        }
    }

    protected function genPdfOfServiceApp($id, $user, $db)
    {
        error_reporting(E_ALL);
        @$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false)
        {
            echo '<h1>Ошибка создания SOCKET</h1>';
            echo '<p>GeneratorPdf::genPdfOfServiceApp()</p>';
            echo '<p>socket_create(AF_INET, SOCK_STREAM, SOL_TCP)</p>';
            return;
        }
        //@$result = socket_connect($socket, '192.168.233.238', 11002);
        $result = socket_connect($socket, '192.168.33.188', 11002);
        if ($result === false)
        {
            echo '<h1>Ошибка SOCKET-соеденения</h1>';
            echo '<p>socket_connect($socket, "192.168.33.188", 11002)</p>';
            return;
        }
        $in = '<root><NameFunc>WebLoodsmanDoc-GetTechDoc</NameFunc><NameDB>'.$db.'</NameDB><NameUser>'.$user.'</NameUser><NameObject></NameObject><IdObject>'.$id.'</IdObject></root>';
        @$byte = serialize($in);
        socket_write($socket, $byte, strlen($byte));
        $out = socket_read($socket, 10240);
        $out1 = "";
        for ($n=16; $n<strlen($out); $n++)
        {
            $out1 = $out1 . $out[$n];
        }
        for ($n=0; $n< strlen($out1); $n++)
        {
            if ($out1[$n] === '\\')
            {
                $out1[$n] = '/';
            }
        }
        socket_close($socket);
        $_path_pdf = "/mnt/AsconLCO/" . $out1;
        header("Content-type: application/pdf");
        return $_path_pdf;
    }

    public function Run()
    {
        if (strlen($this->path)>0)
        {
            return $this->genPdfOfPath($this->path);
        }
        if ((strlen($this->id)>0) && (strlen($this->user)>0))
        {
            return $this->genPdfOfServiceApp($this->id, $this->user, $this->db);
        }
        echo '<h1>Ошибка чтение параметров</h1><p>GeneratorPdf::Run()</p>';
    }
}

$pdf = new GeneratorPdf(array("path"=>"","id"=>"id","user"=>"user"));

$pdf->Run();

