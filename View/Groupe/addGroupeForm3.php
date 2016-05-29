<h3 class="text-center">Gestion des groupes</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="groupe-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelleGroupe">Tri par Libelle</button>
            <button id="btnNewGroupe" class="btn btn-warning btnNewGroupe" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnAffectationGroupe" class="btn btn-primary btnAffectationGroupe" data-toggle="modal" data-target="#modalAffect">Affectation</button>

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
                <h4 class="modal-title" id="myModalLabel">Gestion Groupe</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionGroupe" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputIdGroupe" class="col-sm-2 control-label"><strong>Numéro</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdGroupe' class="form-control inputIdGroupe key" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLibelle" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id="inputLibelle" class="form-control inputLibelle modalRequired" name="inputLibelle" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label for="inputSelectGroupes" class="col-sm-2 control-label"><strong>Groupes<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select multiple="multiple" class="inputSelectGroupes" id="inputSelectGroupes" name="inputSelectGroupes">
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="inputSelectUsers" class="col-sm-2 control-label"><strong>Utilisateurs<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select multiple="multiple" class="inputSelectUsers" id="inputSelectUsers" name="inputSelectUsers">
                                <option value='7' data-id='7'>mourad_bzd@hotmail.fr</option>
                                <option value='4' data-id='4'>mourad.benzaid@epsi.fr</option>
                                <option value='2' data-id='2'>mourad1benzaid@gmail.com</option>
                                <option value='1' data-id='1'>mb@mourad-benzaid.fr</option>
                            </select>
                            <!--modalRequired onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                            -->
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


<div id="modalAffect" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentGroupe" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Affectation Utilisateurs-Groupes</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionGroupe" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputSelectGroupeAffect" class="col-sm-2 control-label"><strong>Groupes<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="inputSelectGroupeAffect" id="inputSelectGroupeAffect" name="inputSelectGroupeAffect">
                                <option value='2' data-id='2'>INGENIERIE--4</option>
                                <option value='3' data-id='3'>	BACHELOR-1</option>
                                <option value='4' data-id='4'>BTS</option>
                                <option value='5' data-id='5'>TEST</option>
                                <option value='21' data-id='21'>testAffect7</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSelectUsersAffect" class="col-sm-2 control-label"><strong>Utilisateurs<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select multiple="multiple" class="inputSelectUsersAffect" id="inputSelectUsersAffect" name="inputSelectUsersAffect">
                                <option value='7' data-id='7'>mourad_bzd@hotmail.fr</option>
                                <option value='4' data-id='4'>mourad.benzaid@epsi.fr</option>
                                <option value='2' data-id='2'>mourad1benzaid@gmail.com</option>
                                <option value='1' data-id='1'>mb@mourad-benzaid.fr</option>
                            </select>
                            <!--modalRequired onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                            -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitGroupe">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="../Web/scripts/Groupe3.js"></script>
<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/Example.js"></script>
<script>
    $('select#inputSelectUsers').multipleSelect({filter: true});
    $('select#inputSelectUsersAffect').multipleSelect({filter: true});
</script>