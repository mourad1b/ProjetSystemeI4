var Mail2 = (function() {
    var options = {
        item: '<li class="row"><div class="idMail col-md-1"></div><div class="libelle col-md-3"></div>' +
        '<div class="objet col-md-3"></div><div class="corps col-md-4"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateMail btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button></div></li>'
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
            //IHM.validateModal();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            _action = "update";
        });

        btnSubmitMail.click(function() {
            idMail = $('#inputIdMail').val();
            libelle = $('#inputLibelle').val();
            objet = $('#inputObjet').val();
            corps = $('#inputBody').val();

            if(libelle == "") {
                bootbox.alert('Libellé est obligatoire !');
                cleanForm();
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
                            mailList.add({"idUser": data.idUser, "libelle": libelle, "objet": objet, "corps":corps});
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
