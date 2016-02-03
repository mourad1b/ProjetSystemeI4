<?php

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeUser;

?>
<div class="small-6 small-centered column">
    <?php if (isset($flash)) {
        echo '<div id="setTimeout" data-alert class="alert alert-success">';
        echo $flash;
        echo '</div>';
    }?>
</div>

</br>

<script>
    $(function() {
        var objectUsers = [];
        var idUser, idGroupe;
        var selectGroupe = $('#id_groupe');
        var loadingImg = $('#loading-img');
        //console.log(loadingImg);

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