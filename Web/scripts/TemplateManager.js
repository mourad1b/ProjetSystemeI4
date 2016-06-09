var TemplateManager = (function() {
    var options = {
        item: '<li class="row"><div class="idNewsletter col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="contenu col-md-4"></div><div class="lien col-md-3"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateNewsletter btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteNewsletter" class="btnDeleteNewsletter btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _newsletters, newsletterList, li, idNewsletter, nom, contenu, lien;
    var _url = "../Web/index.php?page=newsletters";

    var _action;
    var modal = $('#modal');
    var btnSubmitNewsletter = $('.btnSubmitNewsletter');
    var btnUpdateNewsletter = $('.btnUpdateNewsletter');
    var btnNewNewsletter = $('.btnNewNewsletter');
    var btnList = $(".list");

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

    function _getNewsletters() {
        //_loaderOn();
        Ajax.now({
                url : _url + "&action=list",
                type: 'POST'
        })
        .done(function(data) {
            //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
            _newsletters = jQuery.parseJSON(data);
            var ed = tinyMCE.get('inputContenu');
            //ed.setContent(value.contenu); // contenu html

            if(_action =="create"){
                $.each( _newsletters, function( key, value ) {
                    if(key == 0){
                        //@todo pouvoir ajouter un contenu formaté en balise html !!! => facile pour les template existants !
                        /*var parser = new tinymce.html.DomParser({validate: true});
                        var rootNode = parser.parse(value.contenu);
                        */
                        //var rootNode = new tinymce.html.Serializer().serialize(new tinymce.html.DomParser().parse('<p>text</p>'));
                        //console.log(rootNode);

                        /*
                        var writer = new tinymce.html.Writer({indent: true});
                        var parser = new tinymce.html.SaxParser(writer).parse('<p><br></p>');
                        console.log(writer.getContent());
                        */

                        //console.log(tinyMCE.activeEditor.getContent());
                        newsletterList.add({idNewsletter: value.idNewsletter, nom: value.nom, "contenu": value.contenu, "lien":value.lien});
                    }
                });
            }
            initList();
            //_loaderOff();
        })
        .always(function(){
            //_loaderOff();
        });
    };

    function initList() {
        newsletterList = new List('newsletter-list', options, _newsletters);
    };

    function cleanForm() {
        $('#inputIdNewsletter').val("");
        $('#inputNom').val("");
        $('#inputContenu').val("");
        $('#inputLien').val("");
        $('#modalContentNews').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdNewsletter').val(li.find('.idNewsletter').text());
        $('#inputNom').val(li.find('.nom').text());
        $('textarea#inputContenu').val(li.find('.contenu').text());
        $('#inputLien').val(li.find('.lien').text());
        $('#modalContentNews').find(".key").prop('disabled', true);
        var ed = tinyMCE.get('inputContenu');
        ed.setContent(li.find('.contenu').text()); // contenu html
};

    function _initEvents() {
        btnNewNewsletter.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateNewsletter", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });

        btnList.on("click",".btnDeleteNewsletter", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idNewsletter = li.find('.idNewsletter').text();
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            modal.on('click', '.btn-primary', function () {
                //_loaderOn();
                Ajax.now({
                        url:  _url + "&action=" + _action + '&idNewsletter=' + idNewsletter,
                        type: 'POST',
                        data : {
                            idNewsletter: idNewsletter
                        }
                        //context: document.body
                    })
                    .done(function () {
                        bootbox.alert("Suppression ok.");
                        modal.hide();
                        newsletterList.remove({"idNewsletter": idNewsletter, "nomNewsletter": nom, "contenuNewsletter": contenu, "lienNewsletter":lien});
                        _getNewsletters();
                        //_loaderOff();
                    })
                    .always(function(){
                        //_loaderOff();
                    });
            });
        });

        btnSubmitNewsletter.click(function() {
            tinyMCE.triggerSave(); //  pour la creation de template
            idNewsletter = $('#inputIdNewsletter').val();
            nom = $('#inputNom').val();
            contenu = $("textarea#inputContenu").val();
            lien = $.trim($('#inputLien').val());
            tinyMCE.triggerSave();  //  pour la modification du template

            if(nom == "") {
                bootbox.alert('Nom est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            //_loaderOn();
            Ajax.now({
                    //csrf: true,
                    url : _url + "&action=" + _action +  ((_action === 'update') ? '&idNewsletter=' + idNewsletter : ''),
                    type: 'POST',
                    data : {
                        idNewsletter: idNewsletter,
                        nomNewsletter: nom,
                        contenuNewsletter: contenu,
                        lienNewsletter: lien
                    }
                })
                .done(function(data) {
                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.nom').text(nom);
                            li.find('.contenu').text(contenu);
                            li.find('.lien').text(lien);
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();
                            tinyMCE.triggerSave();  //  pour la modification du template
                            //_getNewsletters();
                            break;

                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getNewsletters();
                            break;
                    }
                    //_loaderOff();
                })
                .always(function(){
                    //_loaderOff();
                });
        });

    };

    return {
        init : function() {
            //initList();
            _getNewsletters();
            _initEvents();
        }
    };
})();
$(document).ready(TemplateManager.init());
