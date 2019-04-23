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
            <div class="col-md-9"><h3 class="h3">АРМ доступа к технической документации</h3></div>
            <div class="col-md-3 text-right">
                <div class="btn-group" role="group" aria-label="main-menu-up-btns" style="margin: 0 5px;">
                    <button type="button" class="btn btn-link btn-sm" id="btn-minimize" title="Свернуть окно меню">
                        <span class="ion-chevron-down"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-expend" title="Развернуть окно меню" style="display: none">
                        <span class="ion-chevron-up"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-refresh" title="Обновить приложение">
                        <span class="ion-refresh"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btnHelp" data-toggle="modal" data-target="#modalHelp" title="Показать подсказку">
                        <span class="ion-help"></span>
                    </button>
                    <button type="button" class="btn btn-link btn-sm" id="btn-shutdown" title="Закрыть приложение" onclick="callMethodC('Exit')">
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
                    <h5 class="h5">Поиск документации:</h5>
                </div> <!-- .main-menu-card-header -->
                <div class="main-menu-card-body">
                    <div>
                        <div class="form-row">
                            <form class="col-md-10" id="formInputId">
                                <input type="text" list="datalistMainObj" class="form-control" name="inputId" id="inputId" placeholder="..." title="Ввод данных">
                                <div id="divListObjs">
                                    <div id="divListObjsBody">
                                        <ul id="ulListObjs"></ul><div id="divListObjsResult">Соответствий не найдено</div>
                                    </div>
                                </div>
                                <div id="feedback_inputId" class="invalid-feedback">Пожалуйста, введите номер сопроводительного паспорта или наименование изделия</div>
                            </form>
                            <div class="col-md-2 text-center">
                                <button id="btnSearchProduct" class="btn btn-primary">ПОИСК</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 text-right">
                                Режим поиска:
                            </div>
                            <div class="col-md-10">
                                <div class="form-check" style="margin-bottom: 0">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radioMode" id="radioMode1" value="1" <?php if ($nMode == 1) { echo "checked";}?>>
                                        Поиск по номеру сопроводительного паспорта
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 0">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radioMode" id="radioMode2" value="2" <?php if ($nMode == 2) { echo "checked";}?>>
                                        Поиск по наименованию объекта
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .main-menu-card-body -->
            </div><!-- .main-menu-card -->
            <div class="main-menu-card">
                <div class="main-menu-card-header">
                    <h5 class="h5">Меню объекта:</h5>
                </div> <!-- .main-menu-card-header -->
                <div class="main-menu-card-body">
                    <div class="d-flex flex-column">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-md-4 text-center">
                                Наименование объекта:
                            </div>
                            <div class="col-md-7">
                                <?php
                                if (($sProductName === NULL) || ($sProductName === ''))
                                {
                                    echo '<input id="inputProductName" class="form-control text-center" style="font-style: italic" placeholder="Наименование найденного изделия" value="'.$sProductName.'" readonly="" type="text">';
                                }
                                else
                                {
                                    echo '<input id="inputProductName" class="form-control text-center" style="background-color: #BCFFBC; font-weight: bold; font-style: italic" placeholder="Наименование найденного изделия" value="'.$sProductName.'" readonly="" type="text">';
                                }
                                ?>
                            </div>
                            <div class="col-md-1" style="padding: 0">
                                <button class="btn btn-outline-success" <?php if ($sProductName == null){ echo "disabled";} ?>  data-toggle="modal" data-target="#modalStructureProduct" title="Показать часть структуры для текущего изделия">
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
                                            echo '<a class="nav-link text-danger disabled" id="tab-child-obj" data-toggle="tab" href="#tabpanel-child-obj" role="tab" aria-controls="home" aria-expanded="true">Состоит из ...</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark" id="tab-child-obj" data-toggle="tab" href="#tabpanel-child-obj" role="tab" aria-controls="home" aria-expanded="true">Состоит из ...</a>';
                                        }
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        if ($optionsObjUp == '')
                                        {
                                            echo '<a class="nav-link text-danger disabled" id="tab-parent-obj" data-toggle="tab" href="#tabpanel-parent-obj" role="tab" aria-controls="profile">Входит в ...</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark" id="tab-parent-obj" data-toggle="tab" href="#tabpanel-parent-obj" role="tab" aria-controls="profile">Входит в ...</a>';
                                        }
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        if ($optionsDocNTD == '')
                                        {
                                            echo '<a class="nav-link text-danger active disabled" id="tab-ntd" data-toggle="tab" href="#tabpanel-ntd" role="tab" aria-controls="profile">Документация НТД</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="nav-link text-dark active" id="tab-ntd" data-toggle="tab" href="#tabpanel-ntd" role="tab" aria-controls="profile">Документация НТД</a>';
                                        }
                                        ?>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade menu-card-tab" id="tabpanel-child-obj" role="tabpanel" aria-labelledby="tab-child-obj">
                                        <div class="menu-card-tab-body">
                                            <div class="menu-card-tab-header">
                                                Перечень объектов "Состоит из":
                                            </div>
                                            <div style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectObjDown" class="form-control"><?php echo $optionsObjDown;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button id="btnOpenAsMainObj" class="btn btn-primary" onclick="fTabObjDown('1')">
                                                                Открыть, как основную сб. ед.
                                                                <span class="ion-gear-a"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button id="btnOpenAsAssociatedObj" class="btn btn-primary" onclick="fTabObjDown('2')">
                                                                Открыть, как связанную сб. ед.
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
                                                Перечень объектов "Входит в":
                                            </div>
                                            <div class="form-control" style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectObjUp" class="form-control"><?php echo $optionsObjUp;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fTabObjUp('1')">
                                                                Открыть, как основную сб. ед.
                                                                <span class="ion-gear-a"></span><span class="ion-gear-b"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fTabObjUp('2')">
                                                                Открыть, как связанную сб. ед.
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
                                                Нормативно - техническая документация:
                                            </div>
                                            <div style="margin-top: 10px; padding: 10px">
                                                <div class="form-group">
                                                    <select id="selectDocNTD" type="text" class="form-control"><?php echo $optionsDocNTD;?></select>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fViewDocNtd(1)">Открыть документ на первом мониторе</button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <button type="submit" class="btn btn-primary" onclick="fViewDocNtd(2)">Открыть документ на втором мониторе</button>
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
                            <span class="ion-power"></span> Завершить работу
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-outline-primary" id="btn-minimize-2">
                            Свернуть меню
                            <span class="ion-chevron-down"></span>
                        </button>
                    </div>
                </div>
            </div><!-- .main-menu-card -->
        </div>
        <div class="main-menu-body-dummy"></div>
    </div><!-- .main-menu-body -->
</div>
<div id="btn-expend-display-bottom" class="main-menu-btn" title="Показать основное меню приложения">
    <div class="row">
        <div class="col-md-2" style="text-align: left">
            <span class="ion-gear-b" style="margin-left: 5px"></span><span class="ion-gear-a"></span><span class="ion-gear-b"></span>
        </div>
        <div class="col-md-8" style="text-align: center">
            <span>АРМ доступа к технической документации</span>
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
                <h5 class="modal-title" id="modalHelpLabel">Справочная информация по использованию сервиса</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">Разделы:
                    <li><a href="#modal-help-section-1" class="btn btn-link btn-sm">Основное меню: основные элементы управления</a></li>
                    <li><a href="#modal-help-section-2" class="btn btn-link btn-sm">Основное меню: поиск документации по изделию</a></li>
                    <li><a href="#modal-help-section-3" class="btn btn-link btn-sm">Основное меню: вкладки "Состоит из", "Входит в ..." и "Документация НТД""</a></li>
                    <li><a href="#modal-help-section-4" class="btn btn-link btn-sm">Отображение документации на мониторах</a></li>
                    <li><a href="#modal-help-section-5" class="btn btn-link btn-sm">Взаимодействие с документами</a></li>
                </ul>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-1">#Основное меню: основные элементы управления</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">перейти к разделам <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN1.jpg">
                </div>
                <div>
                    <p>Назначение кнопок основного меню:</p>
                    <div>
                        1 - Свернуть окно основное меню;<br>
                        2 - Перезагрузить систему "АРМ доступа к технической документации";<br>
                        3 - Вызов подсказки;<br>
                        4 - Завершить работу в системе "АРМ доступа к технической документации"<br>
                        5 - Завершить работу в системе "АРМ доступа к технической документации" (аналогично с кн.4);<br>
                        6 - Свернуть окно основное меню (аналогично с кн.1);<br>
                    </div>
                </div>

                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-2">#Основное меню сервиса "АРМ доступа к технической документации"</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">перейти к разделам <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN2.jpg">
                </div>
                <p>
                    В данном окне представлено основное меню сервиса.
                </p>
                <p>Флажки "Поиск по номеру сопроводительного паспорта" и "Поиск по наименованию объекта" (2) указывает на то, как будет производиться поиск основной сборочной единицы.</p>
                <ul>
                    <li>"Поиск по номеру сопроводительного паспорта" - поиск осуществляется по номеру сопроводительного паспорта (пример, 12123456789);</li>
                    <li>"Поиск по наименованию объекта" - поиск осуществляется по наименованию объекта ДСЕ (пример, ЦПКУ.123456.789).</li>
                </ul>
                <p>
                    Для того что бы приступить к поиску документации необходимо в поле "Поиск документации" ввести номер сопроводительного паспорта или наименование объекта ДСЕ.
                    После чего необходимо нажать на кнопку "Ввод" или на клавишу клавиатуры "ENTER". Если объект был найден, то в поле "Наименование объекта" высветится его обозначение ДСЕ.
                </p>
                <p>
                    Данное меню можно скрыть, нажав следующие кнопки:
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN3.jpg">
                </div>
                <p>
                    Для того, что бы меню вновь отображалось, необходимо нажать следующие кнопки:
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN4.jpg">
                </div>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-3">#Основное меню: вкладки "Состоит из", "Входит в ..." и "Документация НТД"</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">перейти к разделам <span class="ion-arrow-up-c"></span></a></p>
                <p>
                    Изначально вкладки "Состоит из ..." и "Входит в ..." недоступны, так как отсутствует загруженная информация по изделию, по ним нельзя кликать, и имеют красный цвет в наименованиях.
                    Как только для данных вкладок появится необходимая информация они поменяют свой цвет на черный и станут доступными для открытия.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN5.jpg">
                </div>
                <p>
                    На данных вкладках присуствуют две кнопки: "Открыть документ на первом мониторе"(1) и "Открыть документ на втором мониторе"(2), которые, собственно, открывают выбранный документ на первом или втором мониторе.
                </p>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-4">#Отображение документации на мониторах</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">перейти к разделам <span class="ion-arrow-up-c"></span></a></p>
                <div class="div-img">
                    <img src="img/imgHelpN6.jpg">
                </div>
                <ul>После того, как была выполнена авторизация на обоих мониторах откроется во весь экран окна "Просмотр документации" с вкладками (1):
                    <li>"Документация по основному изделию";</li>
                    <li>"Документация по связанному изделию";</li>
                    <li>"Документация НТД".</li>
                </ul>
                <div class="div-img">
                    <img src="img/imgHelpN7.jpg">
                </div>
                <p>
                    На данных окнах присутствует выпадающий список (2), кликнув на который открывается список всей найденной документации. Сортировка документации по мониторах осуществляется администратором.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN8.jpg">
                </div>
                <p>
                    После того как нужная документация была выбрана она отобразится на текущем мониторе.
                </p>
                <p>
                    Кнопка "Убрать меню"/"Показать меню" (3) скрывает или открывает окно "Главное меню".
                </p>
                <hr/>
                <h5 class="h5 font-weight-bold" id="modal-help-section-5">#Взаимодействие с документами</h5>
                <p style="text-align: right; font-style: italic"><a href="#modalHelpLabel">перейти к разделам <span class="ion-arrow-up-c"></span></a></p>
                <p>
                    При просмотре документов пользователю доступно ряд инструментов, доступ к которым можно осуществить нажав правую кнопку мыши в поле просмотра документа.
                </p>
                <ul>В данном окне представлено три режима просмотра:
                    <li>Инструмент "Выделение";</li>
                    <li>Инструмент "Рука";</li>
                    <li>Увеличить выделенное.</li>
                </ul>
                <p>
                    Так же на данном окне показано описание всех доступных функций и комбинации клавиш для быстрого вызова их.
                </p>
                <div class="div-img">
                    <img src="img/imgHelpN9.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalStructureProduct" tabindex="-1" role="dialog" aria-labelledby="modalStructureProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 50%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStructureProductLabel">Структура для изделия "<?php echo $sProductName;?>"</h5>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>