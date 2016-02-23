var User2 = (function() {
    var options = {
        item: '<li class="row"><div class="idUser col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="prenom col-md-3"></div><div class="mail col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateUser btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button></div></li>'
    };

    var _users, userList, li, idUser, nom, prenom, mail;
    var _url = "../Web/index.php?page=users";

    var _action;
    var  modal = $('#modal');
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
            //e.stopPropagation();
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateUser", function(e) {
            e.preventDefault();

            IHM.validateModal();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            _action = "update";
        });

        btnSubmitUser.click(function() {
            idUser = $('#inputIdUser').val();
            nom = $('#inputNom').val();
            prenom = $('#inputPrenom').val();
            mail = $.trim($('#inputMail').val());

            console.log("idUser : "+idUser);
            if(mail == "") {
                bootbox.alert('Mail est obligatoire !');
                cleanForm();
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
