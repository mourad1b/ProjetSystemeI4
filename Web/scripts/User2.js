var User2 = (function() {
    var options = {
        item: '<li class="row"><div class="idUser col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="prenom col-md-3"></div><div class="mail col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateUser btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button></div></li>'
    };

    var _users, userList, li, idUser, nom, prenom, mail;
    var _url = "../Web/index.php?page=users";

    var _action;
    var btnSubmitUser = $('.btnSubmitUser');
    var btnUpdateUser = $('.btnUpdateUser');
    var btnNewUser = $('.btnNewUser');
    var btnList = $(".list");


    var listeCache = {};

    function _getUsers() {
        $.ajax({
            url : _url + "&action=list",
            type: 'POST'
        })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _users = jQuery.parseJSON(data);
                initList();
            });

    };

    function initList() {
       //console.log(_users);
        userList = new List('user-list', options, _users);
    };

    function cleanForm() {
        $('#inputIdUser').val("");
        $('#inputNom').val("");
        $('#inputPrenom').val("");
        $('#inputMail').val("");
        //$('#modalContent').find(".key").prop('disabled', false);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdUser').val(li.find('.idUser').text());
        $('#inputNom').val(li.find('.nom').text());
        $('#inputPrenom').val(li.find('.prenom').text());
        $('#inputMail').val(li.find('.mail').text());
        //$('#modalContent').find(".key").prop('disabled', true);
    };

    function _initEvents() {

        /*var modal = bootbox.dialog({
            title: "Utilisateurs",
            message: $('#modal'),
            buttons: [{
                label: "Annuler",
                className: "btn-default btnCancelUser"
            },
                {
                    label: "Ajouter",
                    className: "btn-success btnAddNewUser buttonValide",
                    callback: function () {
                        //Example.show("Hello");
                    }
                }],
            //show : false,
            onEscape : function() {
                console.log("X (exit add)");
                //modal.modal("hide");
            }
        });
        */

        btnNewUser.click(function (e) {
            //e.stopPropagation();
            e.preventDefault();
            cleanForm();
            _action = "create";
            console.log('action:' +_action);
        });

        btnList.on("click",".btnUpdateUser", function(e) {
            e.preventDefault();

            console.log('action:' +_action);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            _action = "update";
        });

        $('#modal').on('click', ".brnSubmitUser", function() {
            console.log('url: ' +_url);
            idUser = $('#inputIdUser').val();
            nom = $('#inputNom').val();
            prenom = $('#inputPrenom').val();
            mail= $('#inputMail').val();

            if(mail == "") {
                bootbox.alert('Mail est obligatoire !');
                return;
            }

            $('#modal').hide();

            console.log('action : '+_action);
            IHM.validateModal();

            $.ajax({
                //csrf: true,
                url : _url + "&action=" + _action +  ((_action === 'update') ? '&idUser=' + idUser : ''),
                type: 'POST',
                data : {
                    nom: nom,
                    prenom: prenom,
                    mail: mail
                }
            })
                .done(function(data) {

                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.nom').text(nom);
                            li.find('.prenom').text(prenom);
                            li.find('.mail').text(mail);

                            bootbox.alert("Mise à jour ok.");
                            break;
                        case "create":
                            userList.add({"idUser": data.idUser, "nom": nom, "prenom": prenom, "mail":mail});
                            bootbox.alert("Enregistrement ok.");
                            break;
                    }
                });
        });
    };

    return {
        init : function() {
            _getUsers();
            _initEvents();
        }

    };
})();
$(document).ready(User2.init());
