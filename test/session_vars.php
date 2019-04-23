<?php session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="KOI8-R">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../web/css/site.css" rel="stylesheet" type="text/css"/>
    <title>АРМ доступа к технической документации</title>
</head>
<body>
    <div class="container-fluid">
        <div id="exampleAccordion" data-children=".item">
            <!--aDocMain-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aDocMain" aria-expanded="true" aria-controls="aDocMain">
                    $_SESSION["aDocMain"] - <?php echo count($_SESSION["aDocMain"])?>
                </a>
                <div id="aDocMain" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aDocMain"], true)."</pre>"?>
                </div>
            </div>
            <!--sObjectDocMain-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#sObjectDocMain" aria-expanded="false" aria-controls="sObjectDocMain">
                    $_SESSION["sObjectDocMain"] - <?php echo count($_SESSION["sObjectDocMain"])?>
                </a>
                <div id="sObjectDocMain" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["sObjectDocMain"], true)."</pre>"?>
                </div>
            </div>
            <!--aDocAdditional-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aDocAdditional" aria-expanded="false" aria-controls="aDocAdditional">
                    $_SESSION["aDocAdditional"] - <?php echo count($_SESSION["aDocAdditional"])?>
                </a>
                <div id="aDocAdditional" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aDocAdditional"], true)."</pre>"?>
                </div>
            </div>
            <!--sObjectDocAdditional-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#sObjectDocAdditional" aria-expanded="false" aria-controls="sObjectDocAdditional">
                    $_SESSION["sObjectDocAdditional"] - <?php echo count($_SESSION["sObjectDocAdditional"])?>
                </a>
                <div id="sObjectDocAdditional" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["sObjectDocAdditional"], true)."</pre>"?>
                </div>
            </div>
            <!--aObjDown-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aObjDown" aria-expanded="false" aria-controls="aObjDown">
                    $_SESSION["aObjDown"] - <?php echo count($_SESSION["aObjDown"])?>
                </a>
                <div id="aObjDown" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aObjDown"], true)."</pre>"?>
                </div>
            </div>
            <!--aObjUp-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aObjUp" aria-expanded="false" aria-controls="aObjUp">
                    $_SESSION["aObjUp"] - <?php echo count($_SESSION["aObjUp"])?>
                </a>
                <div id="aObjUp" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aObjUp"], true)."</pre>"?>
                </div>
            </div>
            <!--aDocNtd-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aDocNtd" aria-expanded="false" aria-controls="aDocNtd">
                    $_SESSION["aDocNtd"] - <?php echo count($_SESSION["aDocNtd"])?>
                </a>
                <div id="aDocNtd" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aDocNtd"], true)."</pre>"?>
                </div>
            </div>
            <!--aObjectDocNtdM1-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aObjectDocNtdM1" aria-expanded="false" aria-controls="aObjectDocNtdM1">
                    $_SESSION["aObjectDocNtdM1"] - <?php echo count($_SESSION["aObjectDocNtdM1"])?>
                </a>
                <div id="aObjectDocNtdM1" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aObjectDocNtdM1"], true)."</pre>"?>
                </div>
            </div>
            <!--aObjectDocNtdM2-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#aObjectDocNtdM2" aria-expanded="false" aria-controls="aObjectDocNtdM2">
                    $_SESSION["aObjectDocNtdM2"] - <?php echo count($_SESSION["aObjectDocNtdM2"])?>
                </a>
                <div id="aObjectDocNtdM2" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["aObjectDocNtdM2"], true)."</pre>"?>
                </div>
            </div>
            <!--nTabMonitor1-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#nTabMonitor1" aria-expanded="false" aria-controls="nTabMonitor1">
                    $_SESSION["nTabMonitor1"] - <?php echo count($_SESSION["nTabMonitor1"])?>
                </a>
                <div id="nTabMonitor1" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["nTabMonitor1"], true)."</pre>"?>
                </div>
            </div>
            <!--nTabMonitor2-->
            <div class="item">
                <a data-toggle="collapse" data-parent="#exampleAccordion" href="#nTabMonitor2" aria-expanded="false" aria-controls="nTabMonitor2">
                    $_SESSION["nTabMonitor2"] - <?php echo count($_SESSION["nTabMonitor2"])?>
                </a>
                <div id="nTabMonitor2" class="collapse" role="tabpanel">
                    <?php echo "<pre>".print_r($_SESSION["nTabMonitor2"], true)."</pre>"?>
                </div>
            </div>


        </div>
    </div>
</body>
<!-- Подключение JS элементов -->
<script src="../web/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../web/js/popper.min.js" type="text/javascript"></script>
<script src="../web/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../web/js/loodsmandoc.js" type="text/javascript"></script>
<script src="../web/js/site.js" type="text/javascript"></script>
</html>