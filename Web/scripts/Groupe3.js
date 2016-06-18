var Groupe3 = (function() {
    var options = {
        item: '<li class="row"><div class="idGroupe col-md-2"></div><div class="libelleGroupe col-md-5"></div>'
        + '<div class="nbUsers col-md-2"></div>'
        + '<button class="btnUpdateGroupe btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>'
        + '<button id="btnDeleteGroupe" class="btnDeleteGroupe btn btn-danger btn-xs">Supprimer</button></div></li>'
    };

    var _groupes, groupeList, li, idGroupe, libelleGroupe, idGroupe;
    var _url = "../Web/index.php?page=groupes";

    var _action;
    var modal = $('#modal');
    var btnSubmitGroupe = $('.btnSubmitGroupe');
    var btnSubmitAffectGroupe = $('.btnSubmitAffectGroupe');
    var btnUpdateGroupe = $('.btnUpdateGroupe');
    var btnNewGroupe = $('.btnNewGroupe');
    var btnList = $(".list");
    var btnAffectationGroupe = $('.btnAffectationGroupe');

    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#modalContentGroupe').slideUp();
        $("body").addClass('modal-open');
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#modalContentGroupe').slideDown();
        $("body").removeClass('modal-open');
    };

    function _getGroupes() {
        _loaderOn();
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","libelle":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _groupes = jQuery.parseJSON(data);

                console.log(_groupes);
                $.each( _groupes, function( key, value ) {
                    $('#inputSelectGroupeAffect').append("<option value='"+value.idGroupe+"' data-id='"+value.idGroupe+"'>"+value.libelleGroupe+"</option>");
                });

                if(_action =="create"){
                    $.each( _groupes, function( key, value ) {
                        if(key == 0){
                            groupeList.add({idGroupe: value.idGroupe, libelleGroupe: value.libelleGroupe});
                        }
                    });
                }
                initList();
                _loaderOff();
            })
            .always(function(){
                _loaderOff();
            });
    };

    var _users = null;
    function  _getUsersForAffectToGroupes () {
        _loaderOn();
        $.ajax({
                url : "../Web/index.php?page=users" + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                _users = jQuery.parseJSON(data);
                $.each( _users, function( key, value ) {
                    $('#inputSelectUsersAffect').append("<option value='"+value.idUser+"' data-id='"+value.idUser+"'>"+value.mail+"</option>");
                });

                _loaderOff();
            })
            .always(function(){
                _loaderOff();
            });
    };

    function initList() {
        groupeList = new List('groupe-list', options, _groupes);
    };

    function cleanForm() {
        $('#inputIdGroupe').val("");
        $('#inputLibelle').val("");
        //$('#inputContenu').val("");
        //$('#inputLien').val("");
        $('#modalContentGroupe').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdGroupe').val(li.find('.idGroupe').text());
        $('#inputLibelle').val(li.find('.libelleGroupe').text());
        $('#modalContentGroupe').find(".key").prop('disabled', true);
        //var ed = tinyMCE.get('inputContenu');
        //ed.setContent(li.find('.contenu').text()); // contenu html
    };

    function _initEvents() {
        btnNewGroupe.click(function (e) {
            e.preventDefault();
            cleanForm();

            $('#inputLibelle').parent().parent().show();
            $('#inputLibelle').addClass('modalRequired');
            $('#inputSelectGroupeAffect').parent().parent().hide();
            //$('#inputSelectUsersAffect').parent().parent().hide();

            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateGroupe", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();

            $('#inputLibelle').parent().parent().show();
            $('#inputLibelle').addClass('modalRequired');
            $('#inputSelectGroupeAffect').parent().parent().hide();
            //$('#inputSelectUsersAffect').parent().parent().hide();

            IHM.validateModal();
            _action = "update";
        });

        btnAffectationGroupe.click(function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();

            $('#inputLibelle').parent().parent().hide();
            $('#inputLibelle').removeClass('modalRequired');
            $('#inputSelectGroupeAffect').parent().parent().show();
            $('#inputSelectGroupeAffect').addClass('modalRequired');
            $('#inputSelectGroupeAffect').parent().parent().show();
            //$('#inputSelectUsersAffect').parent().parent().show();

            IHM.validateModal();
            _action = "affect";
        });

        btnList.on("click",".btnDeleteGroupe", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idGroupe = li.find('.idGroupe').text();
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            modal.on('click', '.btn-primary', function () {
                _loaderOn();
                Ajax.now({
                        url:  _url + "&action=" + _action + '&idGroupe=' + idGroupe,
                        type: 'POST',
                        data : {
                            idGroupe: idGroupe
                        }
                })
                .done(function () {
                    bootbox.alert("Suppression ok.");
                    groupeList.remove({"idGroupe": idGroupe, "libelleGroupe": libelleGroupe});
                    modal.hide();
                    _getGroupes();
                    _loaderOff();
                })
                .always(function() {
                    _loaderOff();
                });
            });
        });


        btnSubmitGroupe.click(function() {
            idGroupe = $('#inputIdGroupe').val();
            libelleGroupe = $.trim($('#inputLibelle').val());

            var idUsers = [];
            var idGroupeAffect = $('#inputSelectGroupeAffect option:selected').data('id');

            $('#inputSelectUsersAffect option:selected').each(function(i, selected){
                idUsers[i] = $(selected).data('id');
            });

            if(_action=="create" && libelleGroupe == "") {
                bootbox.alert('Libelle est obligatoire !');
                cleanForm();
                IHM.validateModal();
                return "";
            }

            if(_action=="affect" && (idUsers.length == 0 || idGroupeAffect == "")) {
                bootbox.alert('Sélection Groupe et Utilisateur obligatoire !');
                cleanForm();
                IHM.validateModal();
                return "";
            }

            console.log(idUsers);

            _loaderOn();
            Ajax.now({
                    //csrf: true,
                    url : _url + "&action=" + _action +  ((_action === 'update') || (_action === 'affect') ? '&idGroupe=' + idGroupe : ''),
                    type: 'POST',
                    data : {
                        idGroupe : idGroupeAffect,
                        idGroupeAffect : idGroupeAffect,
                        libelleGroupe : libelleGroupe,
                        idUsers : idUsers
                    }
            })
            .done(function(data) {
                switch(_action) {
                    case "update":
                        var li = $('.fillSource');
                        li.find('.libelleGroupe').text(libelleGroupe);
                        bootbox.alert("Mise à jour ok.");
                        modal.hide();

                        //tinyMCE.triggerSave();  //  pour la modification du template
                        //_getGroupes();
                        break;

                    case "create":
                        bootbox.alert("Enregistrement ok.");
                        modal.hide();
                        _getGroupes();
                        break;

                    case "affect":
                        bootbox.alert("Affectation ok.");
                        modal.hide();
                        //_loaderOff();
                        break;
                }
                _loaderOff();
            })
            .always(function() {
                _loaderOff();
            });
                    });
    };

    return {
        init : function() {
            //initList();
            _getGroupes();
            _initEvents();
            _getUsersForAffectToGroupes();
        }
    };
})();
$(document).ready(Groupe3.init());
