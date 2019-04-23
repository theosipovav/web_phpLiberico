<div id="cardStatusDoc" style="position: fixed; right: 0px; bottom: 0px; margin: 30px;">
    <div class="card text-white <?php echo $sClassCss;?>" style="max-width: 32rem;">
        <div class="card-header"><?php echo $sTextCatdHeader;?></div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $sText;?></h4>
        </div>
    </div>
</div>
<script>
    setTimeout(function() {$('#cardStatusDoc').fadeOut('fast')},<?php echo $sTime;?>);
</script>