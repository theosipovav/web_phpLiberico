



var isMenuMinimize = false;
var pathPdf = '../app/lib/DymanicPdf';


$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});



$('#btn-minimize').click(function(event)
{
    checkViewMainMenu();
});
$('#btn-minimize-2').click(function(event)
{
    checkViewMainMenu();
});
$('#btn-expend').click(function(event)
{
    checkViewMainMenu();
});
$('#btn-minimize-expend').click(function(event)
{
    checkViewMainMenu();
});
$('#btn-expend-display-bottom').click(function(event)
{
    checkViewMainMenu();
});
$('#btn-refresh').click(function(event)
{
    window.location = '.';
});


$('#btnSearchProduct').click(function(event)
{
    if ($('#radioMode1').prop('checked'))
    {
        var sId = $('#inputId').val().toString();
        if (sId.length === 0)
        {
            $('#inputId').addClass('is-invalid');
            $('#feedback_inputId').css('display', 'block');
            $('#main-menu').css('height','610px');
            return;
        }
        window.location = '?r=main/passport/' + sId.toString();
    }
    else
    {
        var sProductName = $('#inputId').val().toString();
        if ($('#radioMode2').prop('checked'))
        {
            if (sProductName.length === 0)
            {
                $('#inputId').addClass('is-invalid');
                $('#feedback_inputId').css('display', 'block');
                $('#main-menu').css('height','610px');
                return;
            }
            window.location = '?r=main/name/1/' + sProductName.toString();
        }
        else
        {
            alert('Ошибка в работе JS скрипта: $("#btnSearchProduct").click(function(event) { ... }');
        }
    }
});


$('#modalHelp').on('shown.bs.modal', function ()
{
    $('#modalHelp').trigger('focus')
});

$('#inputId').focusin(function ()
{
    //$("#divListObjs").css("display","block");
});
$('#inputId').focusout(function ()
{
    //$("#divListObjs").css("display","none");
});
$(document).mouseup(function (e)
{
    if ($("#divListObjs").has(e.target).length === 0)
    {
        $("#divListObjs").css("display", "none");
    }
});


$('#inputId').on("input", function()
    {
        if ($('#radioMode2').is(":checked") != true)
        {
            return;
        }
        if(this.value.length <= 3)
        {
            $("#divListObjs").css("display","block");
            $("#ulListObjs").html("");
            $("#divListObjsResult").html("Введите более трех символа...");
        }
        else
        {
            $("#divListObjsResult").html("Загрузка...");
            var sName = $('#inputId').val();
            var sUrl = "../app/ajax/run_query_mssql.php?name="+sName;
            $.ajax({
                type: 'GET',
                url: sUrl,
                dataType: "html",
                cache: false,
                success: function (data) {
                    $("#divListObjsBody").html(data);
                    $("#divListObjs").css("display", "block");
                },
                error: function (xhr, str) {
                    var html = "<ul id=\"ulListObjs\"></ul><div id=\"divListObjsResult\">Ошибка при выполнение поиска соответствий...</div>";
                    $("#divListObjsBody").html(html);
                }
            });
        }
    }
);

function fInsertNameObj(sName) {
    $("#inputId").val(sName);
}


$("#radioMode1").click(function () {
   if ($("#radioMode1").is(":checked")) {
       $.ajax({
           type: 'GET',
           url: "../app/ajax/set_session.php?key=nMode&value=1",
           dataType: "html",
           cache: false,
           success: function (data) {

           },
           error: function (xhr, str) {
               alert("Ошибка 149");
           }
       });
   }
});
$("#radioMode2").click(function () {
    if ($("#radioMode2").is(":checked")) {
        $.ajax({
            type: 'GET',
            url: "../app/ajax/set_session.php?key=nMode&value=2",
            dataType: "html",
            cache: false,
            success: function (data) {

            },
            error: function (xhr, str) {
                alert("Ошибка 167");
            }
        });
    }
});
