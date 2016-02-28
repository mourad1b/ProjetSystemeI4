var Mail2 = (function() {
    var options = {
        item: '<li class="row"><div class="idMail col-md-1"></div><div class="libelle col-md-3"></div>' +
        '<div class="objet col-md-3"></div><div class="corps col-md-4"></div><div class="col-md-1 text-right">' +
        '<button id="btnUpdateMail" class="btnUpdateMail btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteMail" class="btnDeleteMail btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _mails, mailList, li, idMail, libelle, objet, corps;
    var _url = "../Web/index.php?page=mails";

    var _action;
    var modal = $('#modal');
    var btnSubmitMail = $('.btnSubmitMail');
    var btnUpdateMail = $('.btnUpdateMail');
    var btnNewMail = $('.btnNewMail');
    var btnList = $(".list");

    function _getMails() {
        $.ajax({
            url : _url + "&action=list",
            type: 'POST'
        })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _mails = jQuery.parseJSON(data);
                initList();
            });
    };

    function initList() {
        mailList = new List('mail-list', options, _mails);
    };

    function cleanForm() {
        $('#inputIdMail').val("");
        $('#inputLibelle').val("");
        $('#inputObjet').val("");
        $('#inputBody').val("");
        $('#modalContentMail').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdMail').val(li.find('.idMail').text());
        $('#inputLibelle').val(li.find('.libelle').text());
        $('#inputObjet').val(li.find('.objet').text());
        $('#inputBody').val(li.find('.corps').text());
        $('#modalContentMail').find(".key").prop('disabled', true);
    };

    function _initEvents() {
        btnNewMail.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateMail", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });

        btnList.on("click",".btnDeleteMail", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idMail = li.find('.idMail').text();
            /*libelle = li.find('.libelle').text();
            objet = li.find('.objet').text();
            corps = li.find('.corps').text();
            */
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            modal.on('click', '.btn-primary', function () {
             $.ajax({
             url:  _url + "&action=" + _action + '&idMail=' + idMail,
             type: 'POST',
             data : {
                 idMail: idMail
             }
            //context: document.body
             })
                 .done(function () {
                     //mailList.add({"idMail": idMail, "libelleMail": libelle, "objetMail": objet, "corpsMail":corps});
                     //mailList.add();
                     bootbox.alert("Suppression ok.");
                     //modal.hide();
                });
             });
        });

        btnSubmitMail.click(function() {
            idMail = $('#inputIdMail').val();
            libelle = $.trim($('#inputLibelle').val());
            objet = $.trim($('#inputObjet').val());
            corps = $.trim($('#inputBody').val());

            if(libelle == "") {
                bootbox.alert('Libellé est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }
            if(objet == "") {
                bootbox.alert('Objet est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }
            if(corps == "") {
                bootbox.alert('Corps est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            $.ajax({
                //csrf: true,
                url : _url + "&action=" + _action +  ((_action === 'update') ? '&idMail=' + idMail : ''),
                type: 'POST',
                data : {
                    idMail: idMail,
                    libelleMail: libelle,
                    objetMail: objet,
                    corpsMail: corps
                }
            })
                .done(function(data) {
                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.libelle').text(libelle);
                            li.find('.objet').text(objet);
                            li.find('.corps').text(corps);
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();
                            break;
                        case "create":
                            mailList.add({"idMail": idMail, "libelleMail": libelle, "objetMail": objet, "corpsMail":corps});
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            break;
                    }
                });
        });
    };

    return {
        init : function() {
            _getMails();
            _initEvents();
        }
    };
})();
$(document).ready(Mail2.init());
