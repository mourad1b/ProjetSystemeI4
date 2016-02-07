<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Formulaire d'ajout des mails </h3>
<br>
<div id="flashMessage" class="alert hidden"></div>
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
                            data-id="<?php echo $mail->getId(); ?>"
                            data-libelle="<?php echo $mail->getLibelle(); ?>"
                            data-objet="<?php echo $mail->getObjet(); ?>"
                            data-body="<?php echo $mail->getBody(); ?>"
                            value="<?php echo $mail->getLibelle(); ?>">
                            <span class="libelle"><?php echo $mail->getLibelle(); ?></span>
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
        <!--<div class="panel-heading">
            <h3 class="panel-title"><strong>Ajouter un mail</strong></h3>
        </div>-->

        </br>
        <form class="form-horizontal formActionMail" enctype="multipart/form-data">
            <input type="hidden" class="formManageMail" name="" value="true">
            <div class="form-group">
                <label for="libelleMail" class="col-sm-3 control-label"><strong>Nom du mail</strong></label>
                <div class="col-sm-9">
                    <input class="form-control libelleMail modalRequired" id="libelleMail" value="" name="libelleMail" placeholder="libellé du mail" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="objetMail" class="col-sm-3 control-label"><strong>Objet</strong></label>
                <div class="col-sm-9">
                    <input class="form-control objetMail modalRequired" id="objetMail" name="objetMail" value="" placeholder="objet du mail" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="corpsMail" class="col-sm-3 control-label"><strong>Corps</strong></label>
                <div class="col-sm-9">
                    <input class="form-control corpsMail modalRequired" id="corpsMail" name="corpsMail" value="" placeholder="corps du mail" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <!--<div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="btnCancelMail" type="cancel" class="btn btn-default btnCancelMail">Annuler</button>
                    <button name="btnSubmitMail" type="submit" class="btn btn-success btnSubmitMail">Ajouter</button>
                </div>
            </div>
            -->
        </form>
    </div>
</div>



<script src="../Web/scripts/Mail.js"></script>
<!--<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/IHM.js"></script>
-->
<!--
<script> $(function() { Mail(); });
</script>
-->