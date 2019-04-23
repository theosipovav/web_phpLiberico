<?php

/**
 * Class ServiceKsu
 */
class ServiceKsu{

    protected $aSetting = array();
    protected $conn = false;

    public $sError = '';
    public $isError = false;

    /**
     * ServiceKsu constructor.
     * @param array $aSetting - массив с параметрами для соединения
     */
    public function __construct($aSetting)
    {
        $this->aSetting = $aSetting;
        $this->conn = $this->connection();
        if (!$this->conn)
        {
            $this->isError = true;
        }
    }

    /**
     * Подключение к БД через elah2.php => Connect()
     * @return bool - возвращает идентификатор соединения или FALSE в случае ошибки
     */
    private function connection()
    {
        try
        {
            $db = $this->aSetting['database'];
            $conn = Connect($db);
            if (!$conn){
                /* Ошибка при подключении */
                $this->sError = 'Ошибка при подключении<br>' . oci_error();
                return false;
            }
            else
            {
                return $conn;
            }
        }
        catch (Exception $e)
        {
            $this->sError = 'Исключение в методе Service->connection()<br>'. $e->getMessage();
            return false;
        }
    }


    /**
     * Получение ДСЕ по номеру сопроводительного паспопрта
     * @param $sPassport - номер сопроводительного паспорта изделия
     * @return array|bool - возвращает массив с данными об объекте ДСЕ или FALSE в случае ошибки
     */
    public function getDsePassport($sPassport){
        if($result = $this->getDsePassportPart1($sPassport)){
            /* Возвращает данные ДСЕ через схему mm082 */
            return $result;
        }
        if($result = $this->getDsePassportPart2($sPassport)){
            /* Возвращает данные ДСЕ через схему mm089 */
            return $result;
        }
        return array();
    }

    /**
     * Получение ДСЕ по номеру сопроводительного паспопрта, метод 1
     * @param $sPassport - номер сопроводительного паспорта изделия
     * @return array|bool возвращает массив с данными об объекте ДСЕ или FALSE в случае ошибки
     */
    private function getDsePassportPart1($sPassport){
        $result = false;
        $sQuery = "
            SELECT distinct d.cd70, d.p003, d.p006, trim(d.p008 || ' ' || d.c797 || ' ' || d.p457 || ' ' || d.p454) p008
            FROM mm082.mm081n01 a, mm082.mm081n03 b, mm082.ot281v01 c, mm082.ae360n01 d
            WHERE (a.x684 = b.x684) and (b.x822 = c.x822) and (c.p003 = d.p003) and (a.x684 = :x684)
        ";
        $aStatement = oci_parse($this->conn, $sQuery);
        oci_bind_by_name($aStatement, ':x684', $sPassport);
        if(@oci_execute($aStatement, OCI_DEFAULT)){
            if(oci_fetch($aStatement)){
                $result = array();
                $result['cd70'] = (int) oci_result($aStatement, 'CD70');
                $result['p003'] = (int) oci_result($aStatement, 'P003');
                $result['p006'] = (string) oci_result($aStatement, 'P006');
                $result['p008'] = (string) oci_result($aStatement, 'P008');
            }
        }
        @oci_free_statement($aStatement);
        return $result;
    }

    /**
     * Получение ДСЕ по номеру сопроводительного паспопрта, метод 2
     * @param $sPassport - номер сопроводительного паспорта изделия
     * @return array|bool возвращает массив с данными об объекте ДСЕ или FALSE в случае ошибки
     */
    private function getDsePassportPart2($sPassport){
        $result = false;
        $sQuery = "
            SELECT mm089.mm091_kod_obozn_dse(:x684, 1) cd70, mm089.mm091_kod_obozn_dse(:x684, 3) p003, 
            mm089.mm091_kod_obozn_dse(:x684, 2) p006, mm089.mm091_kod_obozn_dse(:x684, 4) p008
            FROM dual";
        $aStatement = oci_parse($this->conn, $sQuery);
        oci_bind_by_name($aStatement, ':x684', $sPassport);
        if(@oci_execute($aStatement, OCI_DEFAULT)){
            @oci_fetch($aStatement);
            $cd70 = (int) oci_result($aStatement, 'CD70');
            $p003 = (int) oci_result($aStatement, 'P003');
            $p006 = (string) oci_result($aStatement, 'P006');
            $p008 = (string) oci_result($aStatement, 'P008');
            if($p003 !== 0){
                $result = array();
                $result['cd70'] = $cd70;
                $result['p003'] = $p003;
                $result['p006'] = $p006;
                $result['p008'] = $p008;
            }
        }
        @oci_free_statement($aStatement);
        return $result;
    }




}