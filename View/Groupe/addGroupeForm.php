<!--<h3 class="text-center">Formulaire d'affectation des groupes</h3>
-->
</br>

<p id="loading-img" style="display: none"><img
        src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif"
        alt="loading">
</p>
<?php if (isset($flash)) {
    echo '<div data-alert class="alert-box success radius">';
    echo $flash;
    echo '</div>';

}?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Affectation des groupes</h3>
    </div>
    <div class="panel-body">
        <ul id="listGroupe" class="list-group">
            <?php /** @var Groupe $groupe */
            foreach($groupesCount as $groupe): ?>
                <?php //if($user->getIdGroupe() == $groupe->getId()): ?>
                <li class="list-group-item" id="<?php echo $groupe->getId(); ?>" data-id="<?php echo $groupe->getId(); ?>" value="<?php echo $groupe->getId(); ?>">
                    <span class=""><?php echo $groupe->getLibelle(); ?></span>
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
    <strong>Groupe</strong></label>
</div>
<select id="selectGroupe" class="col-sm-6">
    <option hidden="hidden">Sélectionner</option>
    <?php /** @var Groupe $groupe */
    foreach($groupesCount as $groupe): ?>
        <?php //if($user->getIdGroupe() == $groupe->getId()): ?>
        <option id="<?php echo $groupe->getId(); ?>" value="<?php echo $groupe->getId(); ?>" data-id="<?php echo $groupe->getId(); ?>"><?php echo $groupe->getLibelle(); ?></option>
    <?php endforeach ?>
</select>


<script type="text/javascript">
    $(function() {


        var objectUsers = [];
        var idUser, idGroupe;
        var selectGroupe = $('#selectGroupe');
        var loadingImg = $('#loading-img');
        var formAddUsersCsv = $('#formAddUsersCsv');

        loadingImg.hide();
        formAddUsersCsv.hide();

        selectGroupe.change(function (e) {
            e.stopPropagation();
            idGroupe = selectGroupe.val();
            console.log(idGroupe);

            formAddUsersCsv.show();
            //selectGroupe.attr('disabled', 'disabled');
            //loadingImg.show();

            /*$.post("../Web/index.php?adduser", {id: idGroupe})
                .done(function (data) {



                    //selectGroupe.append('<option hidden="hidden">-- Diplôme --</option>');
                    /*$.each(data, function (i, item) {
                        selectDiplome.append($('<option>', {
                            value: item.id,
                            text: item.nom
                        }));
                        tabDiplomes[i] = item.id;
                        objectDiplomes[i] = data[i];
                    });
                    * /

                    formAddUsersCsv.show();
                    loadingImg.hide();
                });
        */
        });

    });
</script>