var isDebugPanelMinimize = true;

$('#debug-panel-header').click(function(event){
    if (isDebugPanelMinimize == false)
    {
        $('#debug-panel').removeClass('debug-panel-expend');
        $('#debug-panel').addClass('debug-panel-minimize');
        isDebugPanelMinimize = true;
    }
    else
    {
        $('#debug-panel').addClass('debug-panel-expend');
        $('#debug-panel').removeClass('debug-panel-minimize');
        isDebugPanelMinimize = false;
    }
});