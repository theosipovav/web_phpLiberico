<div class="admin-nav-top">
    <div class="nav-panel">
        <ul class="menu">
            <li><a href="?r=admin/main">�������</a></li>
            <li><a href="?r=admin/setting" class="active">��������� �������</a></li>
            <li><a href="?r=admin/help">�������</a></li>
        </ul>
        <div>
            <a href="#" class="btn btn-danger">����� �� ��</a>
        </div>
    </div>
</div>
<div class="admin-nav-right">
    <div class="nav-logo">
        <a href="#">������ ����������</a>
    </div>
    <ul>
        <li><a href="#aBtnNav1" id="aBtnNav1" class="menu-item-a active">������� ����������</a></li>
        <li><a href="#aBtnNav2" id="aBtnNav2" class="menu-item-a">��������� �������</a></li>
        <li><a href="#aBtnNav3" id="aBtnNav3" class="menu-item-a">��������� �������</a></li>
        <li><a href="#aBtnNav3" id="aBtnNav4" class="menu-item-a">������ ������ ������������</a></li>
    </ul>
</div>
<div class="admin-content">
    <!-- ------------------------------ -->
    <!-- ������� ��������� ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav1" class="admin-content-nav show">
        <div class="container-fluid">
            <div class="row">
                <h1>������� ����������</h1>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- ��������� ������� ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav2" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <h1>��������� �������</h1>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- ��������� ������� ------------ -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav3" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>��������� �������</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <h5 class="h5">����� ������ ����� � ������:</h5>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsFiles" value="option1" <?php if ($aVarsView['sMode'] == '1'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsFiles">������ � �������� ��������� �������</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsMSSQL" value="option2" <?php if ($aVarsView['sMode'] == '2'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsMSSQL">������ � ���� ������ MSSQL</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radiosLogs" id="radiosLogsPSQL" value="option3" <?php if ($aVarsView['sMode'] == '3'){ echo 'checked';}; ?>>
                                    <label class="form-check-label" for="radiosLogsPSQL">������ � ���� ������ PostgreSQL</label>
                                </div>
                            </div>
                            <div class="col-md-6 align-self-start text-right">
                                <div style="display: inline-block; text-align: center;">
                                    <div class="card text-white <?php echo $aVarsView['CardInfo']['add_css'];?>">
                                        <div class="card-header"><?php echo $aVarsView['CardInfo']['header'];?></div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $aVarsView['CardInfo']['text'];?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div style="border: 1px solid rgb(238, 238, 238); border-radius: 5px; padding: 5px 15px;">
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '1'){ echo 'show';}; ?>" id="divLogsFiles">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>��������� ������ ����� � �������� ��������� �������</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            ������ ����� ������������ � ��������� �����, ��������� ������ ��� ���������������.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form >
                                            <div class="form-group">
                                                <label for="inputLogin">���������� ������ �����:</label>
                                                <input type="text" class="form-control" id="inputLogin" aria-describedby="smallDir" placeholder="���������� ������ �����" value="<?php echo $aVarsView['file']['dir']; ?>" disabled>
                                                <small id="smallDir" class="form-text text-muted">���������� �������� ��� �������� ������ ����� �������������</small>
                                            </div>
                                            <div class="form-group">
                                                <p>������������ ����� �������������:</p>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode1" value="1">
                                                    <label class="form-check-label" for="radiosNameMode1">IP-�����, � �������� ������������ ������������� ������� ��������</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode2" value="1">
                                                    <label class="form-check-label" for="radiosNameMode2">��� ������������ (��� ���������� HTTP-��������������)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="radiosNameMode" id="radiosNameMode3" value="1">
                                                    <label class="form-check-label" for="radiosNameMode3">IP-����� + ��� ������������</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputLogin">������ ����� ��� ������ �����:</label>
                                                <input type="text" class="form-control" id="inputLogin" aria-describedby="smallDir" placeholder="���������� ������ �����" value="<?php echo $aVarsView['file']['format']; ?>" disabled>
                                                <small id="smallDir" class="form-text text-muted">������ � ��������� �����, � ������� ����� ������������ ������ �����</small>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-danger btn-lg">������� ���������</button>
                                                <button type="submit" class="btn btn-primary btn-lg">���������</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '2'){ echo 'show';}; ?>" id="divLogsLogsMSSQL">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>��������� ������ ����� � ���� ������ MSSQL</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            ��������� ���������� � ����� ������ ���������� ��� ������ ����������� ODBC.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <form id="formSettingMssql" name="formSettingMssql" method="post" action="">
                                                <input type="text" class="form-control" id="inputMode" name="Mode" value="2" hidden>
                                                <div class="form-group">
                                                    <label for="inputDsn">DSN:</label>
                                                    <input type="text" class="form-control" id="inputDsn" name="Dsn" aria-describedby="smallDsn" placeholder="��������� ��� DSN" value="AsconST3D">
                                                    <small id="smallDsn" class="form-text text-muted">��� ��������� ���� ������ (DSN) ��� ����������. � �������� ������������ ����� ��������� ���������� � ��� DSN.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDatabase">������������ ���� ������:</label>
                                                    <input type="text" class="form-control" id="inputDatabase" name="Database" aria-describedby="smallDb" placeholder="��������� ��� ���� ������" value="WorkstationFittersAssembler">
                                                    <small id="smallDb" class="form-text text-muted">��� ���� ������ ��� �������� ������ �����.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputUserName">��� ������������:</label>
                                                    <input type="text" class="form-control" id="inputUserName" name="UserName" aria-describedby="smallUserName" placeholder="������� ��� ������������" value="sa">
                                                    <small id="smallUserName" class="form-text text-muted">������ ������������ ������ �������� ������� �� �������� ����� ���� ������</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword">������ ������������:</label>
                                                    <input type="password" class="form-control" id="inputPassword" name="Password" placeholder="������� ������ ������������" value="huj8Ieko">
                                                </div>
                                                <div class="form-group text-right">
                                                    <button id="btnSettingMssqlDelete" type="button" class="btn btn-danger btn-lg">������� ���������</button>
                                                    <button id="btnSettingMssqlInstall" type="button" class="btn btn-primary btn-lg">���������</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="log-content-nav <?php if ($aVarsView['sMode'] == '3'){ echo 'show';}; ?>" id="divLogsPSQL">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <h5>��������� � ���� ������ PostgreSQL</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-danger">
                                            � ����������...
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab-create-mssql" data-toggle="tab" href="#tab-content-create-mssql" role="tab" aria-controls="tab-content-create-mssql" aria-selected="true">����� ����������</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tab-conn-mssql" data-toggle="tab" href="#tab-content-conn-mssql" role="tab" aria-controls="tab-content-conn-mssql" aria-selected="false">������������ ����������</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content tab-content-border">
                                                    <div class="tab-pane fade show active" id="tab-content-create-mssql" role="tabpanel" aria-labelledby="tab-create-mssql">
                                                        ...
                                                    </div>
                                                    <div class="tab-pane fade" id="tab-content-conn-mssql" role="tabpanel" aria-labelledby="tab-conn-mssql">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">������������ ����������</label>
                                                                <select class="form-control" id="exampleFormControlSelect1">
                                                                    <?php
                                                                    $array = include '../app/config/db.php';
                                                                    foreach ($array as $item)
                                                                    {
                                                                        echo '<option>'.$item['name'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <button type="submit" class="btn btn-danger btn-lg">������� ���������</button>
                                                                <button type="submit" class="btn btn-primary btn-lg">���������</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------ -->
    <!-- ������ ������ ������������ --- -->
    <!-- ----------------- ------------ -->
    <div id="divContentNav4" class="admin-content-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>������ ������ ������������</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

