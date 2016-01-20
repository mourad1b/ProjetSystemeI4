<?php

use Newsletter\Model\Groupe;

?>
<div class="row">
    <div class="small-12 small-centered column">
        <div class="row">
            <form action="index.php" method="post">
                <div class="large-12 columns">
                    <div class="row collapse prefix-radius">
                        <div class="small-12 columns">
                            <div class="row collapse">

                                <div class="small-2 columns">

                                   <!-- <input type="submit" class="button postfix" value="Rechercher"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php if (isset($flash)) {
            echo '<div data-alert class="alert-box success radius">';
            echo $flash;
            echo '</div>';

        }?>

        <h3>Libelle groupe</h3>
        <select class="form-control m-b">
            <option value="value1"></option>
            <?php
            /** @var Groupe $groupe */
            foreach ($groupes as $groupe){

                echo '<option id="id_groupe" data-id="1" value="">' . $groupe->getLibelle() . '</option>';

            }
            ?>
        </select>
    </div>
</div>

<p id="loading-img" style="display: none"><img
        src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif"
        alt="loading"></p>
</br>

<script>
    $(function() {


        var objectUsers = [];

        var idUser, idGroupe;

        var selectGroupe = $('#id_groupe');

        var loadingImg = $('#loading-img');

        console.log(loadingImg);

        /*selectTypeDiplome.change(function (e) {
            e.stopPropagation();
            idTypeDiplome = selectTypeDiplome.val();
            selectTypeDiplome.attr('disabled', 'disabled');
            editFiche.hide();
            showFiche.hide(); //desactiver l'affichage de la fiche
            loadingImg.show();
            $.post(Routing.generate('kmgh_app_matiere_listeDiplomesAjax'), {id: idTypeDiplome})
                .done(function (data) {
                    selectDiplome.append('<option hidden="hidden">-- Diplôme --</option>');
                    $.each(data, function (i, item) {
                        selectDiplome.append($('<option>', {
                            value: item.id,
                            text: item.nom
                        }));
                        tabDiplomes[i] = item.id;
                        objectDiplomes[i] = data[i];
                    });
                    selectTypeDiplome.removeAttr('disabled');
                    selectDiplome.show();
                    loadingImg.hide();
                });
        });
        */

    });
</script>