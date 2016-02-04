<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Formulaire d'ajout des mails </h3>
<br>
<p>
    Visualiser liste des mails ;
</p>
<p><strong>A Faire :</strong> ajouter/modifier les mails
</p>
<div class="panels">
    <div class="panel panel-info panelFormListMail">
        <!-- href="../Web/index.php?page=addmail&action=create"-->
        <div class="panel-heading"><span><a id="btnAddMail" class="glyphicon glyphicon-plus btnAddMail btnAjouter pull-right" title="Ajouter"></a></span>
            <h3 class="panel-title"><strong>liste des mails</strong></h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal formListMail" id="formListMail" role="form" enctype="multipart/form-data" action="../Web/index.php" method="post">
                <input type="hidden" name="formListMail" value="true">
                <ul id="listMail" class="list-group">
                    <?php /** @var Mail $mail */
                    foreach($mails as $mail): ?>
                        <li class="list-group-item selectMail" id="<?php echo $mail->getId(); ?>"
                            data-id="<?php echo $mail->getId(); ?>" value="<?php echo $mail->getLibelle(); ?>">
                            <span class=""><?php echo $mail->getLibelle(); ?></span>
                            <span><a class="glyphicon glyphicon-trash btnSupprMail btnSupprimer pull-right" id="btnSupprMail" title="Supprimer"></a>
                            <a class="glyphicon glyphicon-pencil btnModifMail btnModifier pull-right" id="btnModifMail" title="Modifier"></a>
                                </span>
                        </li>
                    <?php endforeach ?>
                </ul>
            </form>
        </div>
    </div>

    <div class="panel panel-info panelFormManageMail">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Ajouter un mail</strong></h3>
        </div>

        </br>
        <form class="form-horizontal formActionMail" enctype="multipart/form-data" action="" method="post">
            <input type="hidden" class="formManageMail" name="" value="true">
            <div class="form-group">
                <label for="libelleMail" class="col-sm-2 control-label"><strong>Nom du mail</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control libelleMail" id="libelleMail" name="libelleMail" value="" placeholder="Nom du mail" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="objetMail" class="col-sm-2 control-label"><strong>Objet</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control objetMail" id="objetMail" name="objetMail" value="" placeholder="Objet du mail" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="corpsMail" class="col-sm-2 control-label"><strong>Corps</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control corpsMail" id="corpsMail" name="corpsMail" value="" placeholder="Corps du mail" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <!--<button name="btnCancelMail" type="cancel" class="btn btn-default btnCancelMail">Annuler</button>-->
                    <button name="btnSubmitMail" type="submit" class="btn btn-success btnSubmitMail">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script type="text/javascript">
    $(function() {

        var idSelectMail;
        var selectMail = $('.selectMail');
        var panelFormManageMail = $('.panelFormManageMail');
        var formManageMail = $('.formManageMail');
        var formActionMail = $('.formActionMail');

        var loadingImg = $('#loading-img');

        panelFormManageMail.hide();
        loadingImg.hide();
        var btnAddMail = $(".btnAddMail");
        var btnModifMail = $(".btnModifMail");

        var btnSupprMail = $(".btnSupprMail");
        var btnSubmitMail = $('.btnSubmitMail');
        var btnCancelMail = $('.btnCancelMail');

        var libelle = $('.libelleMail').val();
        var objet = $('.objetMail').val();
        var corps = $('.corpsMail').val();

        function fillForm() {
            li = $('.fillSource');
            $('#libelle').val(li.find('.libelle').text());
            $('#objet').val(li.find('.objet').text());
            $('#corps').val(li.find('.corps').text());
        };

        btnCancelMail.click(function (e) {
            e.stopPropagation();
            panelFormManageMail.hide();
        });

        btnSupprMail.click(function (e) {
            e.stopPropagation();

            idSelectMail = selectMail.data('id');
            var url = "../Web/index.php?page=addmail&action=delete&idMail="+idSelectMail;


            //console.log(idSelectMail);
            /*$.post(url, {
             idSelectMail: idSelectMail})
             .done(function (data) {
             console.log(data);


             loadingImg.hide();
             });
             */


        });

        btnAddMail.click(function (e) {
            e.stopPropagation();

            //action formulaure : Add
            formManageMail.attr('name', 'formAddMail');
            formActionMail.attr('action', '../Web/index.php?page=addmail');
            panelFormManageMail.show();

            btnSubmitMail.click(function (e) {
                e.stopPropagation();
                var url = "../Web/index.php?page=addmail&action=create";

                loadingImg.show();
                var dataMail = {
                    libelle : libelle,
                    objet : objet,
                    corps : corps
                }
                console.log(dataMail);
                $.post(url, dataMail)
                 .done(function (data) {
                    console.log(data);

                    panelFormManageMail.hide();
                    loadingImg.hide();

                 });
            });
        });

        btnModifMail.click(function (e) {
            e.stopPropagation();

            //action formulaure : modif
            formManageMail.attr('name', 'formUpdateMail');
            formActionMail.attr('action', '../Web/index.php?page=addmail');
            panelFormManageMail.show();

            btnSubmitMail.click(function (e) {
                e.stopPropagation();
                var url = "../Web/index.php?page=addmail&action=update";

                loadingImg.show();
                var dataMail = {
                    libelle : libelle,
                    objet : objet,
                    corps : corps
                }
                console.log(dataMail);
                $.post(url, dataMail)
                    .done(function (data) {
                        console.log(data);

                        panelFormManageMail.hide();
                        loadingImg.hide();

                    });
            });

        });
    });
</script>