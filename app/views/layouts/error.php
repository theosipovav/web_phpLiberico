<?php

//header( "refresh:15; url=." );
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="KOI8-R">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/site.css" rel="stylesheet" type="text/css"/>
    <title>АРМ доступа к технической документации</title>
</head>
<body>
<div class="header" style="display: none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 text-center">
                <div style="display: inline; padding: 0px 10px; background: white; color: black; border-radius: 5px;">
                    <span class="ion-ios-gear"></span><span class="ion-ios-gear"></span><span class="ion-ios-gear"></span>
                </div>
            </div>
            <div class="col-md-11">
                <h5 class="h5">АРМ доступа к технической документации</h5>
            </div>
        </div>
    </div>
</div>
<!-- Основное содержимое сайта -->
<div class="content">
    <div class="container">
        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
            <div class="row">
                <div class="col">
                    <h4 class="alert-heading">Ошибка при работе сервиса!</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col">
                            <p style="font-weight: bold"><?php echo $msg;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="img/error.png" class="img-fluid" alt="Responsive image">
                </div>
            </div>
            <div class="row">
                <div class="col"><hr><p>Вы будете автоматически перенаправлены на главную страницу сервиса через <b>15</b> сек.</p></div>
            </div>
            <div class="row text-center">
                <div class="col"><a href="." class="btn btn-primary">Перейти на главную страницу</a></div>
            </div>
        </div>
    </div>
</div>

<div class="footer">

</div>
</body>
<!-- Подключение JS элементов -->
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/popper.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/loodsmandoc.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
</html>