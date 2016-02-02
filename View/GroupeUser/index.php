<?php

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeUser;

?>
<div class="row">
    <div class="small-12 small-centered column">
        <?php if (isset($flash)) {
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<div data-alert class="alert-box success radius">';
            echo $flash;
            echo '</div>';
        }?>
    </div>
</div>

</br></br>

<div id="main">
    <div class="loading">
        <img src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif" alt="loading" width="71" height="61"
             id="loading"/>
    </div>
    <div id="pageContent">

    </div>
</div>








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