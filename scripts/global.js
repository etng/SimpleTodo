$(document).ready(function(){
    $.datepicker.setDefaults($.extend({}, {
    "dateFormat": 'yy-mm-dd',
    showMonthAfterYear: true,
    changeMonth: true,
    gotoCurrent: true,
    showButtonPanel: true,
    changeYear: true
    }, $.datepicker.regional['zh-CN']));

    $.facebox.settings.closeImage = 'scripts/images/facebox/closelabel.png';
    $.facebox.settings.loadingImage = 'scripts/images/facebox/loading.gif';
    $('a[rel*=facebox]').facebox();
    $('textarea').autogrow ({
    });
});