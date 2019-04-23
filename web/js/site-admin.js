//
// Действия полсе полной загрузки страницы сайта
$(document).ready(function()
{
    // Кнопка "1" на левой вертикальной боковой панели
    $('#aBtnNav1').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav1').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav1').addClass('show');
    });

    // Кнопка "2" на левой вертикальной боковой панели
    $('#aBtnNav2').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2').addClass('show');
    });

    // Дочерняя кнопка "2_1" дл якнопки "2" на левой вертикальной боковой панели
    $('#aBtnNav2_1').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_1').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_1').addClass('show');
    });

    // Дочерняя кнопка "2_2" дл якнопки "2" на левой вертикальной боковой панели
    $('#aBtnNav2_2').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_2').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_2').addClass('show');
    });

    // Дочерняя кнопка "2_3" дл якнопки "2" на левой вертикальной боковой панели
    $('#aBtnNav2_3').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_3').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_3').addClass('show');
    });

    // Дочерняя кнопка "2_4" дл якнопки "2" на левой вертикальной боковой панели
    $('#aBtnNav2_4').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_4').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_4').addClass('show');
    });

    // Кнопка "3" на левой вертикальной боковой панели
    $('#aBtnNav3').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav3').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav3').addClass('show');
    });

    // Кнопка "4" на левой вертикальной боковой панели
    $('#aBtnNav4').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav4').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav4').addClass('show');
    });

    // Чекбокс "Запись в файловую структуру сервиса" в разделе:
    // Панель управления -> Настройка севриса -> Настройка журнала
    $('#radiosLogsFiles').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsFiles').addClass('show');
    });

    // Чекбокс "Запись в базу данных MSSQL" в разделе:
    // Панель управления -> Настройка севриса -> Настройка журнала
    $('#radiosLogsMSSQL').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsLogsMSSQL').addClass('show');
    });

    // Чекбокс "Запись в базу данных PostgreSQL" в разделе:
    // Панель управления -> Настройка севриса -> Настройка журнала
    $('#radiosLogsPSQL').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsPSQL').addClass('show');
    });

    // Кнопка "Применить установки" в разделе:
    // Панель управления -> Настройка севриса -> Настройка журнала -> Установка записи логов в базу данных MSSQL
    $('#btnSettingMssqlInstall').click(function(event)
    {
        //sendAjaxForm('formSettingMssql','../app/ajax/mssql_create_db.php');
        sendAjaxForm('formSettingMssql','../app/ajax/file_edit_config_logs.php');
        
    });
    // Кнопка "Удалить соединение" в разделе:
    // Панель управления -> Настройка севриса -> Настройка журнала -> Установка записи логов в базу данных MSSQL
    $('#btnSettingMssqlDelete').click(function(event)
    {
        alert('btnSettingMssqlDelete');
    });
});

function sendAjaxForm(sIdForm, sUrl)
{
    $.ajax({
        url: sUrl,
        type: 'POST',
        dataType: 'html',
        data: $('#'+sIdForm.toString()).serialize(),
        success: function (data) {
            alert(data.toString());
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
}

