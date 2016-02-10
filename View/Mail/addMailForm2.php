<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des mails</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="mail-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelle">Tri par Libellé</button>
            <button class="sort btn btn-default" data-sort="objet">Tri par Objet</button>
            <button class="sort btn btn-default" data-sort="corps">Tri par Body</button>
            <button id="btnNewMail" class="btn btn-warning btnNewMail" data-toggle="modal" data-target="#modal">Nouveau</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idMail col-md-1">Id</div>
                    <div class="libelle col-md-3">Libellé</div>
                    <div class="objet col-md-3">Objet</div>
                    <div class="corps col-md-4">Body</div>
                </li>
            </ul>
            <ul class="listMail list list-unstyled"></ul>
        </div>
    </div>
</div>
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentMail" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mail</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionMail" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputLibelle" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdMail' class="form-control inputIdMail" type="hidden" value=""/>
                            <input id="inputLibelle" class="form-control inputLibelle modalRequired" name="inputLibelle" value=""onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputObjet" class="col-sm-2 control-label"><strong>Objet<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputObjet modalRequired" id="inputObjet" name="inputObjet" value=""onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBody" class="col-sm-2 control-label"><strong>Body<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputBody modalRequired" id="inputBody" name="inputBody" value=""  onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
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
