<div class="viewdoc">
    <div class="viewdoc-select-doc">
        <div class="form-group">
            <?php
            if ($options == '')
            {
                echo '<select disabled class="form-control"><option>Навигация по найденной документации</option></select>';
            }
            else
            {
                echo '<select class="form-control">'.$options.'</select>';
            }
            ?>
        </div>
    </div>
    <?php
    ?>
    <div class="viewdoc-content" id="view-docs-main" <?php if ($isHide == '1') { echo 'style="display: none"';} ?>>
        <object id="<?php echo $htmlObjectId;?>" data="<?php echo $path;?>"></object>
    </div>
</div>