var Newsletter = (function() {
    var options = {
        /*item: '<li class="row"><div class="idNewsletter col-md-1"></div><div class="nom col-md-3"></div>' +
         '<div class="contenu col-md-4"></div><div class="lien col-md-3"></div><div class="col-md-1 text-right">' +
         '<button class="btnUpdateNewsletter btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>' +
         '<button id="btnDeleteNewsletter" class="btnDeleteNewsletter btn btn-info btn-xs">Supprimer</button></div></li>'
         */
        item: '<div class="col-lg-3 col-md-6 col-sm-6 animate-box bodyHtmlNewsletter"><a class="fh5co-card" href="#"> ' +
        '<img src="" alt="" class="img-responsive" style="text-align: center">' +
        '<div class="fh5co-card-body" style="height: 300px"></div> ' +
        '<button class="btnUpdateNewsletter btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Utiliser</button></a></div>'
    };

    var _newsletters, newsletterList, li, idNewsletter, nom, contenu, lien;
    var _urlNewsletters = "../Web/index.php?page=templates";
    var _urlNewsletters = "../Web/index.php?page=newsletters";

    var _action;
    var modal = $('#modal');
    var modalNewsletter =$('#modalNewsletter');
    var btnSubmitNewsletter = $('.btnSubmitNewsletter');
    var btnUpdateNewsletter = $('.btnUpdateNewsletter');
    var btnNewNewsletter = $('.btnNewNewsletter');
    var btnList = $(".list");
    var _templates;

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

   /* function _getNewsletters() {
        _loaderOn();
        $.ajax({
                url : _urlNewsletters + "&action=list",
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
                _loaderOff();
            })
            .always(function(){
                _loaderOff();
            });
    };*/

    function _getNewsletters() {
        var contenuNewsletter = null;
        _loaderOn();
        $.ajax({
                url : _urlNewsletters + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","nom":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _newsletters = jQuery.parseJSON(data);

                $.each(_newsletters, function (key, value) {

                    //((value.idNewsletter == idNewsletter) && (_action =="update")) ? console.log("update append"): console.log("not");

                    contenuNewsletter = '<div class="col-lg-3 col-md-6 col-sm-6 animate-box "> <a class="fh5co-card" href="#"> '
                        + '<img src="" alt="'+ value.nom+'" class="img-responsive" style="text-align: center"> '
                        + '<div class="fh5co-card-body bodyHtmlNewsletter"  style="height: 300px"> '
                        + value.contenu + '</div>'
                        + '<button class="btnUpdateNewsletter btn btn-info btn-xs" data-id="'+ value.idNewsletter + '" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil" title="Modifier" aria-hidden="true"></span>modifier</button>'
                        + '<button class="btnDeleteNewsletter btn btn-danger btn-xs" data-id="'+ value.idNewsletter + '"><span class="glyphicon glyphicon-trash" title="Supprimer" aria-hidden="true"></span>supprimer</button></a></div>';

                    if(_action !=="create" && _action !== "update" && _action !== "delete"){
                        $("#bodyHtmlContenuNewsletter").append(contenuNewsletter);
                    }

                    if((_action =="create") && key == 0){
                        $("#bodyHtmlContenuNewsletter").append(contenuNewsletter);
                    }

                    //((value.idNewsletter == idNewsletter) && (_action =="update"))   : "" ;
                    if((value.idNewsletter == idNewsletter) && (_action =="update")){
                        /*contenuNewsletter = '<div class="col-lg-3 col-md-6 col-sm-6 animate-box "> <a class="fh5co-card" href="#"> '
                            + '<img src="" alt="'+ value.nom+'" class="img-responsive" style="text-align: center"> '
                            + '<div class="fh5co-card-body bodyHtmlNewsletter"  style="height: 300px"> '
                            + value.contenu + '</div>'
                            + '<button class="btnUpdateNewsletter btn btn-info" data-id="'+ value.idNewsletter + '" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil" title="Modifier" aria-hidden="true"></span></button>'
                            + '<button class="btnDeleteNewsletter btn btn-danger" data-id="'+ value.idNewsletter + '"><span class="glyphicon glyphicon-trash" title="Supprimer" aria-hidden="true"></span></button></a></div>';
                        */
                        $('#inputIdNewsletter').val(value.idNewsletter);
                        $('#inputNom').val(value.nom);

                        $('textarea#inputContenu').val(value.contenu);
                        var ed = tinyMCE.get('inputContenu');
                        ed.setContent(value.contenu); // contenu html


                        var itemtoRemove = key;
                        //_newsletters.splice($.inArray(itemtoRemove, _newsletters),1);
                        //console.log(_newsletters.splice($.inArray(key, _newsletters),1));

                        $("#bodyHtmlContenuNewsletter").append(contenuNewsletter);
                        //($(".btnUpdateNewsletter").data('id') == idNewsletter) ? console.log($(this).data) : console.log("false");
                    }

                });

                _loaderOff();
            })
            .always(function(){
                _loaderOff();
            });
    };


    function initList() {
        newsletterList = new List('newsletter-list', options, _newsletters);
    };

    function cleanForm() {
        $('#inputIdNewsletter').val("");
        $('#inputNom').val("");
        $('#inputContenu').val("");
        $('textarea#inputContenu').val("");
        var ed = tinyMCE.get('inputContenu');
        ed.setContent("");
        $('#inputLien').val("");
        $('#modalContentNewsletter').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdNewsletter').val(li.find('.idNewsletter').text());
        $('#inputNom').val(li.find('.nom').text());
        $('textarea#inputContenu').val(li.find('.contenu').text());
        $('#inputLien').val(li.find('.lien').text());
        $('#modalContentNewsletter').find(".key").prop('disabled', true);
        var ed = tinyMCE.get('inputContenu');
        //ed.setContent(li.find('.contenu').text()); // contenu html
    };

    function _initEvents() {

        btnNewNewsletter.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        /*btnList.on("click",".btnUpdateNewsletter", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });
        */

        btnList.on("click",".btnDeleteNewsletter", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            //idNewsletter = li.find('.idNewsletter').text();
            idNewsletter = $(this).data('id');

            //console.log(idNewsletter);
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            var $listItem= $(e.target);         // liste des DIV template
            var dataId = $listItem.data('id');  // id template
            //console.log(dataId +" " + idNewsletter);
            //console.log($listItem.parent().parent());

            modal.on('click', '.btn-primary', function () {
                // $listItem.parent().parent().parent().prop('className')
                _loaderOn();
                $.ajax({
                        url:  _urlNewsletters + "&action=" + _action + '&idNewsletter=' + idNewsletter,
                        type: 'POST',
                        data : {
                            idNewsletter: idNewsletter
                        }
                        //context: document.body
                    })
                    .done(function () {
                        bootbox.alert("Suppression ok.");
                        modal.hide();
                        //if(idNewsletter == dataId){
                            $listItem.parent().parent().remove();
                        //}

                        _getNewsletters();
                        _loaderOff();
                    })
                    .always(function(){
                        _loaderOff();
                    });
            });
        });

        var $listItem;
        var dataId ;
        btnList.on("click",".btnUpdateNewsletter", function(e) {
            e.preventDefault();
            idNewsletter = $(this).data('id');
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            $.each( _newsletters, function( key, value ) {
                if(value.idNewsletter == idNewsletter){
                    $('#inputIdNewsletter').val(value.idNewsletter);
                    $('#inputNom').val(value.nom);
                    $('textarea#inputContenu').val(value.contenu);
                    var ed = tinyMCE.get('inputContenu');
                    ed.setContent(value.contenu); // contenu html
                }
            });

            $listItem = $(e.target);         // liste des DIV template
            dataId = $listItem.data('id');  // id template

            //console.log(dataId);

            IHM.validateModal();
            _action = "update";
        });

        btnSubmitNewsletter.click(function() {
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

            _loaderOn();
            Ajax.now({
                    //csrf: true,
                    url : _urlNewsletters + "&action=" + _action +  ((_action === 'create') ? '&idNewsletter=' + idNewsletter : ''),
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

                            $('#inputNom').text(nom);
                            $("textarea#inputContenu").text(contenu);

                            tinyMCE.triggerSave();  //  pour la modification du template

                            bootbox.alert("Mise à jour ok.");
                            modal.hide();
                            _getNewsletters();
                            break;

                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getNewsletters();
                            break;
                    }
                    _loaderOff();
                })
                .always(function(){
                    _loaderOff();
                });
        });

    };



    function _editmodal() {
        var bodyHtmlNewsletter = $('.bodyHtmlNewsletter');
        bodyHtmlNewsletter.click(function (e) {
            var idNewsletter = $('.btnUpdateIdNewsletter').data('id');
            //$('#dataNewsletter').data('id');
            //_getNewsletters();

            _loaderOn();
            $.ajax({
                    url: "../Web/index.php?page=newsletters" + "&action=list",
                    type: 'POST'
                })
                .done(function (data) {
                    _templates = jQuery.parseJSON(data);
                    /*$.each(_templates, function (key, value) {
                     console.log(value.idNewsletter);
                     if (value.idNewsletter == idNewsletter) {
                     console.log("clic : " +value.idNewsletter);

                     }
                     });
                     */
                    _loaderOff();
                })
                .always(function(){
                    _loaderOff();
                });
        });
    };


    return {
        init : function() {
            _getNewsletters();
            //_getNewsletters();
            _initEvents();
            //_editmodal();
        },

        editmodal: function() {
            _editmodal();
        }
    };
})();
$(document).ready(Newsletter.init());
