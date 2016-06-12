<h3 class="text-center">Gestion des groupes</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="groupe-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelleGroupe">Tri par Libelle</button>
            <button id="btnNewGroupe" class="btn btn-warning btnNewGroupe" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnAffectationGroupe" class="btn btn-primary btnAffectationGroupe" data-toggle="modal" data-target="#modal">Affectation</button>

            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idGroupe col-md-2">Id</div>
                    <div class="libelleGroupe col-md-5">Libelle</div>
                    <div class="nbUsers col-md-2">Nb Utilisateurs</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentGroupe" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Gestion des groupes</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionGroupe" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputLibelle" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputLibelle modalRequired" id="inputLibelle" name="inputLibelle" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()" onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSelectGroupeAffect" class="col-sm-2 control-label"><strong>Groupe<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="form-control inputSelectGroupeAffect modalRequired" id="inputSelectGroupeAffect" name="inputSelectGroupeAffect" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()" onchange="IHM.validateModal()">
                                <!--<option></option>-->
                            </select>
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSelectUsersAffect" class="col-sm-2 control-label"><strong>Utilisateurs<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select multiple="multiple" class="inputSelectUsersAffect" id="inputSelectUsersAffect" name="inputSelectUsersAffect">                            </select>
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitGroupe buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="../Web/scripts/Groupe3.js"></script>
<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/Example.js"></script>

<script>
    //$('select#inputSelectUsers').multipleSelect({filter: true});
    //$('#inputSelectUsersAffect').multipleSelect({filter: true});

    $(".inputSelectUsersAffect").select2({
        theme: "classic"
    });

</script>


<!--
<option value='7' data-id='7'>mourad_bzd@hotmail.fr</option>
<option value='4' data-id='4'>mourad.benzaid@epsi.fr</option>
<option value='2' data-id='2'>mourad1benzaid@gmail.com</option>
<option value='1' data-id='1'>mb@mourad-benzaid.fr</option>
-->