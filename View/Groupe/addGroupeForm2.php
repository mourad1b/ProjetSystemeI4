<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des groupes</h3>
<br>
<div class="row text-center">
    <div class="starter-template">
        <div id="user-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
            <button id="btnNewGroupe" class="btn btn-warning btnNewGroupe" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnImporterUsers" class="btn btn-primary btnImporterUsers">Importer CSV</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idGroupe col-md-1">Id</div>
                    <div class="nom col-md-3">Nom</div>
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
                <h4 class="modal-title" id="myModalLabel">Ajout de nouveaux utilisateurs</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form addNewGroupe" id="addNewGroupe" enctype="multipart/form-data">
                    <!--<div class="form-group">
                        <span class="help-block">Charger un fichier .CSV * <br>(respecter le formalisme suivant : <strong>nom; prenom; mail; telephone</strong>)</span>
                        <label for="filecsv" class="col-sm-3 control-label"></label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control filecsv modalRequired" id="filecsv" name="filecsv" size="60" onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="inputIdGroupe" class="col-sm-2 control-label"><strong>Numéro</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdGroupe' class="form-control inputIdGroupe key"  value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNom" class="col-sm-2 control-label"><strong>Nom</strong></label>
                        <div class="col-sm-9">
                            <input id="inputNom" class="form-control inputNom" name="inputNom" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrenom" class="col-sm-2 control-label"><strong>Prénom</strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputPrenom" id="inputPrenom" name="inputPrenom" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMail" class="col-sm-2 control-label"><strong>E-mail<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input class="form-control inputMail modalRequired" id="inputMail" name="inputMail" value=""  onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
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

<!--
<div class="panel panel-info panelImporterUsers">
    <div class="panel-body">
        <form class="form-horizontal addFile" id="addFile"  enctype="multipart/form-data">
            <div class="form-group">
                <span class="help-block">Charger un fichier CSV * <br>(respecter le formalisme suivant : <strong>nom; prenom; mail; telephone</strong>)</span>
                <label for="filecsv" class="col-sm-3 control-label"></label>
                <div class="col-sm-12">
                    <input type="file" class="form-control filecsv" id="filecsv" name="filecsv" size="60" onload="IHM.validateModal()">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                </div>
            </div>
        </form>
    </div>
</div>
-->

<script src="../Web/scripts/Groupe2.js"></script>
