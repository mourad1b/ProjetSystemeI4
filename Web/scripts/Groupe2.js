var Groupe2 = (function() {

    var options = {
        item: '<li class="list-group-item idGroupe">' +
            '<span class="libelleGroupe"></span>' +
            '<span><a class="glyphicon glyphicon-trash btnSupprGroupe btnSupprimer  pull-right" title="Supprimer"></a>' +
            '<a class="glyphicon glyphicon-pencil pull-right btnModifGroupe btnModifier" title="Modifier"></a></span></li>'
    };

    var idGroupe, libelleGroupe;
    var panelFormManageGroupe = $('.panelFormManageGroupe');
    var panelFormAddGroupe = $('.panelFormAddGroupe');

    var formManageGroupe = $('.formManageGroupe');
    var formActionGroupe = $('.formActionGroupe');

    var loadingImg = $('#loader');

    var _groupesLi, groupeList;

    panelFormManageGroupe.hide();
    panelFormAddGroupe.hide();
    //loadingImg.hide();
    var btnAddGroupe = $(".btnAddGroupe");
    var btnModifGroupe = $(".btnModifGroupe");
    var btnSupprGroupe= $(".btnSupprGroupe");
    var btnSubmitGroupe = $('.btnSubmitGroupe');
    var btnCancelGroupe = $('.btnCancelGroupe');


    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#panelFormListGroupe').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#panelFormListGroupe').slideDown();
        $("body").addClass('modal-open');
    };

    var _getGroupes = function() {
        _loaderOn();

        // Lancement de l'appel ajax
        $.ajax({
            //csrf:true,
            url: "../Web/index.php?page=groupes&action=list",
            type: 'POST'
        }).done(
            function(data) {
               _groupesLi = jQuery.parseJSON(data);
                //console.log(_groupesLi);
                initList();

            //$('#listGroupe').text(_groupesLi);
            //_displayAddFile();
                _loaderOff();
            })
    };

    function initList() {
        //console.log(_mails);
        groupeList = new List('groupe-list', options, _groupesLi);
    };

    function cleanForm() {
        $('#inputIdGroupe').val("");
        $('#inputLibelleGroupe').val("")
        //$('#modalContentMail').find(".key").prop('disabled', false);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdGroupe').val(li.find('.idGroupe').text());
        $('#inputLibelleGroupe').val(li.find('.libelleGroupe').text());
        //$('#modalContentMail').find(".key").prop('disabled', true);
    };
    function _initEvents() {

        btnSupprGroupe.click(function (e) {
            //e.stopPropagation();
            e.preventDefault();

            console.log('btnSupprGroupe');
            idGroupe = $(this).parent().parent().data('idGroupe');
            //var nomSelectUser = $(this).parent().parent().val();

            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //var name = $('#name').val();
                    //var answer = $("input[name='awesomeness']:checked").val()
                    //Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
                }
            });

            modal.on('click', '.btn-primary', function () {
                console.log("btn suppr");
                _loaderOn();
                $.ajax({
                    url: "../Web/index.php?page=groupes&action=delete&idGroupe=" + idGroupe
                    //context: document.body
                }).done(function () {
                    _loaderOff();
                    bootbox.alert("Groupe supprimé.");
                    //todo _getGroupes ==> refresh list
                    //$( this ).addClass( "done" );
                });
            });

        });

        btnAddGroupe.click(function (e) {
            e.preventDefault();
            // vérifier si les champs obligatoire sont remplis

            formManageGroupe.attr('name', 'formAddGroupe');

            //formActionGroupe.attr('action', '../Web/index.php?page=groupes');
            //panelFormManageGroupe.show();
            console.log('btnAddGroupe');
            cleanForm();
            IHM.validateModal();

            var modal = bootbox.dialog({
                title: "Nouveau groupe",
                message: panelFormManageGroupe.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelGroupe"
                },
                    {
                        label: "Ajouter",
                        className: "btn-success btnAddNewGroupe buttonValide",
                        callback: function () {
                            //Example.show("Hello");
                        }
                    }],
                //show : false,
                onEscape: function () {
                    console.log("X (exit add)");
                    //modal.modal("hide");
                }
            });


            modal.on('click', '.btnAddNewGroupe', function () {
                console.log("ajax add");

                libelleGroupe = $('.libelleGroupe').val();
                _loaderOn();

                $.ajax({
                    method: "POST",
                    url: "../Web/index.php?page=groupes&action=create",
                    data: {libelleGroupe: libelleGroupe}
                    //,context: document.body
                }).done(function (data) {
                    groupeList.add({"idGroupe": data.idGroupe, "libelleGroupe": libelleGroupe});
                    //$( this ).addClass( "done" );
                    _loaderOff();
                    bootbox.alert("Groupe ajouté.");
                });

            });
        });

        btnModifGroupe.click(function (e) {
            e.preventDefault();
            //console.log("formUpdateUser");
            formManageGroupe.attr('name', 'formUpdateUser');
            //formActionGroupe.attr('action', '../Web/index.php?page=groupes');
            //panelFormManageGroupe.show();

            fillForm();
            IHM.validateModal();

            idGroupe = $(this).parent().parent().data('idGroupe');
            libelleGroupe = $(this).parent().parent().data('libelle');
            $('.libelleGroupe').val(libelleGroupe);

            var modal = bootbox.dialog({
                title: "Modification du groupe n° " + idGroupe,
                message: panelFormManageGroupe.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelGroupe"
                },
                    {
                        //success: {
                        label: "Enregistrer",
                        className: "btn-success btnUpdateGroupe buttonValide",
                        callback: function () {
                            //Example.show("Hello");
                        }
                        //}
                    }],
                //show : false,
                onEscape: function () {
                    console.log("X (exit modif)");
                    //modal.modal("hide");
                }
            });


            // vérifier si les champs obligatoire sont remplis
            IHM.validateModal();

            modal.on('click', '.btnUpdateGroupe', function () {
                console.log("ajax modif");

                libelleGroupe = $('.libelleGroupe').val();
                _loaderOn();
                $.ajax({
                    method: "POST",
                    url: "../Web/index.php?page=groupes&action=update&idGroupe=" + idGroupe,
                    data: {idGroupe: idGroupe, libelleGroupe: libelleGroupe}
                    //context: document.body
                }).done(function () {
                        var li = $('.fillSource');
                        li.find('.libelleGroupe').text(libelleGroupe);
                    _loaderOff();
                    bootbox.alert("Groupe mis à jour.");
                    //$( this ).addClass( "done" );
                });
            });
        });

    };
    return {
        init : function() {
            _getGroupes();
            _initEvents();
        }

    };

})();
$(document).ready(Groupe2.init());
