<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Formulaire d'ajout des utilisateurs</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>
<div class="panels">
    <div class="panel panel-info panelFormListUser">
        <!-- href="../Web/index.php?page=addmail&action=create"-->
        <div class="panel-heading"><span><a id="btnAddUser" class="glyphicon glyphicon-plus btnAddUser btnAjouter pull-right" title="Ajouter"></a></span>
            <h3 class="panel-title"><strong>liste des mails</strong></h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal formListUser" id="formListUser" role="form" enctype="multipart/form-data" action="../Web/index.php" method="post">
                <input type="hidden" name="formListMail" value="true">
                <ul id="listUsers" class="list-group">
                    <?php /** @var User $user */
                    foreach($users as $user): ?>
                        <li class="list-group-item selectUser" id="<?php echo $user->getId(); ?>"
                            data-id="<?php echo $user->getId(); ?>"
                            data-mail="<?php echo $user->getMail(); ?>"
                            data-nom="<?php echo $user->getNom(); ?>"
                            data-prenom="<?php echo $user->getPrenom(); ?>"
                            data-telephone="<?php echo $user->getTelephone(); ?>"
                            value="<?php echo $user->getMail(); ?>">
                            <span class="mail"><?php echo $user->getMail(); ?></span>
                            <span><a class="glyphicon glyphicon-trash btnSupprUser btnSupprimer pull-right" id="btnSupprUser" title="Supprimer"></a>
                            <a class="glyphicon glyphicon-pencil btnModifUser btnModifier pull-right" id="btnModifUser" title="Modifier"></a>
                                </span>
                        </li>
                    <?php endforeach ?>
                </ul>
            </form>
        </div>
    </div>

    <div class="panel panel-info panelFormManageUser">
        </br>
        <form class="form-horizontal formActionUser" enctype="multipart/form-data">
            <input type="hidden" class="formActionUser" name="" value="true">
            <div class="form-group">
                <label for="nomuser" class="col-sm-3 control-label"><strong>Nom</strong></label>
                <div class="col-sm-9">
                    <input class="form-control nomUser modalRequired" id="nomUser" value="" name="nomUser" placeholder="Durand" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="prenomUser" class="col-sm-3 control-label"><strong>Prénom</strong></label>
                <div class="col-sm-9">
                    <input class="form-control prenomUser modalRequired" id="prenomUser" name="prenomUser" value="" placeholder="Martin" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="mailUser" class="col-sm-3 control-label"><strong>E-mail</strong></label>
                <div class="col-sm-9">
                    <input class="form-control mailUser modalRequired" id="mailUser" name="mailUser" value="" placeholder="martin.durand@hotmail.fr" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="telUser" class="col-sm-3 control-label"><strong>Téléphone</strong></label>
                <div class="col-sm-9">
                    <input class="form-control telUser" id="telUser" name="mailUser" value="" placeholder="0610203040"">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
        </form>
    </div>

    <div class="panel panel-info panelFormFileAddUsers">
        <!--<div class="panel-heading">
            <h3 class="panel-title">Ajout des utilisateurs</h3>
        </div>
        -->
        <div class="panel-body">
            <form class="form-horizontal addformActionUser" id="addformActionUser" enctype="multipart/form-data">
                <input type="hidden" name="formAddUser" value="true">
                <div class="form-group">
                    <span class="help-block"><strong>Charger un fichier CSV * <br>(respecter le formalisme : nom; prenom; mail; telephone)</strong></span>
                    <label for="upload_file_csv" class="col-sm-3 control-label"></label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control modalRequired" id="upload_file_csv" name="upload_file_csv" size="60">
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../Web/scripts/User.js"></script>