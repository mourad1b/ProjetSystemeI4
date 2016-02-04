<h3 class="text-center">Formulaire d'affectation des groupes</h3>
<br>
<p>
    Visualiser liste des groupe ;
</p>
<p><strong>A Faire :</strong>
    pouvoir ajouter/modifier des groupes (clic sur +/crayon);
</p>
<?php if (isset($flash)) {
    echo '<div data-alert class="alert-box success radius">';
    echo $flash;
    echo '</div>';

}?>

<div class="panel panel-info">
    <div class="panel-heading">
        <span><a class="glyphicon glyphicon-plus addGroupe btnAjouter pull-right" title="Ajouter"></a></span>
        <h3 class="panel-title">Affectation des groupes</h3>
    </div>
    <div class="panel-body">
        <ul id="listGroupe" class="list-group">
            <?php /** @var Groupe $groupe */
            foreach($groupesCount as $groupe): ?>
                <?php //if($user->getIdGroupe() == $groupe->getId()): ?>
                <li class="list-group-item" id="<?php echo $groupe->getId(); ?>" data-id="<?php echo $groupe->getId(); ?>" value="<?php echo $groupe->getId(); ?>">
                    <span class=""><?php echo $groupe->getLibelle(); ?></span>
                    <span><a class="glyphicon glyphicon-trash supprGroupe btnSupprimer pull-right" title="Modifier"></a>
                    <a class="glyphicon glyphicon-pencil modifGroupe btnModifier pull-right" title="Supprimer"></a>
                        </span>
                </li>

            <?php endforeach ?>
        </ul>
    </div>
</div>

<script type="text/javascript">
    $(function() {


        var objectUsers = [];
        var btnModifier= $(".btnModifier");
        var idUser, idGroupe;
        var selectGroupe = $('#selectGroupe');
        var loadingImg = $('#loading-img');
        var formAddUsersCsv = $('#formAddUsersCsv');

        loadingImg.hide();
        formAddUsersCsv.hide();

        btnModifier.click(function (e) {
            e.stopPropagation();
            //idSearchInput = searchInput.val();
            /*$.post(
            "/filtres/ajax/ficheProspect.php", {idsSelected: idsSelected})
             .done(function (data) {
             console.log(data);
             });
             */

        });

        selectGroupe.change(function (e) {
            e.stopPropagation();
            idGroupe = selectGroupe.val();
            console.log(idGroupe);

            //formAddUsersCsv.show();
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