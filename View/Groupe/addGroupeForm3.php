<h3 class="text-center">Gestion des groupes</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="groupe-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="libelle">Tri par Nom</button>
            <button id="btnNewGroupe" class="btn btn-warning btnNewGroupe" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnParametresGroupe" class="btn btn-primary btnParametresGroupe" data-toggle="modal" data-target="#modal">Paramètres</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idGroupe col-md-3">Id</div>
                    <div class="libelle col-md-6">Libelle</div>
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
                <h4 class="modal-title" id="myModalLabel">Paramètres Groupes</h4>
            </div>
            <div class="loader text-center" id="loaderr" style="display: none">
                <img src="../Web/styles/img/loading-img.gif" alt="loading">
                <br><span>Chargement des données...</span>
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
                    <div class="form-group">
                        <label for="inputObjet" class="col-sm-2 control-label"><strong>Objet</strong></label>
                        <div class="col-sm-9">
                            <input id="inputObjet" class="form-control inputObjet" name="inputObjet" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDestinataire" class="col-sm-2 control-label"><strong>Destinataire</strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputDestinataire" id="inputDestinataire" name="inputDestinataire" value=""">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTemplate" class="col-sm-2 control-label"><strong>Template<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="form-control inputSelectTemplate " id="inputSelectTemplate" name="inputSelectTemplate" value="">
                                <option></option>
                            </select>
                            <!--modalRequired onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback " title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                            -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputGroupe" class="col-sm-2 control-label"><strong>Groupe<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <select class="form-control inputSelectGroupe" id="inputSelectGroupe" name="inputSelectGroupe">
                                <option></option>
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


<!-- JS -->
<script src="../Web/scripts/Groupe3.js"></script>
<script src="../Web/scripts/Ajax.js"></script>
<script src="../Web/scripts/Example.js"></script>
