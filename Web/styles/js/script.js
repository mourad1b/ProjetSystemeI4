$(document).ready(function () {




    /*******************************************************************
     * Ouverture du panel d'ajout
     */
    ajoutEnseigantOuvert = false;
    $('#main').on('click','#btnOuvrePanelAjout', function(e){
        e.preventDefault();
        if(ajoutEnseigantOuvert == false){
            ajoutEnseigantOuvert = true;
            $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            $("#panelAjout").slideDown();
        }
        else{
            ajoutEnseigantOuvert = false;
            $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            $("#panelAjout").slideUp();
        }
    });


    /********************************************************************
     * Menu
     */

    $(".depliant").on("mouseover", function(e){
        e.preventDefault();
        var that = $(this);
        var li = $(this).parent();
        $(this).siblings('ul').show();

        li.on("mouseleave", function(){
            that.siblings('ul').hide();
        });
    });

    /******************************************************************
     * boite de message
     */

    /* Close-box message */
    $('.alert-box').on('click', '.close-box', function () {
        $(this).parent().fadeOut();
        clearMsgBox();
    });

    /* Vide la message box */
    function clearMsgBox() {
        $('.alert-box').find('.msg').html('');
        $('.alert-box').find('.type').html('');
        $('.alert-box').removeClass('success').removeClass('error');
    }

    /* Enleve la boite de message dans 5 seconde */
    function clearBoxIn5() {
        window.setTimeout(function () {
            $('.alert-box').slideUp();
            clearMsgBox();
        }, 5000);
    }

    /*******************************************************************
     * tableau dépliant
     */
    /* Clique au niveau 1 */
    $('.tab > .level1 > .ligne > .content a').click(function () {
        var ligne = $(this).parent().parent();
        if ($('.icon .glyphicon', ligne).hasClass('glyphicon-folder-open')) {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-open');
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-close');
            ligne.nextAll('.level2').hide();
        }
        else {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-close');
            $('.icon .loading', ligne).show();
            ligne.nextAll('.level2').show();
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-open');
            $('.icon .loading', ligne).hide();
        }
    });

    /* Clique au niveau 2 */
    $('.tab > .level1 > .level2 > .ligne > .content a').click(function () {
        var ligne = $(this).parent().parent();
        if ($('.icon .glyphicon', ligne).hasClass('glyphicon-folder-open')) {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-open');
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-close');
            ligne.nextAll('.level3').hide();
        }
        else {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-close');
            $('.icon .loading', ligne).show();
            ligne.nextAll('.level3').show();
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-open');
            $('.icon .loading', ligne).hide();
        }
    });

    /* Clique au niveau 3 */
    $('.tab > .level1 > .level2 > .level3 > .ligne > .content a').click(function () {
        var ligne = $(this).parent().parent();
        if ($('.icon .glyphicon', ligne).hasClass('glyphicon-folder-open')) {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-open');
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-close');
            ligne.nextAll('.last-level').hide();
        }
        else {
            $('.icon .glyphicon', ligne).removeClass('glyphicon-folder-close');
            $('.icon .loading', ligne).show();
            ligne.nextAll('.last-level').show();
            $('.icon .glyphicon', ligne).addClass('glyphicon-folder-open');
            $('.icon .loading', ligne).hide();
        }
    });


    /* Clique sur modifier */
    $('#main').on('click', '.btnModifier', function () {
        var btn_action = $(this).parent();
        $('.btnModifier', btn_action).fadeOut();
        $('.btnSupprimer', btn_action).fadeOut();
        $('.btnSupprimerAdmin', btn_action).fadeOut();
        $('.btnValider', btn_action).delay(400).fadeIn();
        btn_action.parent().find("input").removeAttr("disabled");
    });

    /* Clique sur valider */
    $('#main').on('click', '.btnValider', function () {
        var that = this;
        var tr = $(this).parent().parent();
        var cm = $('.cm input', tr).val();
        var td = $('.td input', tr).val();
        var tp = $('.tp input', tr).val();
        var id = tr.attr('id');

        // !!! CSRF Token est défini en bas du template INDEX, afin de récupérer une fonction twig !!!
        $.post(Routing.generate('kmgh_appbundle_attribution_update', {id: id}), {
            cm: cm,
            td: td,
            tp: tp,
            csrf_token: CSRF_TOKEN
        })
            .done(function (data) {
                if (data == 200) {
                    var btn_action = $(that).parent();
                    var ligne = btn_action.parent();
                    $('.btnValider', btn_action).fadeOut();
                    ligne.find("input").prop("disabled", true).attr('id', 'inputError1');
                    $('#alertMsg').addClass('success').fadeIn();
                    $('#alertMsg .msg').html('Les modifications ont été effectuées avec succès.');
                    $('#alertMsg .type').html('Ok : ');
                    clearBoxIn5();
                    $('.btnModifier', btn_action).delay(400).fadeIn();
                    $('.btnSupprimer', btn_action).delay(400).fadeIn();
                    $('.btnSupprimerAdmin', btn_action).delay(400).fadeIn();

                }
                else {
                    $('#alertMsg .msg').html('Modication non permise');
                    $('#alertMsg .type').html('Erreur : ');
                    $('#alertMsg').addClass('error').fadeIn();
                    clearBoxIn5();
                }
            })
            .fail(function () {
                $('#alertMsg .msg').html('Impossible de se connecter à la base données');
                $('#alertMsg .type').html('Erreur : ');
                $('#alertMsg').addClass('error').fadeIn();
                clearBoxIn5();
            });
    });


    $('#main').on('click', '.btnSupprimer', function (e) {
        e.preventDefault();
        var idAttribution = $(this).parent().parent().attr('id');
        var tr = $(this).parent().parent();
        var tbody = $(this).parent().parent().parent();

        // !!! CSRF Token est défini en bas du template INDEX, afin de récupérer une fonction twig !!!
        $.post(Routing.generate('kmgh_appbundle_attribution_delete', {id: idAttribution}), {csrf_token: CSRF_TOKEN})
            .done(function () {
                tr.fadeOut();
                $('#alertMsg').addClass('success').fadeIn();
                $('#alertMsg .msg').html('attributions supprimée avec succès.');
                $('#alertMsg .type').html('Ok : ');
                clearBoxIn5();
                tbody.append('<tr><td><a href="" class="newUser"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></td></tr>');
            })
            .fail(function () {
                $('#alertMsg .msg').html('Impossible de supprimer l\'attribution');
                $('#alertMsg .type').html('Erreur : ');
                $('#alertMsg').addClass('error').fadeIn();
                clearBoxIn5();
            })

    });


    $('#main').on('click', '.newUser', function (e) {
        e.preventDefault();
        var that = this;
        var tbody = $(this).parent().parent().parent();

        // !!! CSRF Token est défini en bas du template INDEX, afin de récupérer une fonction twig !!!
        $.post(Routing.generate('kmgh_appbundle_attribution_insert'),
            {
                userId: $('#userWelcome').attr('data-idUser'),
                enseignementId: $(this).parents('.last-level').attr('data-enseigementId'),
                csrf_token: CSRF_TOKEN
            })
            .done(function (response) {
                tbody.append('' +
                '<tr id="' + response + '">' +
                '<td class="username">' + $('#userWelcome').html() + '</td>' +
                '<td class="cm"><input type="text" name="cm" value="0" disabled></td>' +
                '<td class="td"><input type="text" name="td" value="0" disabled></td>' +
                '<td class="tp"><input type="text" name="tp" value="0" disabled></td>' +
                '<td class="btn_action">' +
                '<a href="#" title="Modifier" class="btnModifier"><span class="glyphicon glyphicon-pencil"></span></a>' +
                '<a href="#" title="Supprimer" class="btnSupprimer"><span class="glyphicon glyphicon-trash"></span></a>' +
                '<a href="#" title="Valider" class="btnValider"><span class="glyphicon glyphicon-ok"></span></a>' +
                '</td>' +
                '</tr>');
                $(that).parent().parent().fadeOut();
            })
            .fail(function () {
                $('#alertMsg .msg').html('Impossible d\'ajouter une nouvelle attribution');
                $('#alertMsg .type').html('Erreur : ');
                $('#alertMsg').addClass('error').fadeIn();
            })
    });


    /************************************************************
     * ADMIN
     */
    $('#main').on('click', '.btnSupprimerAdmin', function (e) {
        e.preventDefault();
        var idAttribution = $(this).parent().parent().attr('id');
        var tr = $(this).parent().parent();
        var tbody = $(this).parent().parent().parent();

        $.post(Routing.generate('kmgh_appbundle_attribution_delete', {id: idAttribution}), {csrf_token: CSRF_TOKEN})
            .done(function () {
                tr.fadeOut();
                $('#alertMsg').addClass('success').fadeIn();
                $('#alertMsg .msg').html('attributions supprimée avec succès.');
                $('#alertMsg .type').html('Ok : ');
                clearBoxIn5();
            })
            .fail(function () {
                $('#alertMsg .msg').html('Impossible de supprimer l\'attribution');
                $('#alertMsg .type').html('Erreur : ');
                $('#alertMsg').addClass('error').fadeIn();
                clearBoxIn5();
            })
    });

});