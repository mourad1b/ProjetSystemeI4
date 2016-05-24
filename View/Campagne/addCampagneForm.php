<h3 class="text-center">Campagnes</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="campagne-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelle">Tri par Nom</button>
            <button id="btnNewCampagne" class="btn btn-warning btnNewCampagne" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnSendMailCampagne" class="btn btn-primary btnSendMailCampagne" data-toggle="modal" data-target="#modal">Envoyer par mail</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idCampagne col-md-3">Id</div>
                    <div class="libelle col-md-6">Libelle</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>


<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentCampagne" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Campagnes - Envoi par mail</h4>
            </div>
            <div class="loader text-center" id="loaderr" style="display: none">
                <img src="../Web/styles/img/loading-img.gif" alt="loading">
                <br><span>Chargement des données...</span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionCampagne" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputIdCampagne" class="col-sm-2 control-label"><strong>Numéro</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdCampagne' class="form-control inputIdCampagne key" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLibelle" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id="inputLibelle" class="form-control inputLibelle modalRequired" name="inputLibelle" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputObjet" class="col-sm-2 control-label"><strong>Objet</strong></label>
                        <div class="col-sm-9">
                            <input id="inputObjet" class="form-control inputObjet" name="inputObjet" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDestinataire" class="col-sm-2 control-label"><strong>Destinataire</strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputDestinataire" id="inputDestinataire" name="inputDestinataire" value=""">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTemplate" class="col-sm-2 control-label"><strong>Template<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="form-control inputSelectTemplate " id="inputSelectTemplate" name="inputSelectTemplate" value="">
                                <option></option>
                            </select>
                            <!--modalRequired onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback " title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                            -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputGroupe" class="col-sm-2 control-label"><strong>Groupe<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="form-control inputSelectGroupe" id="inputSelectGroupe" name="inputSelectGroupe">
                                <option></option>
                            </select>
                            <!--modalRequired onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                            -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitCampagne buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>


<!-- JS -->
<script src="../Web/scripts/Campagne.js"></script>
</script>
<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/Example.js"></script>
<!-- tinymce
<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
-->
<script src='../Web/tinymce/tinymce.min.js'></script>

<script type="text/javascript">
    /*tinymce.init({
     selector: 'textarea',  // change this value according to your HTML
     plugins : 'advlist autolink link image lists charmap print preview',
     });*/

    tinymce.init({
        selector: "textarea",
        height: 400,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',
        imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],

        style_formats: [{
            title: 'Bold text',
            inline: 'b'
        }, {
            title: 'Red text',
            inline: 'span',
            styles: {
                color: '#ff0000'
            }
        }, {
            title: 'Red header',
            block: 'h1',
            styles: {
                color: '#ff0000'
            }
        }, {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
        }, {
            title: 'Example 2',
            inline: 'span',
            classes: 'example2'
        }, {
            title: 'Table styles'
        }, {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
        }],

        templates: [{
            title: 'Test template 1',
            content: 'TA simple table to play with'
        }, {
            title: 'Test template 2',
            content: 'TinyMCE Logo Welcome to the TinyMCE editor demo!'

        }],
        /*content_css: [
         '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
         '//www.tinymce.com/css/codepen.min.css'
         ]*/

    });


</script>