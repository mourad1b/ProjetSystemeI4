suppr = false;
$('#main').on('click', '#btnOuvrePanelSuppr', function (e) {
    e.preventDefault();
    if (suppr == false) {
        suppr = true;
        $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        $("#panelAjout").slideDown();
    }
    else {
        suppr = false;
        $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $("#panelAjout").slideUp();
    }
});