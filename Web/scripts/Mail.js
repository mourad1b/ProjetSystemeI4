var Mail = function() {

    var idMail, libelleMail, objetMail, corpsMail;
    var panelFormManageMail = $('.panelFormManageMail');

    var formManageMail = $('.formManageMail');
    var formActionMail = $('.formActionMail');

    var loadingImg = $('#loader');

    panelFormManageMail.hide();
    loadingImg.hide();
    var btnAddMail = $(".btnAddMail");
    var btnModifMail = $(".btnModifMail");
    var btnSupprMail = $(".btnSupprMail");
    var btnSubmitMail = $('.btnSubmitMail');
    var btnCancelMail = $('.btnCancelMail');

    /*var libelle = $('.libelleMail').val();
    var objet = $('.objetMail').val();
    var corps = $('.corpsMail').val();
    */
    function _fillForm() {
        var form = $('.selectMail')
        libelleMail = $(this).parent().parent().data('libelle');
        objetMail = $(this).parent().parent().data('objet');
        corpsMail = $(this).parent().parent().data('body');

        $('.libelleMail').val(libelleMail);
        $('.objetMail').val(libelleMail);
        $('.corpsMail').val(libelleMail);
    }

    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#panelFormListMail').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#panelFormListMail').slideDown();
        $("body").addClass('modal-open');
    };
    var _getMails = function() {
        _loaderOn();

        // Lancement de l'appel ajax
        $.ajax({
            csrf:true,
            url: ""
        }).done(
            function(fulldata) {
            var _fichiersLi = '';

            $('#listMail').html(_fichiersLi);
            //_displayAddFile();
        }).always(function(){
            _loaderOff();
        });
    };

    btnSupprMail.click(function (e) {
        //e.stopPropagation();
        e.preventDefault();


        idMail = $(this).parent().parent().data('id');
        //var nomSelectMail = $(this).parent().parent().val();

        var modal = bootbox.confirm({
           //title: "Suppression du mail "+nomSelectMail,
            message: "Êtes-vous sûr ?",
            callback: function (result) {
                //var name = $('#name').val();
                //var answer = $("input[name='awesomeness']:checked").val()
                //Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
            }
        });

        modal.on('click', '.btn-primary', function () {
            $.ajax({
                url: "../Web/index.php?page=mails&action=delete&idMail=" + idMail
                //context: document.body
            }).done(function () {
                bootbox.alert("Mail supprimé.");
                //todo _getMails ==> refresh list
                //$( this ).addClass( "done" );
            });
        });

    });

    btnAddMail.click(function (e) {
        e.stopPropagation();
        formManageMail.attr('name', 'formAddMail');
        //formActionMail.attr('action', '../Web/index.php?page=mails');
        //panelFormManageMail.show();

        var modal = bootbox.dialog({
            title: "Ajout d'un nouveau mail",
            message: panelFormManageMail.show(),
            buttons: [{
                label: "Annuler",
                className: "btn-default btnCancelMail"
            },
            {
                label: "Ajouter",
                className: "btn-success btnAddNewMail buttonValide",
                callback: function () {
                    //Example.show("Hello");
                }
            }],
            //show : false,
            onEscape : function() {
                //console.log("X (exit add)");
                //modal.modal("hide");
            }
        });

        // vérifier si les champs obligatoire sont remplis
        IHM.validateModal();

        modal.on('click', '.btnAddNewMail', function(){
            //console.log("ajax add");

            libelleMail = $('.libelleMail').val();
            objetMail = $('.objetMail').val();
            corpsMail = $('.corpsMail').val();

            $.ajax({
                method: "POST",
                url: "../Web/index.php?page=mails&action=create",
                data: { libelleMail: libelleMail, objetMail: objetMail, corpsMail: corpsMail }
                //,context: document.body
            }).done(function() {
                _loaderOn();
                bootbox.alert("Mail ajouté.");
                //$( this ).addClass( "done" );
            }).always(function() {
                    _loaderOff();
                }
            );

        });
    });

    btnModifMail.click(function (e) {
        e.stopPropagation();
        //console.log("formUpdateMail");
        formManageMail.attr('name', 'formUpdateMail');
        //formActionMail.attr('action', '../Web/index.php?page=mails');
        //panelFormManageMail.show();

        idMail = $(this).parent().parent().data('id');
        libelleMail = $(this).parent().parent().data('libelle');
        objetMail = $(this).parent().parent().data('objet');

        corpsMail = $(this).parent().parent().data('body');
        $('.libelleMail').val(libelleMail);
        $('.objetMail').val(objetMail);

        $('.corpsMail').val(corpsMail);

        var modal = bootbox.dialog({
                title: "Modification du mail n° "+idMail,
                message: panelFormManageMail.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelMail"
                },
                    {
                    //success: {
                    label: "Enregistrer",
                        className: "btn-success btnUpdateMail buttonValide",
                    callback: function () {
                        //Example.show("Hello");
                    }
                //}
                }],
                //show : false,
                onEscape : function() {
                    //console.log("X (exit modif)");
                    //modal.modal("hide");
                }
        });


        // vérifier si les champs obligatoire sont remplis
        IHM.validateModal();

        modal.on('click', '.btnUpdateMail', function(){

            libelleMail = $('.libelleMail').val();
            objetMail = $('.objetMail').val();
            corpsMail = $('.corpsMail').val();

            $.ajax({
                method: "POST",
                url: "../Web/index.php?page=mails&action=update&idMail="+idMail,
                data: {idMail: idMail, libelleMail: libelleMail, objetMail: objetMail, corpsMail: corpsMail }
                //context: document.body
                }).done(function() {
                    _loaderOn();
                    bootbox.alert("Mail mis à jour.");
                    //$( this ).addClass( "done" );
                }).always(function() {
                        _loaderOff();
                });
        });
    });
}
$(document).ready(Mail());
