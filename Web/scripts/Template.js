var Template = (function() {
    var options = {
        /*item: '<li class="row"><div class="idTemplate col-md-1"></div><div class="nom col-md-3"></div>' +
        '<div class="contenu col-md-4"></div><div class="lien col-md-3"></div><div class="col-md-1 text-right">' +
        '<button class="btnUpdateTemplate btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
        '<button id="btnDeleteTemplate" class="btnDeleteTemplate btn btn-info btn-xs">Supprimer</button></div></li>'
        */
        item: '<div class="col-lg-3 col-md-6 col-sm-6 animate-box bodyHtmlTemplate"><a class="fh5co-card" href="#"> ' +
        '<img src="" alt="" class="img-responsive" style="text-align: center">' +
        '<div class="fh5co-card-body" style="height: 300px"></div> ' +
        '<button class="btnUpdateTemplate btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Utiliser</button></a></div>'
    };

    var _newsletters, newsletterList, li, idTemplate, nom, contenu, lien;
    var _url = "../Web/index.php?page=newsletters";

    var _action;
    var modal = $('#modal');
    var modalTemplate =$('#modalTemplate');
    var btnSubmitTemplate = $('.btnSubmitTemplate');
    var btnUpdateTemplate = $('.btnUpdateTemplate');
    var btnNewTemplate = $('.btnNewTemplate');
    var btnList = $(".list");
    var _templates;

    function _getNewsletters() {
        $.ajax({
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
                        if(key == (_newsletters.length-1)){
                            //console.log(tinyMCE.activeEditor.getContent());
                            newsletterList.add({idNewsletter: value.idNewsletter, nom: value.nom, "contenu": value.contenu, "lien":value.lien});
                        }
                    });
                }
                initList();
            });
    };

    function initList() {
        newsletterList = new List('newsletter-list', options, _newsletters);
    };

    function _getTemplates() {
        var contenuTemplate = null;
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _newsletters = jQuery.parseJSON(data);
                var ed = tinyMCE.get('inputContenu');
                //ed.setContent(value.contenu); // contenu html

                $.each(_newsletters, function (key, value) {
                    //if (value.idNewsletter == idTemplate) {
                        //console.log(value.idNewsletter);

                        contenuTemplate = '<div class="col-lg-3 col-md-6 col-sm-6 animate-box "> <a class="fh5co-card" href="#"> '
                            + '<img src="" alt="'+ value.nom+'" class="img-responsive" style="text-align: center"> '
                            + '<div class="fh5co-card-body bodyHtmlTemplate"  style="height: 300px"> '
                            + value.contenu + '</div>'
                            + '<button class="btnUpdateTemplate btn btn-default" data-id="'+ value.idNewsletter + '" data-toggle="modal" data-target="#modal">Utiliser ce modèle</button></a></div>';

                        $("#bodyHtmlContenuTemplate").append(contenuTemplate);

                    if(_action =="update"){
                            console.log(ed);
                            console.log('idTemplate update : '+idTemplate);
                        }

                    //}
                });



            });
    };

    function cleanForm() {
        $('#inputIdTemplate').val("");
        $('#inputNom').val("");
        $('#inputContenu').val("");
        $('#inputLien').val("");
        $('#modalContentTemplate').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdTemplate').val(li.find('.idTemplate').text());
        $('#inputNom').val(li.find('.nom').text());
        $('textarea#inputContenu').val(li.find('.contenu').text());
        $('#inputLien').val(li.find('.lien').text());
        $('#modalContentTemplate').find(".key").prop('disabled', true);
        var ed = tinyMCE.get('inputContenu');
        //ed.setContent(li.find('.contenu').text()); // contenu html
    };

    function _initEvents() {
        btnList.on("click",".btnUpdateTemplate", function(e) {
            e.preventDefault();
            idTemplate = $(this).data('id');
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();

            console.log(_newsletters);
            $.each( _newsletters, function( key, value ) {
                if(value.idNewsletter == idTemplate){
                    console.log('idTemplate submit: '+idTemplate);
                    $('#inputNom').val(value.nom);
                    $('textarea#inputContenu').val(value.contenu);
                    var ed = tinyMCE.get('inputContenu');
                    ed.setContent(value.contenu); // contenu html
                }
            });



            IHM.validateModal();
            _action = "update";
        });

        btnSubmitTemplate.click(function() {
            tinyMCE.triggerSave(); //  pour la creation de template

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

            $.ajax({
                    //csrf: true,
                    url : _url + "&action=" + _action +  ((_action === 'update') ? '&idNewsletter=' + idTemplate : ''),
                    type: 'POST',
                    data : {
                        idNewsletter: idTemplate,
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

                            $('#inputNom').text(nom);
                            $("textarea#inputContenu").text(contenu);

                            tinyMCE.triggerSave();  //  pour la modification du template
                            //_getNewsletters();
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();
                            break;

                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getNewsletters();
                            break;
                    }
                });
        });

    };



    function _editmodal() {
        var bodyHtmlTemplate = $('.bodyHtmlTemplate');
        bodyHtmlTemplate.click(function (e) {
            var idTemplate = $('.btnUpdateIdTemplate').data('id');
            //$('#dataTemplate').data('id');
            console.log("Edit Modal Template : " + idTemplate);
            //_getTemplates();

            $.ajax({
                    url: "../Web/index.php?page=newsletters" + "&action=list",
                    type: 'POST'
                })
                .done(function (data) {
                    _templates = jQuery.parseJSON(data);
                    /*$.each(_templates, function (key, value) {
                     console.log(value.idNewsletter);
                     if (value.idNewsletter == idTemplate) {
                     console.log("clic : " +value.idNewsletter);

                     }
                     });
                     */
                });
        });
    };


    return {
        init : function() {
            _getTemplates();
            //_getNewsletters();
            _initEvents();
           //_editmodal();
        },

        editmodal: function() {
            _editmodal();
        }
    };
})();
$(document).ready(Template.init());
