<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des groupes</h3>

<div class="panels">
    <div class="panel panel-info panelFormListGroupe">
        <div class="panel-heading">
            <span><a id="btnAddNewGroupe" class="glyphicon glyphicon-plus btnAddNewGroupe btnAjouter pull-right" title="Ajouter"></a></span>
            <h3 class="panel-title">Liste des groupes</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal formListGroupe" id="formListGroupe" role="form" enctype="multipart/form-data">
                <input type="hidden" name="formListGroupe" value="true">
                <div id="groupe-list">
                    <ul id="listGroupe" class="listGroupe list list-unstyled">
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <?php /* ** @var Groupe $groupe */
    /*foreach($groupesCount as $groupe): ?>
        <?php //if($user->getIdGroupe() == $groupe->getId()): ?>
        <li class="list-group-item selectGroupe" id="<?php echo $groupe->getId(); ?>"
            data-id="<?php echo $groupe->getId(); ?>"
            data-libelle="<?php echo $groupe->getLibelle(); ?>"
            value="<?php echo $groupe->getLibelle(); ?>">
            <span class=""><?php echo $groupe->getLibelle(); ?></span>
            <span>
                <a class="glyphicon glyphicon-trash btnSupprGroupe btnSupprimer  pull-right" title="Supprimer"></a>
                <a class="glyphicon glyphicon-pencil  pull-right btnModifGroupe btnModifier" title="Modifier"></a>
            </span>
        </li>
    <?php endforeach*/ ?>

    <div class="panel panel-info panelFormManageGroupe">
        </br>
        <form class="form-horizontal" enctype="multipart/form-data">
            <!--<div class="form-group">
                <label for="inputIdGroupe" class="col-sm-3 control-label"><strong>Numéro</strong></label>
                <div class="col-sm-8">
                    <input id='inputIdGroupe' class="form-control inputIdGroupe key" value=""/>
                </div>
            </div>-->
            <div class="form-group">
                <label for="libelleGroupe" class="col-sm-3 control-label"><strong>Libellé Groupe</strong></label>
                <div class="col-sm-8">
                    <input class="form-control inputLibelleGroupe modalRequired" id="inputLibelleGroupe" value="" name="inputLibelleGroupe" placeholder="libellé du groupe" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
        </form>
    </div>

    <div class="panel panel-info panelFormFileAddUserGroupe">
        <!--<div class="panel-heading">
            <h3 class="panel-title">Ajout des utilisateurs</h3>
        </div>
        -->
        <div class="panel-body">
            <div class="form-group">
                <!--<label for="choixSelectUser" class="col-sm-2 control-label"><strong>Utilisateurs</strong></label>-->
                <div class="">
                    <select multiple="multiple" class="form-control choixSelectUser modalRequired" onchange="IHM.validateModal()">
                        <option value="1">test1@test.fr</option>
                        <option value="2">Mourad_b@gmail.com</option>
                        <option value="12">durand.matin@epsi.fr</option>
                        <option value="2">ar_loue@gmail.com</option>
                        <option value="2">epsi_mtp@gmail.com</option>
                    </select>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <!--<form id="formFile" type="file" role="form" name="formFile" class="form addFile" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="help-block">Charger un fichier CSV * <br>(respecter le formalisme suivant : <strong>nom; prenom; mail; telephone</strong>)</span>
                    <label for="upload_file_csv" class="col-sm-3 control-label"></label>
                    <div class="col-sm-13">
                        <input type="file" class="form-control upload_file_csv modalRequired" id="upload_file_csv" name="upload_file_csv" size="60">
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                    </div>
                </div>
            </form>-->
        </div>
    </div>

</div>
<script>
    //$('select').multipleSelect();
    //filter: true
</script>

