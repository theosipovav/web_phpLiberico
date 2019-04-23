//
// �������� ����� ������ �������� �������� �����
$(document).ready(function()
{
    // ������ "1" �� ����� ������������ ������� ������
    $('#aBtnNav1').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav1').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav1').addClass('show');
    });

    // ������ "2" �� ����� ������������ ������� ������
    $('#aBtnNav2').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2').addClass('show');
    });

    // �������� ������ "2_1" �� ������� "2" �� ����� ������������ ������� ������
    $('#aBtnNav2_1').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_1').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_1').addClass('show');
    });

    // �������� ������ "2_2" �� ������� "2" �� ����� ������������ ������� ������
    $('#aBtnNav2_2').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_2').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_2').addClass('show');
    });

    // �������� ������ "2_3" �� ������� "2" �� ����� ������������ ������� ������
    $('#aBtnNav2_3').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_3').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_3').addClass('show');
    });

    // �������� ������ "2_4" �� ������� "2" �� ����� ������������ ������� ������
    $('#aBtnNav2_4').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav2_4').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav2_4').addClass('show');
    });

    // ������ "3" �� ����� ������������ ������� ������
    $('#aBtnNav3').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav3').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav3').addClass('show');
    });

    // ������ "4" �� ����� ������������ ������� ������
    $('#aBtnNav4').click(function(event)
    {
        $('.menu-item-a').removeClass('active');
        $('#aBtnNav4').addClass('active');

        $('div.admin-content-nav').removeClass('show');
        $('div#divContentNav4').addClass('show');
    });

    // ������� "������ � �������� ��������� �������" � �������:
    // ������ ���������� -> ��������� ������� -> ��������� �������
    $('#radiosLogsFiles').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsFiles').addClass('show');
    });

    // ������� "������ � ���� ������ MSSQL" � �������:
    // ������ ���������� -> ��������� ������� -> ��������� �������
    $('#radiosLogsMSSQL').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsLogsMSSQL').addClass('show');
    });

    // ������� "������ � ���� ������ PostgreSQL" � �������:
    // ������ ���������� -> ��������� ������� -> ��������� �������
    $('#radiosLogsPSQL').click(function(event)
    {
        $('div.log-content-nav').removeClass('show');
        $('div#divLogsPSQL').addClass('show');
    });

    // ������ "��������� ���������" � �������:
    // ������ ���������� -> ��������� ������� -> ��������� ������� -> ��������� ������ ����� � ���� ������ MSSQL
    $('#btnSettingMssqlInstall').click(function(event)
    {
        //sendAjaxForm('formSettingMssql','../app/ajax/mssql_create_db.php');
        sendAjaxForm('formSettingMssql','../app/ajax/file_edit_config_logs.php');
        
    });
    // ������ "������� ����������" � �������:
    // ������ ���������� -> ��������� ������� -> ��������� ������� -> ��������� ������ ����� � ���� ������ MSSQL
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
            alert('�������� ������: ' + xhr.responseCode);
        }
    });
}

