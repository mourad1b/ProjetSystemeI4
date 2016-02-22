<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des groupes</h3>
<br>
<div class="panels">
    <div class="panel panel-info panelFormListGroupe">
        <div class="panel-heading">
            <span><a id="btnAddGroupe" class="glyphicon glyphicon-plus btnAddGroupe btnAjouter pull-right" title="Ajouter"></a></span>
            <h3 class="panel-title">Liste des groupes</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal formListGroupe" id="formListGroupe" role="form" enctype="multipart/form-data" action="../Web/index.php" method="post">
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
        <!--<div class="panel-heading">
            <h3 class="panel-title"><strong>Ajouter un mail</strong></h3>
        </div>-->

        </br>
        <form class="form-horizontal formActionGroupe" enctype="multipart/form-data">
            <input type="hidden" class="formManageGroupe" name="" value="true">
            <div class="form-group">
                <label for="libelleGroupe" class="col-sm-3 control-label"><strong>Libellé Groupe</strong></label>
                <div class="col-sm-8">
                    <input id='inputIdGroupe' class="form-control inputIdGroupe" type="hidden" value=""/>
                    <input class="form-control inputLibelleGroupe modalRequired" id="inputLibelleGroupe" value="" name="inputLibelleGroupe" placeholder="libellé du groupe" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
            <!--<div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="btnCancelGroupe" type="cancel" class="btn btn-default btnCancelMail">Annuler</button>
                    <button name="btnSubmitGroupe" type="submit" class="btn btn-success btnSubmitMail">Ajouter</button>
                </div>
            </div>
            -->
        </form>
    </div>
</div>

<script src="../Web/scripts/Groupe.js">Groupe.init()</script>

