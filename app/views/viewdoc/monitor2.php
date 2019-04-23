<nav class="nav nav-tabs" id="tab-pan-view-docs-nav" role="tablist">
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor2') == '1') {echo "active";} ?>" id="tab-docs-main" data-toggle="tab" href="#tab-pane-docs-main" role="tab" aria-controls="tab-pane-docs-main">
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
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor2') == '2') {echo "active";} ?>" id="tab-docs-additional" data-toggle="tab" href="#tab-pane-docs-additional" role="tab" aria-controls="tab-pane-docs-additional">
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
    <a class="nav-item nav-link <?php if (Session::getVelue('nTabMonitor2') == '3') {echo "active";} ?>" id="tab-docs-ntd" data-toggle="tab" href="#tab-pane-docs-ntd" role="tab" aria-controls="tab-pane-docs-ntd">
        <span class="ion-clipboard"></span><span class="ion-gear-b"></span>
        Документация НТД
        <?php
        if (isset($bangeDocNtdM2))
        {
            echo '<span class="badge badge-primary" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$bangeDocNtdM2.'</span>';
        }
        else
        {
            echo '<span class="badge badge-danger" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">не загружено</span>';
        }
        ?>
    </a>
</nav>
<div class="tab-content" id="tab-pan-view-docs-content">
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor2') == '1') {echo "show active";} ?>" id="tab-pane-docs-main" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aDocMain']))
        {
            new ViewDocWidget(array('id'=>'objectDocMain','value'=>$aVarsView['aDocMain'],'hide'=>'0'));
        }
        ?>
    </div>
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor2') == '2') {echo "show active";} ?>" id="tab-pane-docs-additional" role="tabpanel" aria-labelledby="nav-profile-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aDocAdditional']))
        {
            new ViewDocWidget(array('id'=>'objectDocAdditional','value'=>$aVarsView['aDocAdditional'],'hide'=>'0'));
        }
        ?>
    </div>
    <div class="tab-pane fade <?php if (Session::getVelue('nTabMonitor2') == '3') {echo "show active";} ?>" id="tab-pane-docs-ntd" role="tabpanel" aria-labelledby="nav-dropdown1-tab">
        <?php
        // Виджет для просмотра документации
        if (isset($aVarsView['aObjectDocNtdM2']))
        {
            new ViewDocWidget(array('id'=>'objectDocNtdM2','value'=>$aVarsView['aObjectDocNtdM2'],'hide'=>'0'));
        }
        ?>
    </div>
</div>
<?php
if (isset($aVarsView["sStatusTitle"]))
{
    new StatusLoadWidget(array('status'=>$aVarsView["sStatusTitle"],'msg'=>$aVarsView["sStatusMsg"]));
}
?>
