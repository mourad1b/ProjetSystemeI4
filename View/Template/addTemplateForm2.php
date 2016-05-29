<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des templates</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="template-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelle">Tri par Libellé</button>
            <button id="btnNewTemplate" class="btn btn-warning btnNewTemplate" data-toggle="modal" data-target="#modal">Nouveau</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idTemplate col-md-1">Id</div>
                    <div class="libelle col-md-3">Libellé</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentTemplate" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Gestion des Templates</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionTemplate" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputIdTemplate" class="col-sm-2 control-label"><strong>Numéro</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdTemplate' class="form-control inputIdTemplate key" value=""/>
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
                        <label for="inputContenu" class="col-sm-2 control-label"><strong>Contenu<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputContenu modalRequired" id="inputContenu" name="inputContenu" value=""  onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitTemplate buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>

<script src="../Web/scripts/TemplateManager.js"></script>
<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/Example.js"></script>
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
