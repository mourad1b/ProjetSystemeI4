var Groupe3 = (function() {
    var options = {
        item: '<li class="row"><div class="idGroupe col-md-3"></div><div class="libelleGroupe col-md-6"></div>'
            //+ '<div class="contenu col-md-4"></div><div class="lien col-md-3"></div><div class="col-md-1 text-right">'
        + '<button class="btnUpdateGroupe btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>'
        + '<button id="btnDeleteGroupe" class="btnDeleteGroupe btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _groupes, groupeList, li, idGroupe, libelle, _templates;
    var _url = "../Web/index.php?page=groupes";

    var _action;
    var modal = $('#modal');
    var btnSubmitGroupe = $('.btnSubmitGroupe');
    var btnUpdateGroupe = $('.btnUpdateGroupe');
    var btnNewGroupe = $('.btnNewGroupe');
    var btnList = $(".list");
    var btnDisplayGroupe = $('.hrefDisplayGroupe');
    var btnParametresGroupe = $('.btnParametresGroupe');

    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#modalContentGroupe').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#modalContentGroupe').slideDown();
        $("body").addClass('modal-open');
    };

    function _getGroupes() {
        //_loaderOn();
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","libelle":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _groupes = jQuery.parseJSON(data);

                if(_action =="create"){
                    $.each( _groupes, function( key, value ) {
                        if(key == (_groupes.length-1)){
                            groupeList.add({idGroupe: value.idGroupe, libelle: value.libelleGroupe});
                        }
                    });
                }
                console.log(_groupes);
                initList();
                //_loaderOff();
            })
            .always(function(){
                //_loaderOff();
            });
    };

    function  _getTemplatesAndGroupes () {
        //_loaderOff();
        $.ajax({
                url : "../Web/index.php?page=newsletters" + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                _templates = jQuery.parseJSON(data);
                //console.log(_templates);

                $.each( _templates, function( key, value ) {
                    $('#inputSelectTemplate').append("<option data-id='"+value.idNewsletter+"'>"+value.nom+"</option>");
                });

                //_loaderOff();
            })
            .always(function(){
                //_loaderOff();
            });

        //_loaderOn();
        $.ajax({
                url : "../Web/index.php?page=groupes" + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                _groupes = jQuery.parseJSON(data);
                /*$.each( _groupes, function( key, value ) {
                    $('#inputSelectGroupe').append("<option data-id='"+value.idGroupe+"'>"+value.libelleGroupe+"</option>");
                });*/

                //_loaderOff();
            })
            .always(function(){
                //_loaderOff();
            });

    };

    function initList() {
        groupeList = new List('groupe-list', options, _groupes);
    };

    function cleanForm() {
        $('#inputIdGroupe').val("");
        $('#inputLibelle').val("");
        //$('#inputContenu').val("");
        //$('#inputLien').val("");
        $('#modalContentGroupe').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdGroupe').val(li.find('.idGroupe').text());
        $('#inputLibelle').val(li.find('.libelle').text());
        $('#modalContentGroupe').find(".key").prop('disabled', true);
        //var ed = tinyMCE.get('inputContenu');
        //ed.setContent(li.find('.contenu').text()); // contenu html
    };

    function _initEvents() {
        btnNewGroupe.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateGroupe", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });

        btnList.on("click",".btnSendGroupe", function(e) {
            e.preventDefault();
            clearForm();
            IHM.validateModal();
            _action = "send";
        });

        btnParametresGroupe.click(function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "send";
        });

        btnList.on("click",".btnDeleteGroupe", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idGroupe = li.find('.idGroupe').text();
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
                        url:  _url + "&action=" + _action + '&idGroupe=' + idGroupe,
                        type: 'POST',
                        data : {
                            idGroupe: idGroupe
                        }
                        //context: document.body
                    })
                    .done(function () {
                        bootbox.alert("Suppression ok.");
                        groupeList.remove({"idGroupe": idGroupe, "libelle": libelle});
                        _getGroupes();
                        modal.hide();
                        //_loaderOff();
                    })
                    .always(function() {
                        //_loaderOff();
                    });

            });
        });

        btnSubmitGroupe.click(function() {
            idGroupe = $('#inputIdGroupe').val();
            libelle = $('#inputLibelle').val();
            objet = $('#inputObjet').val();
            destinataire = $('#inputDestinataire').val();
            idTemplate = $( "#inputSelectTemplate option:selected" ).data('id');
            idGroupe = $('#inputSelectGroupe option:selected').data('id');

            if(libelle == "") {
                bootbox.alert('Libelle est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            //_loaderOn();

            Ajax.now({
                    //csrf: true,
                    url : _url + "&action=" + _action +  ((_action === 'update') ? '&idGroupe=' + idGroupe : ''),
                    type: 'POST',
                    data : {
                        idGroupe : idGroupe,
                        libelleGroupe : libelle,
                        objetGroupe : objet,
                        idTemplate : idTemplate,
                        idGroupe : idGroupe,
                        destinataire : destinataire
                    }
                })
                .done(function(data) {
                    // //_loaderOn();
                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.libelle').text(libelle);
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();

                            //tinyMCE.triggerSave();  //  pour la modification du template
                            //_getGroupes();
                            break;

                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getGroupes();
                            break;

                        case "send":
                            bootbox.alert("Mail envoyé.");
                            modal.hide();
                            ////_loaderOff();
                            break;
                    }

                })
                .always(function() {
                    //_loaderOff();
                });

        });

        btnDisplayGroupe.click(function() {
            idGroupe = $('.hrefDisplayGroupe').data('id');
            //console.log("display groupe : "+idGroupe);

            //$(".afficheGroupe").append("<p>TEST</p>");

            /*Ajax.now({
             //csrf: true,
             url : _url + '&action=read&idGroupe=' + idGroupe,
             type: 'POST',
             data : {
             idGroupe: idGroupe
             }
             })
             .done(function(data) {
             $.("#afficheGroupe").text("TEST");
             });
             */
        });
    };

    return {
        init : function() {
            //initList();
            _getGroupes();
            _initEvents();

            //_getTemplatesAndGroupes();
        }
    };
})();
$(document).ready(Groupe3.init());
