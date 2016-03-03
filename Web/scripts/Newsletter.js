/**
 * Created by loue on 03/03/2016.
 */
var Newsletter = (function() {
    var options = {
        item: '<li class="row"><div class="idMail col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="photo col-md-3"></div><div class="lien col-md-4"></div><div class="col-md-1 text-right">' +
        '<button id="btnUpdateMail" class="btnUpdateMail btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteMail" class="btnDeleteMail btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _mails, mailList, li, idMail, nom, photo, lien, texte;
    var _url = "../Web/index.php?page=newsletters";

    var _action;
    var modal = $('#modal');
    var btnSubmitMail = $('.btnSubmitMail');
    var btnUpdateMail = $('.btnUpdateMail');
    var btnNewNews = $('.btnNewNews');
    var btnList = $(".list");

    function _getNews() {
        //_url = _url+ "&action=list";
        //console.log(_url);
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
               // data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _mails = jQuery.parseJSON(data);
                initList();
            });
    };

    function initList() {
        mailList = new List('mail-list', options, _mails);
    };

    function cleanForm() {
        $('#inputNom').val("");
        $('#inputPhoto').val("");
        $('#inputLien').val("");
        $('#inputTexte').val("");
        $('#modalContentMail').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdMail').val(li.find('.idMail').text());
        $('#inputLibelle').val(li.find('.nom').text());
        $('#inputObjet').val(li.find('.photo').text());
        $('#inputBody').val(li.find('.lien').text());
        $('#modalContentMail').find(".key").prop('disabled', true);
    };

    function _initEvents() {
        btnNewNews.click(function (e) {
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
            /*nom = li.find('.nom').text();
             photo = li.find('.photo').text();
             lien = li.find('.lien').text();
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
                        //mailList.add({"idMail": idMail, "libelleMail": nom, "objetMail": photo, "corpsMail":lien});
                        //mailList.add();
                        bootbox.alert("Suppression ok.");
                        //modal.hide();
                    });
            });
        });

        btnSubmitMail.click(function() {
            //idMail = $('#inputNom').val();
            nom = $.trim($('#inputNom').val());
            photo = $.trim($('#inputPhoto').val());
            lien = $.trim($('#inputLien').val());
            texte = $.trim($('#inputTexte').val());
            if(nom == "") {
                bootbox.alert('Nom est obligatoire !');
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
                        nomNewsletter: nom,
                        photoNewsletter: photo,
                        lienNewsletter: lien,
                        texteNewsletter: texte
                    }
                })
                .done(function(data) {
                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.nom').text(nom);
                            li.find('.photo').text(photo);
                            li.find('.lien').text(lien);
                            li.find('.texte').text(texte);
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();
                            break;
                        case "create":
                            //mailList.add({"idMail": idMail, "nomNewsletter": nom, "photoNewsletter": photo, "lienNewsletter":lien, "texteNewsletter": texte});
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            break;
                    }
                });
        });
    };
    return {
        init : function() {
            _getNews();
            _initEvents();
        }
    };
})();
$(document).ready(Newsletter.init());
