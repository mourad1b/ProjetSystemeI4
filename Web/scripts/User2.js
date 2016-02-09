var User2 = (function() {
    var options = {
        item: '<li class="row"><div class="id col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="prenom col-md-3"></div><div class="mail col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="updateUser btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button></div></li>'
    };

    var _users;
    var userList;
    var _url = "../Web/index.php?page=users";

    var _action;

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
        $('#inputId').val("");
        $('#inputNom').val("");
        $('#inputPrenom').val("");
        $('#inputMail').val("");
        //$('#modalContent').find(".key").prop('disabled', false);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputId').val(li.find('.id').text());
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

        $('#modalContent').on('click', "#newUser", function() {
            cleanForm();
            _action = "create";
            console.log('action:' +_action);
        });

        $(".list").on("click",".updateUser", function() {
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            _action = "update";
            console.log('action:' +_action);
        });

        $('#modal').on('click', ".submitUser", function() {

            console.log('url: ' +_url);
            id = $('#inputId').val();
            nom = $('#inputNom').val();
            prenom = $('#inputPrenom').val();
            mail= $('#inputMail').val();

            /*if(mail == "") {
                bootbox.alert('Mail est obligatoire !');
                return;
            }*/

            $('#modal').modal('hide');

            console.log('action : '+_action);
            $.ajax({
                //csrf: true,
                url : _url + "&action=" + _action +  ((_action === 'update') ? '&idUser=' + id : ''),
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
                            userList.add({"id": data.id, "nom": nom, "prenom": prenom, "mail":mail});
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
