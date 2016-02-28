var User2 = (function() {
    var options = {
        item: '<li class="row"><div class="idUser col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="prenom col-md-3"></div><div class="mail col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateUser btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteUser" class="btnDeleteUser btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _users, userList, li, idUser, nom, prenom, mail;
    var _url = "../Web/index.php?page=users";

    var _action;
    var modal = $('#modal');
    var btnSubmitUser = $('.btnSubmitUser');
    var btnUpdateUser = $('.btnUpdateUser');
    var btnNewUser = $('.btnNewUser');
    var btnList = $(".list");

    function _getUsers() {
        $.ajax({
            url : _url + "&action=list",
            type: 'POST'
        })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _users = jQuery.parseJSON(data);
                //console.log(_users);
                initList();
            });
    };

    function initList() {
        userList = new List('user-list', options, _users);
    };

    function cleanForm() {
        $('#inputIdUser').val("");
        $('#inputNom').val("");
        $('#inputPrenom').val("");
        $('#inputMail').val("");
        $('#modalContent').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdUser').val(li.find('.idUser').text());
        $('#inputNom').val(li.find('.nom').text());
        $('#inputPrenom').val(li.find('.prenom').text());
        $('#inputMail').val(li.find('.mail').text());
        $('#modalContent').find(".key").prop('disabled', true);
    };

    function _initEvents() {
        btnNewUser.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateUser", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });

        btnList.on("click",".btnDeleteUser", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idUser = li.find('.idUser').text();
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            modal.on('click', '.btn-primary', function () {
                $.ajax({
                    url:  _url + "&action=" + _action + '&idUser=' + idUser,
                    type: 'POST',
                    data : {
                        idUser: idUser
                    }
                    //context: document.body
                })
                    .done(function () {
                        bootbox.alert("Suppression ok.");
                        //modal.hide();
                    });
            });
        });

        btnSubmitUser.click(function() {
            idUser = $('#inputIdUser').val();
            nom = $('#inputNom').val();
            prenom = $('#inputPrenom').val();
            mail = $.trim($('#inputMail').val());

            if(mail == "") {
                bootbox.alert('Mail est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            $.ajax({
                //csrf: true,
                url : _url + "&action=" + _action +  ((_action === 'update') ? '&idUser=' + idUser : ''),
                type: 'POST',
                data : {
                    idUser: idUser,
                    nomUser: nom,
                    prenomUser: prenom,
                    mailUser: mail
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
                            modal.hide();
                            break;
                        case "create":
                            userList.add({"idUser": data.idUser, "nomUser": nom, "prenomUser": prenom, "mailUser":mail});
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            break;

                        /*
                         e.preventDefault();
                         IHM.validateModal();

                         idGroupe = $(this).parent().parent().find('.idGroupe').text();

                         var modal = bootbox.dialog({
                         title: "Affecter des utilisateurs au groupe n° "+idGroupe,
                         message: panelFormFileAddUserGroupe.show(),
                         buttons: [{
                         label: "Annuler",
                         className: "btn-default btnCancelGroupe"
                         },
                         {
                         label: "Enregistrer",
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
                         input_file_csv = $.trim($('.upload_file_csv').val());
                         //_loaderOn();

                         console.log(idGroupe);

                         if($("input[type=file]")[0].files.length > 0) {
                         var formData = $("input[type=file]")[0].files;
                         var form_data = new FormData();
                         form_data.append("username", "Mourad");
                         form_data.append("accountnum", 123456);
                         form_data.append("file", $("input[type=file]")[0].files[0]);

                         console.log(formData);

                         }else{
                         if(input_file_csv == "") {
                         bootbox.alert('Aucun fichier choisi.');
                         //cleanForm();
                         IHM.validateModal();
                         return "";
                         }
                         }

                         $.ajax({
                         method: "POST",
                         url: _url + "&action=affect&idGroupe=" + idGroupe,
                         data: {
                         idGroupe: idGroupe,
                         formData: formData
                         },
                         //async: false,
                         //cache: false,
                         processData: false, // Important pour l'upload : indique à jQuery de ne pas traiter les données
                         contentType: false // Important pour l'upload : ne pas configurer le contentType
                         //,context: document.body
                         }).done(function (data) {
                         //$( this ).addClass( "done" );
                         // _loaderOff();
                         bootbox.alert("Utilisateurs affectés au groupe.");
                         });

                         });
                         */
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
