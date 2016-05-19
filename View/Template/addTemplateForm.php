<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Templates</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<!--<div id="fh5co-main">
-->    <div class="fh5co-cards">
        <div class="container-fluid">
            <div class="row animate-box">
                <!--<div class="col-md-12 heading text-center"><h3>Templates</h3></div>-->
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <!--<img src="../Web/images/img_large_1.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        --><div class="fh5co-card-body">
                            <!--<!DOCTYPE html> <html> <head> </head> <body>-->
                            <p><strong>Bonjour,</strong></p> <p>&nbsp;</p> <p><strong>Test Affichage des templates HTML</strong></p> <p>&nbsp;</p> <p><strong><img src="tinymce/plugins/emoticons/img/smiley-cool.gif" alt="cool" />&nbsp;<img src="tinymce/plugins/emoticons/img/smiley-wink.gif" alt="wink" />&nbsp;</strong></p> <p>&nbsp;</p> <p><strong>Cordialement,</strong></p> <p>&nbsp;</p> <p><strong>MB</strong></p>
                            <!--</body> </html>     -->
                            </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <img src="../Web/images/img_large_2.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        <div class="fh5co-card-body">
                            <h3>User Experience</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt porro delectus cum officia magnam.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <img src="../Web/images/img_large_2.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        <div class="fh5co-card-body">
                            <h3>User Experience</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt porro delectus cum officia magnam.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <!--<img src="../Web/images/img_large_1.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        -->
                        <div class="fh5co-card-body">
                            <!--<!DOCTYPE html> <html> <head> </head> <body>-->
                            <p><strong>Bonjour,</strong></p> <p>&nbsp;</p> <p><strong>Test Affichage des templates HTML</strong></p> <p>&nbsp;</p> <p><strong><img src="tinymce/plugins/emoticons/img/smiley-cool.gif" alt="cool" />&nbsp;<img src="tinymce/plugins/emoticons/img/smiley-wink.gif" alt="wink" />&nbsp;</strong></p> <p>&nbsp;</p> <p><strong>Cordialement,</strong></p> <p>&nbsp;</p> <p>MB</p>
                            <!--</body> </html>     -->
                            <h3>Template 3</h3>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <img src="../Web/images/img_large_3.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        <div class="fh5co-card-body">
                            <h3>Web Analyst</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt porro delectus cum officia magnam.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <img src="../Web/images/img_large_3.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        <div class="fh5co-card-body">
                            <h3>Web Analyst</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt porro delectus cum officia magnam.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
                    <a class="fh5co-card" href="#">
                        <img src="../Web/images/img_large_3.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
                        <div class="fh5co-card-body">
                            <h3>Web Analyst</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sunt porro delectus cum officia magnam.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
-->



<!-- JS -->
<script src="../Web/scripts/Template.js"></script>
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
<!-- Parallax -->
<script src="../Web/js/jsTemplates/jquery.parallax-scroll.min.js"></script>
<!-- Waypoints -->
<script src="../Web/js/jsTemplates/jquery.waypoints.min.js"></script>
<!-- Main JS -->
<script src="../Web/js/jsTemplates//main.js"></script>