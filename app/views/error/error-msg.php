<style>
    div.error-msg{
        position: fixed;
        z-index: 100;
        top: 150px;
        right: 0px;
        background: #FFA4A4;
        padding: 5px;
    }
    div.error-msg div.error-msg-title{
        padding: 0px 10px;
    }
    div.error-msg div.error-msg-body{
        padding: 5px;
    }
    div.error-msg div.error-msg-footer{
        text-align: center;
    }
    div.error-msg button.error-msg-close{
        background: #fff;
        color: #000;
        border: 1px solid #FFF;
        cursor: pointer;
        border-radius: 5px;
    }
    div.error-msg button.error-msg-close:hover{
        background: #F0F0F0;
    }

</style>
<div class="error-msg" id="error-msg-14022019">
    <div class="error-msg-title">
        <h3>Ошибка!</h3>
    </div>
    <div class="error-msg-body">
        <p><?php echo $msg; ?></p>
    </div>
    <div class="error-msg-footer">
        <button class="error-msg-close" onclick="f_error_msg_close_msg()">Скрыть</button>
    </div>
</div>
<script>
    function f_error_msg_close_msg() {
        document.getElementById("error-msg-14022019").style.display = "none";
    }
</script>