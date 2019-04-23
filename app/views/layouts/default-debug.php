<?php
for ($n=0; $n<count($aDebugInfo); $n++)
{

}

?>


<div id="debug-panel" class="debug-panel debug-panel-minimize">
    <div id="debug-panel-header" class="debug-panel-header">debug panel</div>
    <div id="debug-panel-content" class="debug-panel-content">
        <table>
            <tbody>

            </tbody>
        </table>
        <?php echo '<pre>'.print_r($aDebugInfo, true).'</pre>'?>
    </div>
</div>

<script src="js/site-debug.js" type="text/javascript"></script>