<nav class="nav nav-tabs" id="tab-pan-view-docs-nav" role="tablist" style="padding-left: 200px;">
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor1') == '1') {echo "active";} ?>" id="tab-docs-main" data-toggle="tab" href="#tab-pane-docs-main" role="tab" aria-controls="tab-pane-docs-main">
        <span class="ion-gear-a"></span><span class="ion-gear-b"></span>
        Документация по основному изделию
        <?php
        if (isset($bangeDocMain))
        {
            echo '<span class="badge badge-primary" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$bangeDocMain.'</span>';
        }
        else
        {
            echo '<span class="badge badge-danger" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">не загружено</span>';
        }
        ?>
    </a>
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor1') == '2') {echo "active";} ?>" id="tab-docs-additional" data-toggle="tab" href="#tab-pane-docs-additional" role="tab" aria-controls="tab-pane-docs-additional">
        <span class="ion-paperclip"></span><span class="ion-gear-b"></span>
        Документация по связанному изделию
        <?php
        if (isset($bangeDocAdditional))
        {
            echo '<span class="badge badge-primary" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$bangeDocAdditional.'</span>';
        }
        else
        {
            echo '<span class="badge badge-danger" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">не загружено</span>';
        }
        ?>
    </a>
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor1') == '3') {echo "active";} ?>" id="tab-docs-ntd" data-toggle="tab" href="#tab-pane-docs-ntd" role="tab" aria-controls="tab-pane-docs-ntd">
        <span class="ion-clipboard"></span><span class="ion-gear-b"></span>
        Документация НТД
        <?php
        if (isset($bangeDocNtdM1))
        {
            echo '<span class="badge badge-primary" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$bangeDocNtdM1.'</span>';
        }
        else
        {
            echo '<span class="badge badge-danger" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">не загружено</span>';
        }
        ?>
    </a>
</nav>
<div class="tab-content" id="tab-pan-view-docs-content">
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor1') == '1') {echo "show active";} ?>" id="tab-pane-docs-main" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aDocMain']))
        {
            new ViewDocWidget(array('id'=>'objectDocMain','value'=>$aVarsView['aDocMain']));
        }
        ?>
    </div>
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor1') == '2') {echo "show active";} ?>" id="tab-pane-docs-additional" role="tabpanel" aria-labelledby="nav-profile-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aDocAdditional']))
        {
            new ViewDocWidget(array('id'=>'objectDocAdditional','value'=>$aVarsView['aDocAdditional']));
        }
        ?>
    </div>
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor1') == '3') {echo "show active";} ?>" id="tab-pane-docs-ntd" role="tabpanel" aria-labelledby="nav-dropdown1-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aObjectDocNtdM1']))
        {
            new ViewDocWidget(array('id'=>'objectDocNtdM1','value'=>$aVarsView['aObjectDocNtdM1']));
        }
        ?>
    </div>
</div>
<div style="position: fixed; left: 0px; top: 0px; padding: 7px 10px 5px; z-index: 10" title="убрать/показать меню приложения">
    <button id="btn-minimize-expend" class="btn btn-outline-dark">
        <span class="ion-grid"></span> Основное меню
        <span id="btn-minimize-expend-span-expand" class="ion-chevron-up" style="display: none"></span>
        <span id="btn-minimize-expend-span-shrink" class="ion-chevron-down"></span>
    </button>
</div>
<?php new MainMenuWidget(array($aVarsView['sObjectDocMain'], $aVarsView['aObjDown'], $aVarsView['aObjUp'], $aVarsView['aDocNtd']));?>
<?php
    if (isset($aVarsView["sStatusTitle"]))
    {
        new StatusLoadWidget($aVarsView["sStatusTitle"], $aVarsView["sStatusMsg"]);
    }
?>


<script>
    var name = 'myFunction';
    var data = 'update_monitor_2';
    event = document.createEvent('MessageEvent');
    event.initMessageEvent(name, false, false, data,null,null,null,null);
    document.dispatchEvent(event);
</script>