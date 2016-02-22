var Groupe = (function() {

    var options = {
        item: '<li class="list-group-item">' +
        '<span class="idGroupe" hidden="hidden"></span>' +
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
        //$('#panelFormListGroupe').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        //$('#panelFormListGroupe').slideDown();
        //$("body").addClass('modal-open');
    };

    var _getGroupes = function() {
        _loaderOn();
        console.log("appel _getGroupes()");
        // Lancement de l'appel ajax
        $.ajax({
            //csrf:true,
            url: "../Web/index.php?page=groupes&action=list",
            type: 'POST'
        }).done(
            function(data) {
                _groupesLi = jQuery.parseJSON(data);
                _loaderOff();
                //console.log(_groupesLi);
                initList();
            })
    };

    function initList() {
        groupeList = new List('groupe-list', options, _groupesLi);
    };

    function cleanForm() {
        $('#inputIdGroupe').val("");
        $('#inputLibelleGroupe').val("")
        panelFormManageGroupe.find("#inputLibelleGroupe").val("");
        //$('#modalContentMail').find(".key").prop('disabled', false);
    };

    function fillForm() {
        //$(this).parent().parent().find('.libelleGroupe').text();
        li = $('.fillSource');
        $('#inputIdGroupe').val(li.find('.idGroupe').text());
        $('#inputLibelleGroupe').val(li.find('.libelleGroupe').text());

        panelFormManageGroupe.find("#inputLibelleGroupe").val(libelleGroupe);
        //$('#modalContentMail').find(".key").prop('disabled', true);
    };
    function _initEvents() {

        btnSupprGroupe.click(function (e) {
            e.preventDefault();

            idGroupe = $(this).parent().parent().find('.idGroupe').text();


            libelleGroupe = $(this).parent().parent().find('.libelleGroupe').text();

            var modal = bootbox.confirm({
                title: "Êtes-vous sûr ?",
                message: "Supprimer groupe : "+libelleGroupe,
                callback: function (result) {
                    //bootbox.alert(" result " +result);
                }
            });

            modal.on('click', '.btn-primary', function () {
               _loaderOn();
                $.ajax({
                    url: "../Web/index.php?page=groupes&action=delete&idGroupe=" + idGroupe
                    //context: document.body
                }).done(function () {
                    //groupeList.remove({"idGroupe": data.idGroupe, "libelleGroupe": libelleGroupe});
                    _loaderOff();
                    bootbox.alert("Groupe supprimé.");
                });
                //@todo gérer le refresh avec _getGroupes()
                //location.reload();
               //_getGroupes();
            });

        });

        btnAddGroupe.click(function (e) {
            e.preventDefault();

            formManageGroupe.attr('name', 'formAddGroupe');
            cleanForm();

            var modal = bootbox.dialog({
                title: "Nouveau groupe",
                message: panelFormManageGroupe.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelGroupe"
                },
                    {
                        label: "Ajouter",
                        className: "btn-success btnAddNewGroupe buttonValide"
                    }],
                //show : false,
                onEscape: function () {
                    //console.log("X (exit add)");
                }
            });

            IHM.validateModal();


            modal.on('click', '.btnAddNewGroupe', function () {

                idGroupe = $(this).parent().parent().find('.idGroupe').text();
                libelleGroupe = $.trim($('#inputLibelleGroupe').val());

                if(libelleGroupe == "")
                {
                    bootbox.alert("Libellé est obligatoire et ne doit pas être vide.");
                    return"";
                }

                _loaderOn();
                $.ajax({
                    method: "POST",
                    url: "../Web/index.php?page=groupes&action=create",
                    data: {libelleGroupe: libelleGroupe}
                    //,context: document.body
                }).done(function (data) {
                    //groupeList.add({"idGroupe": data.idGroupe, "libelleGroupe": libelleGroupe});
                    _loaderOff();
                    bootbox.alert("Groupe ajouté.");
                    //location.reload();
                });
                _getGroupes();
            });
        });

        btnModifGroupe.click(function (e) {
            e.preventDefault();
            //console.log("formUpdateUser");
            formManageGroupe.attr('name', 'formUpdateUser');

            var libelle;
            idGroupe = $(this).parent().parent().find('.idGroupe').text();
            libelleGroupe = $(this).parent().parent().find('.libelleGroupe').text();

            fillForm();

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
                        className: "btn-success btnUpdateGroupe buttonValide"
                    }],
                //show : false,
                onEscape: function () {
                    //console.log("X (exit modif)");
                }
            });

            IHM.validateModal();

            modal.on('click', '.btnUpdateGroupe', function () {
                libelleGroupe =  $.trim($('#inputLibelleGroupe').val());

                if(libelleGroupe == "")
                 {
                 bootbox.alert("Libellé est obligatoire et ne doit pas être vide.");
                 return "";
                 }

                _loaderOn();
                $.ajax({
                    method: "POST",
                    url: "../Web/index.php?page=groupes&action=update&idGroupe=" + idGroupe,
                    data: {idGroupe: idGroupe, libelleGroupe: libelleGroupe}
                    //context: document.body
                }).done(function () {
                    _loaderOff();

                    bootbox.alert("Groupe mis à jour.");
                    //$( this ).addClass( "done" );
                });
                _getGroupes();
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
$(document).ready(Groupe.init());
