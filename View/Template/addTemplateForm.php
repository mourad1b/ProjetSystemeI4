<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Templates</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<!--<div id="fh5co-main">
    <div class="fh5co-cards">
        <div class="container-fluid">
            <div class="row animate-box">
            </div>
            <div class="row">
                < ?php /* * @var \nsNewsletter\Model\Newsletter $newsletter */
                //foreach($newsletters as $newsletter): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box ">
                        <a class="fh5co-card" href="#">
                            <img src="" alt="< ?php echo $newsletter->getNom(); ?>" class="img-responsive" style="text-align: center">
                            <div class="fh5co-card-body" style="height: 300px">
                                <input class="dataTemplate" id="dataTemplate" data-id="< ?php echo $newsletter->getId(); ?>"  hidden />
                                < ?php echo $newsletter->getTexte(); ?>
                            </div>
                        </a>
                    </div>
                < ?php endforeach; ?>
            </div>
        </div>
    </div>
<!--</div>-->

<div class="fh5co-cards">
    <div class="container-fluid">
        <div class="row animate-box">
            <div class="row">
                <!--
                <div class="list list-unstyled"></div>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box ">
                    <a class="fh5co-card" href="#">
                        <img src="" alt="" class="img-responsive" style="text-align: center">
                        <div class="fh5co-card-body bodyHtmlTemplate" style="height: 300px"></div>
                    </a>
                </div>
                -->
                <div  class="list list-unstyled" id="bodyHtmlContenuTemplate"></div>
            </div>
        </div>
    </div>
</div>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentTemplate" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editer ce template</h4>
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
                        <label for="inputNom" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id="inputNom" class="form-control inputNom modalRequired" name="inputNom" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputContenu" class="col-sm-2 control-label"><strong>Contenu<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control inputContenu " id="inputContenu" name="inputContenu" value=""></textarea>

                            <!--                            <input class="form-control inputContenu modalRequired" id="inputContenu" name="inputContenu" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">-->
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div
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


<!-- JS -->
<script src="../Web/scripts/Template.js"></script>
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
<!-- jQuery -->
<script src="../Web/js/jsTemplates/jquery-1.10.2.min.js"></script>
<!-- jQuery Easing -->
<script src="../Web/js/jsTemplates/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="../Web/js/jsTemplates/bootstrap.js"></script>
<!-- Owl carousel -->
<script src="../Web/js/jsTemplates/owl.carousel.min.js"></script>
<!-- Magnific Popup -->
<script src="../Web/js/jsTemplates/jquery.magnific-popup.min.js"></script>
<!-- Superfish -->
<script src="../Web/js/jsTemplates/hoverIntent.js"></script>
<script src="../Web/js/jsTemplates/superfish.js"></script>
<!-- Easy Responsive Tabs -->
<script src="../Web/js/jsTemplates/easyResponsiveTabs.js"></script>
<!-- FastClick for Mobile/Tablets -->
<script src="../Web/js/jsTemplates/fastclick.js"></script>
<!-- Waypoints -->
<script src="../Web/js/jsTemplates/jquery.waypoints.min.js"></script>
<!-- Main JS -->
<script src="../Web/js/jsTemplates//main.js"></script>