var Campagne = (function() {
    var options = {
        item: '<li class="row"><div class="idCampagne col-md-3"></div><div class="libelle col-md-6"></div>'
        //+ '<div class="contenu col-md-4"></div><div class="lien col-md-3"></div><div class="col-md-1 text-right">'
        + '<button class="btnUpdateCampagne btn btn-info btn-xs" data-toggle="modal" data-target="#modal">Modifier</button>'
        + '<button id="btnDeleteCampagne" class="btnDeleteCampagne btn btn-info btn-xs">Supprimer</button></div></li>'
    };

    var _campagnes, campagneList, li, idCampagne, libelle, contenu, lien;
    var _url = "../Web/index.php?page=campagnes";

    var _action;
    var modal = $('#modal');
    var btnSubmitCampagne = $('.btnSubmitCampagne');
    var btnUpdateCampagne = $('.btnUpdateCampagne');
    var btnNewCampagne = $('.btnNewCampagne');
    var btnList = $(".list");

    function _getCampagnes() {
        $.ajax({
                url : _url + "&action=list",
                type: 'POST'
            })
            .done(function(data) {
                //data = [{"id":"2","libelle":"BEN","prenom":"Mourad","mail":"mourad_ben@test.com"}, {"id":"3","nom":"Loue","prenom":"Arnauld","mail":"Ar.loue@test.net"},{"id":"5","nom":"toto","prenom":"titi","mail":"toto.titi@test-auth.fr"}];
                _campagnes = jQuery.parseJSON(data);
                //var ed = tinyMCE.get('inputContenu');
                //ed.setContent(value.contenu); // contenu html

                if(_action =="create"){
                    $.each( _campagnes, function( key, value ) {
                        if(key == (_campagnes.length-1)){
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
                            campagneList.add({idCampagne: value.idCampagne, libelle: value.libelle});
                        }
                    });
                }
                console.log(_campagnes);
                initList();
            });
    };

    function initList() {
        campagneList = new List('campagne-list', options, _campagnes);
    };

    function cleanForm() {
        $('#inputIdCampagne').val("");
        $('#inputLibelle').val("");
        //$('#inputContenu').val("");
        //$('#inputLien').val("");
        $('#modalContentCampagne').find(".key").prop('disabled', true);
    };

    function fillForm() {
        li = $('.fillSource');
        $('#inputIdCampagne').val(li.find('.idCampagne').text());
        $('#inputLibelle').val(li.find('.libelle').text());
        $('#modalContentCampagne').find(".key").prop('disabled', true);
        //var ed = tinyMCE.get('inputContenu');
        //ed.setContent(li.find('.contenu').text()); // contenu html
    };

    function _initEvents() {
        btnNewCampagne.click(function (e) {
            e.preventDefault();
            cleanForm();
            IHM.validateModal();
            _action = "create";
        });

        btnList.on("click",".btnUpdateCampagne", function(e) {
            e.preventDefault();
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            fillForm();
            IHM.validateModal();
            _action = "update";
        });

        btnList.on("click",".btnDeleteCampagne", function(e) {
            e.preventDefault();
            //var contentPanelId = $(e.target)[0].id;
            //console.log(contentPanelId);
            $("li.fillSource").removeClass('fillSource');
            $(this).closest("li.row").addClass('fillSource');
            li = $('.fillSource');
            _action = "delete";
            idCampagne = li.find('.idCampagne').text();
            var modal = bootbox.confirm({
                //title: "Suppression du mail "+nomSelectUser,
                message: "Êtes-vous sûr ?",
                callback: function (result) {
                    //Example.show("Hello");
                }
            });

            modal.on('click', '.btn-primary', function () {
                $.ajax({
                        url:  _url + "&action=" + _action + '&idCampagne=' + idCampagne,
                        type: 'POST',
                        data : {
                            idCampagne: idCampagne
                        }
                        //context: document.body
                    })
                    .done(function () {
                        bootbox.alert("Suppression ok.");
                        modal.hide();
                        campagneList.remove({"idCampagne": idCampagne, "libelleCampagne": libelle});
                        _getCampagnes();
                    });
            });
        });

        btnSubmitCampagne.click(function() {
            //tinyMCE.triggerSave(); //  pour la creation de template
            idCampagne = $('#inputIdCampagne').val();
            libelle = $('#inputLibelle').val();
            //tinyMCE.triggerSave();  //  pour la modification du template

            if(libelle == "") {
                bootbox.alert('Libelle est obligatoire !');
                //cleanForm();
                IHM.validateModal();
                return "";
            }

            Ajax.now({
                    //csrf: true,
                    url : _url + "&action=" + _action +  ((_action === 'update') ? '&idCampagne=' + idCampagne : ''),
                    type: 'POST',
                    data : {
                        idCampagne: idCampagne,
                        libelleCampagne: libelle
                    }
                })
                .done(function(data) {
                    switch(_action) {
                        case "update":
                            var li = $('.fillSource');
                            li.find('.libelle').text(libelle);
                            bootbox.alert("Mise à jour ok.");
                            modal.hide();

                            //tinyMCE.triggerSave();  //  pour la modification du template
                            //_getCampagnes();
                            break;

                        case "create":
                            bootbox.alert("Enregistrement ok.");
                            modal.hide();
                            _getCampagnes();
                            break;
                    }
                });
        });

    };

    return {
        init : function() {
            //initList();
            _getCampagnes();
            _initEvents();
        }
    };
})();
$(document).ready(Campagne.init());
