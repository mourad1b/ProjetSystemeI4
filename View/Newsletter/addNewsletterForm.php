<h3 class="text-center">Gestion des newsletters</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="mail-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
            <button id="btnNewNews" class="btn btn-warning btnNewNews" data-toggle="modal" data-target="#modal">Nouveau</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="id_Newsletter col-md-1">Id</div>
                    <div class="nom col-md-3">Nom</div>
                    <div class="photo col-md-3">Photo</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>


<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentMail" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Gestion des Newsletter</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionMail" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNom" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id="inputNom" class="form-control inputNom modalRequired" name="inputNom" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-sm-2 control-label"><strong>Photo<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputPhoto modalRequired" id="inputPhoto" name="inputPhoto" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLien" class="col-sm-2 control-label"><strong>Lien<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputLien modalRequired" id="inputLien" name="inputLien" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTexte" class="col-sm-2 control-label"><strong>Lien<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputTexte modalRequired" id="inputTexte" name="inputTexte" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitMail buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>

<script src="../Web/scripts/Newsletter.js"></script>
