<h3 class="text-center">Formulaire d'ajout des mails </h3>
<br>
<p>
    Visualiser liste des mails ;
</p>
<p><strong>A Faire :</strong> ajouter/modifier les mails
</p>
<div class="panel panel-info">

    <div class="panel-heading"><span><a class="glyphicon glyphicon-plus addMail btnAjouter pull-right" title="Ajouter"></a></span>
        <h3 class="panel-title">Gestion des mails</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal formManageMail" id="formNewsletter" role="form" enctype="multipart/form-data" action="../Web/index.php" method="post">
            <input type="hidden" name="formManageMail" value="true">
            <ul id="listMail" class="list-group">
                <?php /** @var Mail $mail */
                foreach($mails as $mail): ?>
                    <li class="list-group-item" id="idNewsletter" data-id="<?php echo $mail->getId(); ?>"
                        value="<?php echo $mail->getId(); ?>">
                        <span class=""><?php echo $mail->getLibelle(); ?></span>
                        <span><a class="glyphicon glyphicon-trash suppMail btnSupprimer pull-right" title="Supprimer"></a>
                        <a class="glyphicon glyphicon-pencil modifMail btnModifier pull-right" title="Modifier"></a>
                            </span>
                    </li>

                <?php endforeach ?>
            </ul>
        </form>
    </div>

    <!--
    <div class="panel-heading addNewMail">
        <h3 class="panel-title">Ajout des mails</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data" action="index.php" method="post">
            <input type="hidden" name="formAddMail" value="true">
            <div class="form-group">
                <label for="libeleMail" class="col-sm-2 control-label"><strong>Nom du mail</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="libeleMail" placeholder="Nom du mail">
                </div>
            </div>
            <div class="form-group">
                <label for="objetMail" class="col-sm-2 control-label"><strong>Objet</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="objetMail" placeholder="Objet du mail">
                </div>
            </div>
            <div class="form-group">
                <label for="corpsMail" class="col-sm-2 control-label"><strong>Corps</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="corpsMail" placeholder="Corps du mail">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                    <button type="submit" class="btn btn success">Soumettre</button>
                </div>
            </div>
        </form>
    </div>
    -->
</div>