function callMethodC(method) {
    var name = 'myFunction';
    var data = method;
    event = document.createEvent('MessageEvent');
    event.initMessageEvent(name, false, false, data,null,null,null,null);
    document.dispatchEvent(event);
}

function fTabObjDown(mode){
    switch (mode)
    {
        case "1":
            var sProductName = $('#selectObjDown').val().toString();
            window.location = '?r=main/name/1/' + sProductName.toString();
            break;
        case "2":
            var sProductName = $('#selectObjDown').val().toString();
            window.location = '?r=main/name/2/' + sProductName.toString();
            break;
        default:
            alert("Не верно задан параметр функции JS->fTabConsistsOf(...)");
            break;
    }
}
function fTabObjUp(mode){
    switch (mode)
    {
        case "1":
            var sProductName = $('#selectObjUp').val().toString();
            window.location = '?r=main/name/1/' + sProductName.toString();
            break;
        case "2":
            var sProductName = $('#selectObjUp').val().toString();
            window.location = '?r=main/name/2/' + sProductName.toString();
            break;
        default:
            alert("Не верно задан параметр функции JS->fTabConsistsOf(...)");
            break;
    }
}


/**
 * Проверка состояния окна основного меню "АРМ доступа к технической документации" и механизм сворачивания и разворачивания данного окна
 */
function checkViewMainMenu() {
    // Проверка состояния модельного окна "АРМ доступа к технической документации":
    // -- если класс .main-menu-minimize присуствует то модельное окно свернуто
    // -- если класс .main-menu-minimize отсуствует то модельное окно развернуто
    if (isMenuMinimize == false){
        // модельное окно развернуто -> далее его сворачиваем
        $('#btn-minimize-expend').removeClass('btn-outline-dark');
        $('#btn-minimize-expend').addClass('btn-dark');
        $('#btn-minimize-expend-span-expand').css('display', 'inline');
        $('#btn-minimize-expend-span-shrink').css('display', 'none');
        $('#main-menu').addClass('main-menu-minimize');
        $('#main-menu').removeClass('main-menu-expend');
        $('#btn-minimize').css('display', 'none');
        $('#btn-expend').css('display', 'block');
        setTimeout(
            function()
            {
                $('.viewdoc-content').css('display', 'block');
                isMenuMinimize = true;
            },1000
        );
        $('#btn-expend-display-bottom').css('display', 'block');
    }else{
        // модельное окно свернуто -> далее его разворачиваем
        $('.viewdoc-content').css('display', 'none');
        $('#btn-minimize-expend').addClass('btn-outline-dark');
        $('#btn-minimize-expend').removeClass('btn-dark');
        $('#btn-minimize-expend-span-shrink').css('display', 'inline');
        $('#btn-minimize-expend-span-expand').css('display', 'none');
        $('#main-menu').removeClass('main-menu-minimize');
        $('#main-menu').addClass('main-menu-expend');
        $('#btn-minimize').css('display', 'block');
        $('#btn-expend').css('display', 'none');
        setTimeout(
            function()
            {
                isMenuMinimize = false;
            },1000
        );
        $('#btn-expend-display-bottom').css('display', 'none');
    }
}



function viewDoc(id, param)
{
    var sHtmlObjectId = '#'+id.toString();
    var sValue = pathPdf + param;
    $(sHtmlObjectId).attr('data',sValue);
}



function fViewDocNtd(monitor)
{
    window.location = '?r=main/ntd/' + monitor + '/' + $('#selectDocNTD').val().toString();


    /*
    $.ajax({
        type: 'GET',
        url: "../app/ajax/set_session.php?key=aDocNtd&value=...",
        success: function (data) {
            // TRUE
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
    */
}