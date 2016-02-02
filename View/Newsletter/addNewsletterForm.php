<h3 class="text-center">Gestion des newsletters</h3>
<br>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion des newsletters</h3>
    </div>
    <div class="panel-body">
        <ul id="listGroupe" class="list-group">
            <?php /** @var Newsletter $newsletter */
            foreach($newsletters as $newsletter): ?>
                <li class="list-group-item" id="<?php echo $newsletter->getId(); ?>" data-id="<?php echo $newsletter->getId(); ?>" value="<?php echo $newsletter->getId(); ?>">
                    <span class=""><?php echo $newsletter->getNom(); ?></span>
                    <span><a href="" class="glyphicon glyphicon-trash btnSupprimer pull-right" title="Modifier"></a>
                    <a href="" class="glyphicon glyphicon-pencil btnModifier pull-right" title="Supprimer"></a>
                        </span>
                </li>

            <?php endforeach ?>
        </ul>
    </div>
</div>

<div class="form-group">
    <label for="libelle" class="col-sm-2 control-label">
        <strong>Newsletters</strong></label>
</div>
<select id="selectGroupe" class="col-sm-6">
    <option hidden="hidden">Sélectionner</option>
    <?php /** @var Newsletter $newsletter */
    foreach($newsletters as $newsletter): ?>
    <option id="<?php echo $newsletter->getId(); ?>" value="<?php echo $newsletter->getId(); ?>" data-id="<?php echo $newsletter->getId(); ?>"><?php echo $newsletter->getNom(); ?></option>

    </br>

<?php endforeach ?>
</select>


<!--
<form class="form-horizontal" enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="formAddMail" value="true">
    <div class="form-group">
        <label for="libeleMail" class="col-sm-2 control-label"><strong>Nom du mail</strong></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="libeleMail" placeholder="Nom du mail">
        </div>
    </div>
    <div class="form-group">
        <label for="objetMail" class="col-sm-2 control-label"><strong>Objet</strong></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="objetMail" placeholder="Objet du mail">
        </div>
    </div>
    <div class="form-group">
        <label for="corpsMail" class="col-sm-2 control-label"><strong>Corps</strong></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="corpsMail" placeholder="Corps du mail">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn success">Ajouter</button>
        </div>
    </div>
</form>
-->