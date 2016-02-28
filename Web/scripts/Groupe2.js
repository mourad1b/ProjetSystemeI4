var Groupe2 = (function() {
    var options = {
        item: '<li class="list-group-item">' +
            '<span class="idGroupe" hidden="hidden"></span>' +
            '<span class="libelleGroupe"></span>' +
            '<span><a class="glyphicon glyphicon-trash btnDeleteGroupe btnSupprimer  pull-right" title="Supprimer"></a>' +
            '<a class="glyphicon glyphicon-user btnAffectUserGroupe  pull-right" title="Affecter des utilisateurs à ce groupe"></a>' +
            '<a class="glyphicon glyphicon-pencil pull-right btnUpdateGroupe btnModifier" title="Modifier"></a>' +
            '</span></li>'
    };

    var _url = "../Web/index.php?page=groupes";
    var idGroupe, libelleGroupe, input_file_csv;
    var panelFormFileAddUserGroupe = $('.panelFormFileAddUserGroupe');
    var panelFormManageGroupe = $('.panelFormManageGroupe');
    var panelFormListGroupe = $('.panelFormListGroupe');
    var panelFormAddGroupe = $('.panelFormAddGroupe');
    var btnManageGroupe = $('.btnManageGroupe');

    var loadingImg = $('#loader');
    var _groupesLi, groupeList;
    var btnList = $(".list");

    panelFormFileAddUserGroupe.hide();
    panelFormManageGroupe.hide();
    panelFormAddGroupe.hide();
    panelFormListGroupe.hide();
    var btnAddNewGroupe = $(".btnAddNewGroupe");
    var btnUpdateGroupe = $(".btnUpdateGroupe");
    var btnDeleteGroupe= $(".btnDeleteGroupe");
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
        //_loaderOn();
        // Lancement de l'appel ajax
        $.ajax({
            //csrf:true,
            url: "../Web/index.php?page=groupes&action=list",
            type: 'POST'
        }).done(
            function(data) {
               _groupesLi = jQuery.parseJSON(data);
                initList();

            //$('#listGroupe').text(_groupesLi);
            //_displayAddFile();
                //_loaderOff();
            })
    };

    function initList() {
        groupeList = new List('groupe-list', options, _groupesLi);
    };

    function cleanForm() {
        $('#inputIdGroupe').val("");
        $('#inputLibelleGroupe').val("")
        $('#modalContentGroupe').find(".key").prop('disabled', false);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdGroupe').val(li.find('.idGroupe').text());
        $('#inputLibelleGroupe').val(li.find('.libelleGroupe').text());
        $('#modalContentGroupe').find(".key").prop('disabled', true);
    };

    function _initEvents() {
        btnManageGroupe.click(function (e) {
            e.preventDefault();

            var modal = bootbox.dialog({
                title: "Gestion des groupes",
                message: panelFormListGroupe.show(),
                buttons: [{
                    label: "Quitter",
                    className: "btn-default btnCancelGroupe"
                }],
                //show : false,
                onEscape: function () {
                    //console.log("X (exit add)");
                }
            });

            modal.on('click', '.btnDeleteGroupe', function (e) {
                e.preventDefault();
                idGroupe = $(this).parent().parent().find('.idGroupe').text();

                var modal = bootbox.confirm({
                    //title: "Suppression du mail "+nomSelectUser,
                    message: "Êtes-vous sûr ?",
                    callback: function (result) {
                        //console.log('');
                    }
                });

                modal.on('click', '.btn-primary', function () {
                    console.log('btnDeleteGroupe '+idGroupe);
                    //_loaderOn();
                    $.ajax({
                        url: _url + "&action=delete&idGroupe=" + idGroupe,
                        type: 'POST',
                        data : {
                            idGroupe: idGroupe
                        }
                        //context: document.body
                    }).done(function () {
                        //_loaderOff();
                        bootbox.alert("Groupe supprimé.");
                    });
                });
            });

            modal.on('click', '.btnAddNewGroupe', function (e) {
                e.preventDefault();
                console.log('btnAddNewGroupe');
                cleanForm();
                $('.inputLibelleGroupe').val("");
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
                            className: "btn-success btnAddGroupe buttonValide",
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

                modal.on('click', '.btnAddGroupe', function (e) {
                    e.preventDefault();
                    console.log('btnAddGroupe');
                    libelleGroupe = $.trim($('.inputLibelleGroupe').val());
                    //_loaderOn();

                    if(libelleGroupe == "") {
                        bootbox.alert('Libellé est obligatoire !');
                        //cleanForm();
                        IHM.validateModal();
                        return "";
                    }

                    $.ajax({
                        method: "POST",
                        url: _url + "&action=create",
                        data: {libelleGroupe: libelleGroupe}
                        //,context: document.body
                    }).done(function (data) {
                        groupeList.add({"idGroupe": data.idGroupe, "libelleGroupe": libelleGroupe});
                        //$( this ).addClass( "done" );
                        // _loaderOff();
                        bootbox.alert("Groupe ajouté.");
                    });
                });
            });

            modal.on('click', '.btnUpdateGroupe' ,function (e) {
                e.preventDefault();
                $("li.fillSource").removeClass('fillSource');
                $(this).closest("li.row").addClass('fillSource');
                fillForm();
                idGroupe = $(this).parent().parent().find('.idGroupe').text();

                libelleGroupe = $(this).parent().parent().find('.libelleGroupe').text();
                $('.inputLibelleGroupe').val(libelleGroupe);
                IHM.validateModal();

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

                modal.on('click', '.btnUpdateGroupe', function () {
                    console.log("ajax modif");
                    libelleGroupe = $('.inputLibelleGroupe').val();
                    //fillForm();

                    if(libelleGroupe == "") {
                        bootbox.alert('Libellé est obligatoire !');
                        //cleanForm();
                        IHM.validateModal();
                        return "";
                    }
                    //_loaderOn();

                    console.log(idGroupe + "  " +libelleGroupe);
                   $.ajax({
                       url: _url + "&action=update&idGroupe=" + idGroupe,
                       type: "POST",
                       data: {idGroupe: idGroupe, libelleGroupe: libelleGroupe}
                        //context: document.body
                    }).done(function () {
                        var li = $('.fillSource');
                        li.find('.libelleGroupe').text(libelleGroupe);
                        //_loaderOff();
                        bootbox.alert("Groupe mis à jour.");
                        //$( this ).addClass( "done" );
                    });

                });
            });

            modal.on('click', '.btnAffectUserGroupe', function (e) {
                e.preventDefault();
                $('select').multipleSelect({
                    filter: true
                });
                //IHM.validateModal();

                idGroupe = $(this).parent().parent().find('.idGroupe').text();

                console.log(idGroupe);

                var modal = bootbox.dialog({
                    title: "Affecter des utilisateurs au groupe n° "+idGroupe,
                    message: panelFormFileAddUserGroupe.show(),
                    buttons: [{
                        label: "Annuler",
                        className: "btn-default btnCancelGroupe"
                    },
                        {
                            label: "Valider",
                            className: "btn-success btnAffectUser buttonValide",
                            callback: function () {
                                //Example.show("Hello");
                            }
                        }],
                    //show : false,
                    onEscape: function () {
                        //modal.modal("hide");
                    }
                });

                modal.on('click', '.btnAffectUser', function (e) {
                    e.preventDefault();
                    console.log(idGroupe);

                    if("" == "") {
                        bootbox.alert('Aucun utilisateur sélectionné.');
                        //cleanForm();
                        IHM.validateModal();
                        return "";
                    }

                    /*
                    $.ajax({
                        method: "POST",
                        url: _url + "&action=affect&idGroupe=" + idGroupe,
                        data: {
                            idGroupe: idGroupe
                        }
                        //,context: document.body
                    }).done(function (data) {
                        //$( this ).addClass( "done" );
                        // _loaderOff();
                        bootbox.alert("Utilisateurs affectés au groupe.");
                    });
                    */

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
