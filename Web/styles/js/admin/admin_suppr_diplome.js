supprEnseignantOuvert = false;
$('#main').on('click', '#btnOuvrePanelSuppr', function (e) {
    e.preventDefault();
    if (supprEnseignantOuvert == false) {
        supprEnseignantOuvert = true;
        $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        $("#panelAjout").slideDown();
    }
    else {
        supprEnseignantOuvert = false;
        $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $("#panelAjout").slideUp();
    }
});