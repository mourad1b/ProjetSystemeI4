var User2 = (function() {
    var options = {
        item: '<li class="row"><div class="idUser col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="prenom col-md-3"></div><div class="mail col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateUser btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteUser" class="btnDeleteUser btn btn-danger btn-xs">Supprimer</button></div></li>'
    };

    var _users, userList, li, idUser, nom, prenom, mail, imputFile;
    var _url = "../Web/index.php?page=users";

    var _action;
    var modal = $('#modal');
    var btnSubmitUser = $('.btnSubmitUser');
    var btnUpdateUser = $('.btnUpdateUser');
    var btnNewUser = $('.btnNewUser');
    var btnImporterUsers = $('.btnImporterUsers');
    var btnList = $(".list");

    /*var panelImporterUsers = $('.panelImporterUsers');
    panelImporterUsers.hide();
        */
    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#modalContentCampagne').slideUp();
        $("body").addClass('modal-open');
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#modalContentCampagne').slideDown();
        $("body").removeClass('modal-open');
    };


    function _getUsers() {
        _loaderOn();
        $.ajax({
            url : _url + "&action=list",
            type: 'POST'
        })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _users = jQuery.parseJSON(data);
                if(_action =="create"){
                    $.each( _users, function( key, value ) {
                        if (key == 0) {
                            userList.add({"idUser": value.idUser, "nom": value.nom, "prenom": value.prenom, "mail":value.mail});
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

            $('#inputFile').parent().parent().hide();
            $('#inputMail').parent().parent().show();
            $('#inputFile').removeClass('modalRequired');

            $('#inputMail').addClass('modalRequired');
            $('#inputNom').parent().parent().show();
            $('#inputPrenom').parent().parent().show();

            IHM.validateModal();
            _action = "create";

        });

        btnImporterUsers.click(function (e) {
            e.preventDefault();

            $('#inputFile').parent().parent().show();
            $('#inputFile').addClass('modalRequired');

            $('#inputIdUser').parent().parent().hide();
            $('#inputNom').parent().parent().hide();
            $('#inputPrenom').parent().parent().hide();
            $('#inputMail').parent().parent().hide();

            $('#inputNom').removeClass('modalRequired');
            $('#inputPrenom').removeClass('modalRequired');
            $('#inputMail').removeClass('modalRequired');

            IHM.validateModal();
            _action = "importerCSV";
        });

        btnList.on("click",".btnUpdateUser", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();

            $('#inputMail').parent().parent().show();
            $('#inputFile').removeClass('modalRequired');

            $('#inputIdUser').parent().parent().show();
            $('#inputMail').addClass('modalRequired');
            $('#inputFile').parent().parent().hide();
            $('#inputNom').parent().parent().show();
            $('#inputPrenom').parent().parent().show();

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
                _loaderOn();
                Ajax.now({
                    url:  _url + "&action=" + _action + '&idUser=' + idUser,
                    type: 'POST',
                    data : {
                        idUser: idUser
                    }
                    //context: document.body
                })
                .done(function () {
                    bootbox.alert("Suppression ok.");
                    modal.hide();
                    userList.remove({"idUser": idUser, "nomUser": nom, "prenomUser": prenom, "mailUser":mail});
                    _getUsers();
                    _loaderOff();
                })
                .always(function(){
                    _loaderOff();
                });
        });
        });

        btnSubmitUser.click(function() {
            idUser = $('#inputIdUser').val();
            nom = $.trim($('#inputNom').val());
            prenom = $.trim($('#inputPrenom').val());
            mail = $.trim($('#inputMail').val());

            imputFile = $.trim($('#imputFile').val());
            var ext = $("input#inputFile").val().split(".").pop().toLowerCase();

            if (_action == "importerCSV" && ($.inArray(ext, ["csv"]) == -1)) {
                bootbox.alert('Veuillez ajouter un fichier CSV.');
                //IHM.validateModal();
                return "";
            }

            if (_action == "create" && mail == "") {
                bootbox.alert('Mail est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }


            console.log(_users);
            $.each( _users, function( key, value ) {
                if (value.mail == mail) {
                    bootbox.alert('Certains utilisateurs existent déjà : '+mail);
                    IHM.validateModal();
                    return "";
                }
            });

           if(_action == "importerCSV") {
               var allText = $("input[type='file']")[0].files[0];

               /*if($("input[type='file']")[0].files.length > 0) {
                   */
               var form_data = new FormData();
               form_data.append("file", $("input[type='file']")[0].files[0]);

               //@todo lire le csv pour voir s'il ya des utilisateurs mail déjà existants

               _loaderOn();
               $.ajax({
                   //csrf:true,
                   url: _url + "&action=importerCSV",
                   processData: false, // Important pour l'upload
                   contentType: false, // Important pour l'upload
                   data: form_data,
                   type: "POST"
               }).done(function ( jqXHR , textStatus) {
                       var upload = $('.addFile').find('.uploadButton');
                       upload.addClass('disabled');
                       if (textStatus == "success") {
                           $('.btn-file :file').parents('.input-group').find(':text').val('');
                           bootbox.alert("Utilisateurs ajoutés avec succès");
                           modal.hide();
                       }
                       // _getUsers();
                       _loaderOff();
                   })
                   .always(function(){
                       _loaderOff();
                   })
                   .fail(function(){
                       bootbox.alert("Erreur lors du traitement du Fichier");
                       _loaderOff();
                   });
              // }
            }else{
                _loaderOn();
                Ajax.now({
                //csrf: true,
                url: _url + "&action=" + _action + ((_action === 'update') ? '&idUser=' + idUser : ''),
                type: 'POST',
                data: {
                idUser: idUser,
                nomUser: nom,
                prenomUser: prenom,
                mailUser: mail
                }
                })
                .done(function (data) {
                    switch (_action) {
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
                    _loaderOff();
                })
                .always(function () {
                    _loaderOff();
                });

            }

            });


        /*btnImporterUsers.click(function (e) {
            e.preventDefault();
            IHM.validateModal();
            _action = "importerCSV";

            /*var modal = bootbox.dialog({
                title: "Importer des utilisateurs",
                message: panelImporterUsers.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelGroupe"
                },
                    {
                        label: "Valider",
                        className: "btn-success btnImporterCSV uploadButton buttonValide",
                        callback: function () {
                            //Example.show("Hello");
                        }
                    }],
                //show : false,
                onEscape: function () {
                    //modal.modal("hide");
                }
            });*/

            /*modal.on('click', '.btnImporterCSV', function (e) {
                e.preventDefault();
                imputFile = $.trim($('.imputFile').val());
                ////_loaderOn();

                // The event listener for the file upload
                //document.getElementById('imputFile').addEventListener('change', upload, false);


               // $("#imputFile").change(function(e) {
                   var ext = $("input#inputFile").val().split(".").pop().toLowerCase();

                    if($.inArray(ext, ["csv"]) == -1) {
                        bootbox.alert('Veuillez ajouter un fichier CSV.');
                        //IHM.validateModal();
                        return "";
                    }


                //var fileUpload = document.getElementById("inputFile");
               // var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;


                    if($("input[type='file']")[0].files.length > 0) {
                        var form_data = new FormData();
                        form_data.append("file", $("input[type='file']")[0].files[0]);

                        _loaderOn();
                        $.ajax({
                            //csrf:true,
                            url: _url + "&action=importerCSV",
                            processData: false, // Important pour l'upload
                            contentType: false, // Important pour l'upload
                            data: form_data,
                            type: "POST"
                        }).done(function ( jqXHR , textStatus) {
                            var upload = $('.addFile').find('.uploadButton');
                            upload.addClass('disabled');
                            if (textStatus == "success") {
                                $('.btn-file :file').parents('.input-group').find(':text').val('');
                                bootbox.alert("Utilisateurs ajoutés avec succès");
                            }
                           // _getUsers();
                            _loaderOff();
                        })
                        .always(function(){
                            _loaderOff();
                        })
                        .fail(function(){
                            bootbox.alert("Erreur lors du traitement du Fichier");
                            _loaderOff();
                        });
                    }

            });
        });
*/

    };

    return {
        init : function() {
            _getUsers();
            _initEvents();
        }
    };
})();
$(document).ready(User2.init());
