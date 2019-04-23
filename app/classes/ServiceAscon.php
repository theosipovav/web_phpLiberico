<?php

class ServiceAscon
{

    /**
     * @var bool|resource - Соеденение с БД
     */
    protected $conn;

    /**
     * @var string - Состояния для объектов системы АСКОН
     */
    protected $states;


    /**
     * @var string - Тест ошибк
     */
    public $sError;

    /**
     * @var bool - Флаш ошибки
     */
    public $isError;

    /**
     * ServiceAscon constructor.
     * @param array $aSetting - массив с параметрами для соединения
     */
    public function __construct($aSetting)
    {
        $this->conn = $this->connect($aSetting);
        $this->states = "(2,16,20)";
        if ($this->conn === false)
        {
            $this->sError = 'Ошибка при попытки произвести соеденение с БД АСКОН<br>ServiceAscon::__construct($aSetting)';
            $this->isError = true;
        }
        else
        {
            $this->isError = false;
        }
    }

    /**
     * Подключение к БД
     * @param array $aSetting - массив с параметрами для соединения
     * @return resource|bool - Возвращает соединение ODBC или FALSE в случае ошибки
     */
    public function connect($aSetting)
    {
        try
        {
            $dns = $aSetting["dns"];
            $user = $aSetting["username"];
            $password = $aSetting["password"];
            @$conn = odbc_connect($dns, $user, $password);
            if ($conn === false)
            {
                if (odbc_error())
                {
                    $this->isError = true;
                    $this->sError = odbc_errormsg();
                    return false;
                }
                else
                {
                    $this->isError = true;
                    $this->sError = "<p>Не удалось подключиться к базе данных АСКОН</p><p>Текущие параметры подключения: $dns, $user, $password</p>";
                    return false;
                }
            }
            else
            {
                return $conn;
            }

        }
        catch (Exception $e)
        {
            $this->isError = true;
            $this->sError = $e->getMessage();
            return false;
        }
    }


    /**
     * Получение инфомрации об изделии по его имени
     * @param $name
     * @return array|bool
     */
    public function getProjectsByName($name)
    {
        $aProjects = $this->getProjectAll();
        if ($aProjects === false)
        {
            $this->isError = true;
            return false;
        }
        $array = array();
        /* Получаем массив из найденных Id объектов */
        for ($n=0; $n<count($aProjects); $n++){
            if ($aProjects[$n]["stMain_stKeyAttr"] === $name){
                array_push($array, $aProjects[$n]);
            }
        }
        return $array;
    }


    /**
     * Получение всех действующих проектов
     * @return array|bool - Возвращает массив с проектами или FALSE в случае ошибки
     */
    public function getProjectAll()
    {
        $sQuery = "
        USE ST3D5
        SELECT
        stVersions.inId as 'stVersions_inId',
        dsTypes.stName as 'dsTypes_stName',
        dsTypes.inId as 'dsTypes_inId',
        dsStates.stName as 'dsStates_stName',
        dsStates.inId as 'dsStates_inId',
        stMain.stKeyAttr as 'stMain_stKeyAttr',
        stAttributes.stValue as 'stAttributes_stValue',
        stVersions.stNumber as 'stVersions_stNumber'
        FROM
        stMain, dsTypes, dsStates,
        stVersions
        LEFT OUTER JOIN stAttributes
          ON stAttributes.inIdVersion = stVersions.[inId] AND stAttributes.inIdTypeAttr = 4461
        WHERE
        stMain.inId = stVersions.inIdMain AND stMain.inIdType = dsTypes.inId
        AND stVersions.inIdState = dsStates.inId AND dsStates.inId in ".$this->states."
        AND stMain.inIdType in (48,49,50,55,56,57,58,59,61,62,65,68)
        ORDER BY dsTypes.stName
        ";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg($this->conn);
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getProjectsByName()';
            }
            odbc_free_result($result);
            return false;
        }
        $array = array();
        while ($aProject = odbc_fetch_array($result))
        {
            array_push($array, $aProject);
        }
        return $array;
    }


    /**
     * Возвращает список связанных объектов
     * @param int $id - идентификатор объекта верхнего уровня
     * @param null $states - идентификатор состояний, которые необходимо отобразить
     * @param null $types - идентификатор типов, которые необходимо отобразить
     * @return array|bool - возвращает массив найденный объектов или FALSE в случае ошибки
     */
    public function getChildObjs($id, $states = NULL, $types = NULL)
    {
        if ($states == NULL)
        {
            $states = 'SELECT inId FROM dsStates';
        }
        if ($types == NULL)
        {
            $types = 'SELECT inId FROM dsTypes';
        }
        $sQuery = "
        USE ST3D5
        SELECT
        v.inId as 'Id',
        t.stName as 'Type',
        t.inId as 'TypeId',
        s.stName as 'State',
        s.inId as 'StateId',
        m.stKeyAttr as 'Name',
        v.stNumber as 'Ver',
        lt.stName as 'TypeLink',
        lt.inId as 'LinkTypeId',
        fso.stName as 'File',
        fd.inIdFSO as 'FileDd',
        fas.stNetDir as 'Dir',
        am.inFolder as 'DirFolder',
        am.inSubFolder as 'DirSubFolder'
        FROM
        stLinks l,
        stMain m,
        dsTypes t,
        dsStates s,
        rlTypesAndTypes tt,
        dsLinkTypes lt,
        stVersions v LEFT OUTER JOIN stFileDescs fd 
        ON v.inId = fd.inIdDocument LEFT OUTER JOIN stFSOs fso
        ON fso.inIdFSO = fd.inIdFSO LEFT OUTER JOIN stFolderDescs fold
        ON fold.inIdFSO = fso.inIdParent LEFT OUTER JOIN stFileOnArchive fa
        ON fa.inIdFile = fd.inIdFSO LEFT OUTER JOIN dsArchMap am
        ON am.inId = fa.inIdMap LEFT OUTER JOIN dsFileArchives fas
        ON fas.inId = am.inIdFileArchive
        WHERE
        l.inIdParent = $id
        AND l.inIdTypeRel = tt.inId
        AND tt.inIdLinkType = lt.inId
        AND v.inId = l.inIdChild
        AND v.inIdMain = m.inId
        AND m.inIdType = t.inId
        AND v.inIdState = s.inId
        AND s.inId in ($states)
        AND t.inId in ($types)
        ORDER BY fso.stName, t.stName, m.stKeyAttr";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg($this->conn);
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getChildObjs($id)';
            }
            odbc_free_result($result);
            return false;
        }
        $array = array();
        while ($row = odbc_fetch_array($result))
        {
            array_push($array, $row);
        }
        odbc_free_result($result);
        return $array;
    }


    /**
     * Поиск идентификатора объекта по его наименованию
     * @param string $name - наименованию объекта
     * @return string|null - возвращает идентификатора объекта или FALSE в случае ошибки
     */
    public function getIdObject($name)
    {
        $sQuery = "
        USE ST3D5
        SELECT
        v.inId as 'Id',
        m.stKeyAttr as 'Name'
        FROM
        stMain m,
        dsTypes t, 
        dsStates s,
        stVersions v LEFT OUTER JOIN stAttributes a ON 
        (
            a.inIdVersion = v.inId AND a.inIdTypeAttr = 4461
        )
        WHERE
        v.inIdMain = m.inId
        AND v.inIdState = s.inId 
        AND m.inIdType = t.inId 
        AND s.inId in (2,16,20) 
        AND t.inId in (2,60,61,62,63,64,66)";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg($this->conn);
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getChildObjs($id)';
            }
            odbc_free_result($result);
            return false;
        }
        $id = NULL;
        while ($row = odbc_fetch_array($result))
        {
            if ($row['Name'] == $name)
            {
                $id = $row['Id'];
                break;
            }
        }
        odbc_free_result($result);
        return $id;
    }


    public function getObjsByLink($id, $linkId, $stateId, $typeId)
    {
        $sQuery = "
        USE ST3D5
        SELECT
        l.inIdParent as 'Id',
        m2.stKeyAttr as 'Name',
        l.inId as 'LinkId',
        lt.stName as 'LinkName',
        lt.stInverseName as 'LinkNameInv',
        s.inId as 'StateId',
        s.stName as 'State',
        t.inId as 'TypeId',
        t.stName as 'Type'
        FROM 
        stVersions v,
        stMain m,
        stLinks l
            LEFT OUTER JOIN stVersions v2 ON l.inIdParent = v2.inId 
                LEFT OUTER JOIN stMain m2 ON v2.inIdMain = m2.inId,
        rlTypesAndTypes tt,
        dsLinkTypes lt,
        dsStates s,
        dsTypes t
        WHERE
        v.inId like '$id'
        AND v.inIdMain = m.inId
        AND v.inId = l.inIdChild
        AND l.inIdTypeRel = tt.inId
        AND tt.inIdLinkType = lt.inId
        AND v2.inIdState = s.inId
        AND m2.inIdType = t.inId
        AND lt.inId like '$linkId'
        AND t.inId in (61)
        AND s.inId in ($stateId)
        AND t.inId in ($typeId)";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg($this->conn);
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getProjectsByName()';
            }
            odbc_free_result($result);
            return false;
        }
        $array = array();



        while ($aProject = odbc_fetch_array($result))
        {

            array_push($array, $aProject);
        }
        return $array;
    }

    public function getDocNtd()
    {
        $sQuery = "
        USE ST3D5
        SELECT
        v.inId as 'Id',
        t.stName as 'Type',
        t.inId as 'TypeId',
        s.stName as 'State',
        s.inId as 'StateId',
        m.stKeyAttr as 'Name',
        v.stNumber as 'Ver',
        lt.stName as 'TypeLink',
        lt.inId as 'LinkTypeId',
        fso.stName as 'File',
        fd.inIdFSO as 'FileDd',
        fas.stNetDir as 'Dir',
        am.inFolder as 'DirFolder',
        am.inSubFolder as 'DirSubFolder'
        FROM
        stLinks l,
        stMain m,
        dsTypes t,
        dsStates s,
        rlTypesAndTypes tt,
        dsLinkTypes lt,
        stVersions v LEFT OUTER JOIN stFileDescs fd 
        ON v.inId = fd.inIdDocument LEFT OUTER JOIN stFSOs fso
        ON fso.inIdFSO = fd.inIdFSO LEFT OUTER JOIN stFolderDescs fold
        ON fold.inIdFSO = fso.inIdParent LEFT OUTER JOIN stFileOnArchive fa
        ON fa.inIdFile = fd.inIdFSO LEFT OUTER JOIN dsArchMap am
        ON am.inId = fa.inIdMap LEFT OUTER JOIN dsFileArchives fas
        ON fas.inId = am.inIdFileArchive
        WHERE
        l.inIdParent in (2985, 3310)
        AND l.inIdTypeRel = tt.inId
        AND tt.inIdLinkType = lt.inId
        AND v.inId = l.inIdChild
        AND v.inIdMain = m.inId
        AND m.inIdType = t.inId
        AND v.inIdState = s.inId
        AND s.inId in (2,16,20)
        ORDER BY fso.stName, t.stName, m.stKeyAttr";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg();
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getDocNtd()';
            }
            odbc_free_result($result);
            return false;
        }
        $array = array();
        while ($row = odbc_fetch_array($result))
        {
            array_push($array, $row);
        }
        odbc_free_result($result);
        return $array;
    }


    public function getMainObj($name)
    {
        $sQuery = "
        SELECT m.stKeyAttr FROM [dsTypes] t, [stMain] m
        WHERE t.[inId] = m.[inIdType] AND t.inId in (2,5,49,60,61,62,63,66,67,68,70) AND m.stKeyAttr like '%".$name."%'
        GROUP BY m.stKeyAttr
        ";
        $result = odbc_exec($this->conn, $sQuery);
        if (!$result)
        {
            $this->isError = true;
            if (odbc_error())
            {
                $this->sError = odbc_errormsg();
            }
            else
            {
                $this->sError = 'Ошибка в методе ServiceAscon::getDocNtd()';
            }
            odbc_free_result($result);
            return false;
        }
        $array = array();
        while ($row = odbc_fetch_array($result))
        {
            array_push($array, $row);
        }
        odbc_free_result($result);
        return $array;
    }

}