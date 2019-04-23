<?php
// $value -  переменная, каторую необходимо отобразить на мониторе
?>
<div style="position: fixed; right: 0px; top: 200px; background: rgb(255, 218, 218) none repeat scroll 0% 0%; padding: 5px; max-height: 700px; width: 700px; overflow: auto; z-index: 100;">
    <h5>debug_view_value</h5>
    <pre><?php echo print_r($value, true); ?></pre>
</div>