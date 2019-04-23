<style>
    #modalHelp .modal-body .div-img{
        margin: 10px;
        padding: 15px;
        text-align: center;
    }
    #modalHelp .modal-body .div-img img{
        max-width: 100%;
        height: auto;
        box-shadow: 0px 0px 10px 1px rgb(0, 0, 0);
    }
</style>


<div class="main-menu main-menu-expend" id="main-menu">
    <div class="main-menu-header" id="dialog">
        <div class="row">
            <div class="col-md-9"><h3 class="h3">��� ������� � ����������� ������������</h3></div>
            <div class="col-md-3 text-right">
                <div class="btn-group" role="group" aria-label="main-menu-up-btns" style="margin: 0 5px;">
                    <button type="button" class="btn btn-link btn-sm" id="btn-minimize" title="�������� ���� ����">
                        <span class="ion-chevron-down"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-expend" title="���������� ���� ����" style="display: none">
                        <span class="ion-chevron-up"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-refresh" title="�������� ����������">
                        <span class="ion-refresh"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btnHelp" data-toggle="modal" data-target="#modalHelp" title="�������� ���������">
                        <span class="ion-help"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-shutdown" title="������� ����������" onclick="callMethodC('Exit')">
                        <span class="ion-close"></span>
                    </button>
                </div>
            </div>
        </div>
    </div><!-- .main-menu-header -->
    <div class="main-menu-body">
        <div class="d-flex flex-column">
            <div class="main-menu-card">
                <div class="main-menu-card-header">
                    <h5 class="h5">����� ������������:</h5>
                </div> <!-- .main-menu-card-header -->
                <div class="main-menu-card-body">
                    <div>
                        <div class="form-row">
                            <form class="col-md-10" id="formInputId">
                                <input type="text" list="datalistMainObj" class="form-control" name="inputId" id="inputId" placeholder="..." title="���� ������">
                                <div id="divListObjs">
                                    <div id="divListObjsBody">
                                        <ul id="ulListObjs"></ul><div id="divListObjsResult">������������ �� �������</div>
                                    </div>
                                </div>
                                <div id="feedback_inputId" class="invalid-feedback">����������, ������� ����� ����������������� �������� ��� ������������ �������</div>
                            </form>
                            <div class="col-md-2 text-center">
                                <button id="btnSearchProduct" class="btn btn-primary">�����</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 text-right">
                                ����� ������:
                            </div>
                            <div class="col-md-10">
                                <div class="form-check" style="margin-bottom: 0">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radioMode" id="radioMode1" value="1" <?php if ($nMode == 1) { echo "checked";}?>>
                                        ����� �� ������ ����������������� ��������
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 0">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radioMode" id="radioMode2" value="2" <?php if ($nMode == 2) { echo "checked";}?>>
                                        ����� �� ������������ �������
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .main-menu-card-body -->
            </div><!-- .main-menu-card -->
            <div class="main-menu-card">
                <div class="main-menu-card-header">
                    <h5 class="h5">���� �������:</h5>
                </div> <!-- .main-menu-card-header -->
                <div class="main-menu-card-body">
                    <div class="d-flex flex-column">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-md-4 text-center">
                                ������������ �������:
                            </div>
                            <div class="col-md-7">
                                <?php
                                if (($sProductName === NULL) || ($sProductName === ''))
                                {
                                    echo '<input id="inputProductName" class="form-control text-center" style="font-style: italic" placeholder="������������ ���������� �������" value="'.$sProductName.'" readonly="" type="text">';
                                }
                                else
                                {
                                    echo '<input id="inputProductName" class="form-control text-center" style="background-color: #BCFFBC; font-weight: bold; font-style: italic" placeholder="������������ ���������� �������" value="'.$sProductName.'" readonly="" type="text">';
                                }
                                ?>
                            </div>
                            <div class="col-md-1" style="padding: 0">
                                <button class="btn btn-outline-success" <?php if ($sProductName == null){ echo "disabled";} ?>  data-toggle="modal" data-target="#modalStructureProduct" title="�������� ����� ��������� ��� �������� �������">
                                    <span class="ion-network"></span>
                                </button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <?php
                                        if ($optionsObjDown == '')
                                        {
                                            echo '<a class="nav-link text-danger disabled" id="tab-child-obj" data-toggle="tab" href="#tabpanel-child-obj" role="tab" aria-controls="home" aria-expanded="true">������� �� ...</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark" id="tab-child-obj" data-toggle="tab" href="#tabpanel-child-obj" role="tab" aria-controls="home" aria-expanded="true">������� �� ...</a>';
                                        }
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        if ($optionsObjUp == '')
                                        {
                                            echo '<a class="nav-link text-danger disabled" id="tab-parent-obj" data-toggle="tab" href="#tabpanel-parent-obj" role="tab" aria-controls="profile">������ � ...</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark" id="tab-parent-obj" data-toggle="tab" href="#tabpanel-parent-obj" role="tab" aria-controls="profile">������ � ...</a>';
                                        }
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        if ($optionsDocNTD == '')
                                        {
                                            echo '<a class="nav-link text-danger active disabled" id="tab-ntd" data-toggle="tab" href="#tabpanel-ntd" role="tab" aria-controls="profile">������������ ���</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark active" id="tab-ntd" data-toggle="tab" href="#tabpanel-ntd" role="tab" aria-controls="profile">������������ ���</a>';
                                        }
                                        ?>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade menu-card-tab" id="tabpanel-child-obj" role="tabpanel" aria-labelledby="tab-child-obj">
                                        <div class="menu-card-tab-body">
                                            <div class="menu-card-tab-header">
                                                �������� �������� "������� ��":
                                            </div>
                                            <div style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectObjDown" class="form-control"><?php echo $optionsObjDown;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button id="btnOpenAsMainObj" class="btn btn-primary" onclick="fTabObjDown('1')">
                                                                �������, ��� �������� ��. ��.
                                                                <span class="ion-gear-a"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button id="btnOpenAsAssociatedObj" class="btn btn-primary" onclick="fTabObjDown('2')">
                                                                �������, ��� ��������� ��. ��.
                                                                <span class="ion-paperclip"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade menu-card-tab" id="tabpanel-parent-obj" role="tabpanel" aria-labelledby="tab-parent-obj">
                                        <div class="menu-card-tab-body">
                                            <div class="menu-card-tab-header">
                                                �������� �������� "������ �":
                                            </div>
                                            <div class="form-control" style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectObjUp" class="form-control"><?php echo $optionsObjUp;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fTabObjUp('1')">
                                                                �������, ��� �������� ��. ��.
                                                                <span class="ion-gear-a"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fTabObjUp('2')">
                                                                �������, ��� ��������� ��. ��.
                                                                <span class="ion-paperclip"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade menu-card-tab show active" id="tabpanel-ntd" role="tabpanel" aria-labelledby="tab-ntd">
                                        <div class="menu-card-tab-body">
                                            <div class="menu-card-tab-header">
                                                ���������� - ����������� ������������:
                                            </div>
                                            <div style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectDocNTD" type="text" class="form-control"><?php echo $optionsDocNTD;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fViewDocNtd(1)">������� �������� �� ������ ��������</button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fViewDocNtd(2)">������� �������� �� ������ ��������</button>
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
                </div> <!-- .main-menu-card-body -->
            </div><!-- .main-menu-card -->
            <div class="main-menu-card" style="border: none">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-danger" id="btn-shutdown-2" onclick="callMethodC('Exit')">
                            <span class="ion-power"></span> ��������� ������
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-outline-primary" id="btn-minimize-2">
                            �������� ����
                            <span class="ion-chevron-down"></span>
                        </button>
                    </div>
                </div>
            </div><!-- .main-menu-card -->
        </div>
        <div class="main-menu-body-dummy"></div>
    </div><!-- .main-menu-body -->
</div>
<div id="btn-expend-display-bottom" class="main-menu-btn" title="�������� �������� ���� ����������">
    <div class="row">
        <div class="col-md-2" style="text-align: left">
            <span class="ion-gear-b" style="margin-left: 5px"></span><span class="ion-gear-a"></span><span class="ion-gear-b"></span>
        </div>
        <div class="col-md-8" style="text-align: center">
            <span>��� ������� � ����������� ������������</span>
        </div>
        <div class="col-md-2" style="text-align: center">
            <div class="btn-group" role="group" aria-label="main-menu-up-btns" style="margin: 0 5px;">
                <button type="button" class="btn btn-link btn-sm disabled"><span class="ion-chevron-up"></span></button>
                <button type="button" class="btn btn-link btn-sm disabled"><span class="ion-refresh"></span></button>
                <button type="button" class="btn btn-link btn-sm disabled"><span class="ion-close"></span></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="modalHelpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHelpLabel">���������� ���������� �� ������������� �������</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">�������:
                    <li><a href="#modal-help-section-1" class="btn btn-link btn-sm">�������� ����: �������� �������� ����������</a></li>
                    <li><a href="#modal-help-section-2" class="btn btn-link btn-sm">�������� ����: ����� ������������ �� �������</a></li>
                    <li><a href="#modal-help-section-3" class="btn btn-link btn-sm">�������� ����: ������� "������� ��", "������ � ..." � "������������ ���""</a></li>
                    <li><a href="#modal-help-section-4" class="btn btn-link btn-sm">����������� ������������ �� ���������</a></li>
                    <li><a href="#modal-help-section-5" class="btn btn-link btn-sm">�������������� � �����������</a></li>
                </ul>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-1">#�������� ����: �������� �������� ����������</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">������� � �������� <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN1.jpg">
                </div>
                <div>
                    <p>���������� ������ ��������� ����:</p>
                    <div>
                        1 - �������� ���� �������� ����;<br>
                        2 - ������������� ������� "��� ������� � ����������� ������������";<br>
                        3 - ����� ���������;<br>
                        4 - ��������� ������ � ������� "��� ������� � ����������� ������������"<br>
                        5 - ��������� ������ � ������� "��� ������� � ����������� ������������" (���������� � ��.4);<br>
                        6 - �������� ���� �������� ���� (���������� � ��.1);<br>
                    </div>
                </div>

                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-2">#�������� ���� ������� "��� ������� � ����������� ������������"</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">������� � �������� <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN2.jpg">
                </div>
                <p>
                    � ������ ���� ������������ �������� ���� �������.
                </p>
                <p>������ "����� �� ������ ����������������� ��������" � "����� �� ������������ �������" (2) ��������� �� ��, ��� ����� ������������� ����� �������� ��������� �������.</p>
                <ul>
                    <li>"����� �� ������ ����������������� ��������" - ����� �������������� �� ������ ����������������� �������� (������, 12123456789);</li>
                    <li>"����� �� ������������ �������" - ����� �������������� �� ������������ ������� ��� (������, ����.123456.789).</li>
                </ul>
                <p>
                    ��� ���� ��� �� ���������� � ������ ������������ ���������� � ���� "����� ������������" ������ ����� ����������������� �������� ��� ������������ ������� ���.
                    ����� ���� ���������� ������ �� ������ "����" ��� �� ������� ���������� "ENTER". ���� ������ ��� ������, �� � ���� "������������ �������" ���������� ��� ����������� ���.
                </p>
                <p>
                    ������ ���� ����� ������, ����� ��������� ������:
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN3.jpg">
                </div>
                <p>
                    ��� ����, ��� �� ���� ����� ������������, ���������� ������ ��������� ������:
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN4.jpg">
                </div>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-3">#�������� ����: ������� "������� ��", "������ � ..." � "������������ ���"</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">������� � �������� <span class="ion-arrow-up-c"></span></a></p>
                <p>
                    ���������� ������� "������� �� ..." � "������ � ..." ����������, ��� ��� ����������� ����������� ���������� �� �������, �� ��� ������ �������, � ����� ������� ���� � �������������.
                    ��� ������ ��� ������ ������� �������� ����������� ���������� ��� �������� ���� ���� �� ������ � ������ ���������� ��� ��������.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN5.jpg">
                </div>
                <p>
                    �� ������ �������� ����������� ��� ������: "������� �������� �� ������ ��������"(1) � "������� �������� �� ������ ��������"(2), �������, ����������, ��������� ��������� �������� �� ������ ��� ������ ��������.
                </p>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-4">#����������� ������������ �� ���������</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">������� � �������� <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN6.jpg">
                </div>
                <ul>����� ����, ��� ���� ��������� ����������� �� ����� ��������� ��������� �� ���� ����� ���� "�������� ������������" � ��������� (1):
                    <li>"������������ �� ��������� �������";</li>
                    <li>"������������ �� ���������� �������";</li>
                    <li>"������������ ���".</li>
                </ul>
                <div class="div-img">
                    <img src="img/imgHelpN7.jpg">
                </div>
                <p>
                    �� ������ ����� ������������ ���������� ������ (2), ������� �� ������� ����������� ������ ���� ��������� ������������. ���������� ������������ �� ��������� �������������� ���������������.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN8.jpg">
                </div>
                <p>
                    ����� ���� ��� ������ ������������ ���� ������� ��� ����������� �� ������� ��������.
                </p>
                <p>
                    ������ "������ ����"/"�������� ����" (3) �������� ��� ��������� ���� "������� ����".
                </p>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-5">#�������������� � �����������</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">������� � �������� <span class="ion-arrow-up-c"></span></a></p>
                <p>
                    ��� ��������� ���������� ������������ �������� ��� ������������, ������ � ������� ����� ����������� ����� ������ ������ ���� � ���� ��������� ���������.
                </p>
                <ul>� ������ ���� ������������ ��� ������ ���������:
                    <li>���������� "���������";</li>
                    <li>���������� "����";</li>
                    <li>��������� ����������.</li>
                </ul>
                <p>
                    ��� �� �� ������ ���� �������� �������� ���� ��������� ������� � ���������� ������ ��� �������� ������ ��.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN9.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">�������</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalStructureProduct" tabindex="-1" role="dialog" aria-labelledby="modalStructureProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 50%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStructureProductLabel">��������� ��� ������� "<?php echo $sProductName;?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 5px 30px">
                <?php
                $array = Session::getVelue("aObjUp");
                if (count($array)>0)
                {
                    foreach ($array as $item)
                    {
                        echo '
                            <div class="row">
                                <div class="col-md-9" style="border-left: 1px solid rgb(0, 0, 0); border-bottom: 1px solid rgb(0, 0, 0); border-radius: 0px 0px 15px 15px;">
                                    <span class="ion-android-arrow-dropdown" style="padding-right: 5px"></span>
                                    '.$item['Name'].' - '.$item['Type'].'
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                            </div>';
                    }
                }
                ?>
                <div style="padding-left: 15px;">
                    <?php echo '
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9" style="border-left: 1px solid rgb(0, 0, 0); border-bottom: 1px solid rgb(0, 0, 0); border-radius: 0px 15px 15px; background-color: rgb(188, 255, 188);">'.$sProductName.'</div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                            </div>'?>
                </div>
                <?php
                $array = Session::getVelue("aObjDown");
                if (count($array)>0)
                {
                    foreach ($array as $item)
                    {
                        echo '
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>
                                <div class="col-md-9" style="border-left: 1px solid rgb(0, 0, 0); border-bottom: 1px solid rgb(0, 0, 0); border-radius: 0px 0px 15px 15px;">
                                    <span class="ion-android-arrow-dropright" style="padding-right: 5px;"></span>
                                    '.$item['Name'].' - '.$item['Type'].'
                                </div>
                                <div class="col-md-1"></div>
                            </div>';
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">�������</button>
            </div>
        </div>
    </div>
</div>