var Security = (function() {

    var _users, username, password, li, idUser, nom, prenom, mail;
    var _url = "../Web/index.php?page=users";

    var _action;
    var modal = $('#modal');
    var btnSubmitAuth = $('#_submit_auth');

    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#modalContentCampagne').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#modalContentCampagne').slideDown();
        $("body").addClass('modal-open');
    };

    function _getUsers() {
        //_loaderOn();
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _users = jQuery.parseJSON(data);
                console.log(_users);

                //_loaderOff();
            })
            .always(function(){
                //_loaderOff();
            });
    };


    function cleanForm() {
        $('#username').val("");
        $('#password').val("");
        $('#modalContent').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#username').val("");
        $('#password').val("");
        $('#modalContent').find(".key").prop('disabled', true);
    };

    function _initEvents() {

        btnSubmitAuth.click(function() {
            username = $.trim($('#username').val());
            password = $.trim($('#password').val());


            if((username == "") || (password == "")) {
                bootbox.alert('Identifiant et mot de passe obligatoires !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            //_loaderOn();
            /*Ajax.now({
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
                            //_getUsers();
                            break;
                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getUsers();
                            break;
                    }
                    //_loaderOff();
                })
                .always(function(){
                    //_loaderOff();
                });
                */
        });

    };

    return {
        init : function() {
            _getUsers();
            _initEvents();
        }
    };
})();
$(document).ready(Security.init());
