<?php

use nsNewsletter\Model\Groupe;

?>
<!--
<div class="row">
    <div class="small-12 small-centered column">
         < ?php if (isset($flash)) {
             echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
             echo '<div data-alert class="alert-box success radius">';
             var_dump($flash);
             echo $flash;
            echo '</div>';
        }?>
    </div>
</div>
 -->
<?php if (isset($flash)) {
    echo '<div class="alert-box success">';
    echo $flash;
    echo '</div>';
}?>
<!--<p id="loading-img" style="display: none"><img
        src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif"
        alt="loading">
</p>
-->
</br>

</br>


<div id="main">
    <div class="loading">
        <img src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif" alt="loading" width="71" height="61"
             id="loading"/>
    </div>
    <div id="pageContent">

        <div id="alertMsg" class="alert-box" style="display: none;">
            <div class="close-box">x</div>
            <span class="type"></span>
            <span class="msg"></span>
        </div>

        <div class="file-wrap">
            <div class="commit commit-tease js-details-container"></div>
            <div class="tab">
                <div class="level1">
                    <div class="ligne">
                        <div class="col icon">
                            <span class="glyphicon glyphicon-folder-close"></span>
                            <img alt="" class="loading" height="16"
                                 src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif" width="16">
                        </div>
                        <div class="col content">
                            <a href="#" title="">Liste des groupes contenant des utilisateurs </a>
                        </div>

                        <div class="col">
                            <span>#Nombre d'utilisateurs / Groupe</span>
                        </div>
                    </div>
                    <?php   /** @var Groupe $groupe */
                    foreach($groupes as $groupe): ?>
                    <div class="level2">
                        <div class="ligne">
                            <div class="col icon">
                                <span class="glyphicon glyphicon-folder-close"></span>
                                <img alt="" class="loading" height="16"
                                     src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif" width="16">
                            </div>
                            <div class="col content">
                                <a href="#" title="<?php echo $groupe->getLibelle(); ?>"><?php echo $groupe->getLibelle(); ?></a>
                            </div>

                            <div class="col">
                                <span><?php echo $groupe->getCountUser(); ?></span>
                            </div>
                        </div>
                        <?php /** @var User $user */ foreach($users as $user): ?>
                            <?php if($user->getIdGroupe() == $groupe->getId()): ?>
                            <div class="level3">
                                <div class="ligne">
                                    <div class="col icon">
                                        <span class="glyphicon glyphicon-folder-close"></span>
                                        <img alt="" class="loading" height="16"
                                             src="http://officedelamer.com/office/wp-content/plugins/ajax-campaign-monitor-forms/ajax-loading.gif"
                                             width="16">
                                    </div>
                                    <div class="col content">
                                        <a href="#"
                                           title=""><?php echo $user->getMail(); ?></a>
                                    </div>
                                    <div class="col">
                                                        <span></span>
                                    </div>
                                </div>

                                <div class="last-level" data-userId="">
                                    <div class="ligne">
                                        <table>
                                            <tbody>
                                            <tr class="champTitre">
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Mail</th>
                                                <th>Télephone</th>
                                            </tr>


                                            <tr id="">
                                                <td class="nom"><input type="text" name="nom"
                                                                       value="<?php echo $user->getNom(); ?>" disabled></td>
                                                <td class="prenom"><input type="text" name="prenom"
                                                                      value="<?php echo $user->getPrenom(); ?>" disabled></td>
                                                <td class="mail"><input type="text" name="td"
                                                                      value="<?php echo $user->getMail(); ?>" disabled></td>
                                                <td class="telephone"><input type="text" name="telephone"
                                                                        value="<?php echo $user->getTelephone(); ?>" disabled></td>
                                                <td class="btn_action">
                                                    <a href="#" title="Modifier"
                                                       class='btnModifier'><span
                                                            class="glyphicon glyphicon-pencil"></span></a>
                                                    <a href="#" title="Supprimer"
                                                       class='btnSupprimer'><span
                                                            class="glyphicon glyphicon-trash"></span></a>
                                                    <a href="#" title="Valider"
                                                       class='btnValider'><span
                                                            class="glyphicon glyphicon-ok"></span></a>
                                                </td>
                                            </tr>

                                            </tbody>
                                            <tr>
                                                <td><a href="" class="newUser"><span
                                                            class="glyphicon glyphicon-plus"></span>
                                                        Ajouter un utilisateur</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- PageContent -->

    <div id="menu_right">
        <h1>Informations</h1>

        <p>=> sur l'utilisateur ??</p>

        <p> => sur la newsletters ??</p>

        <p></p>
    </div>
</div>





<!--<script type="text/javascript">
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
-->