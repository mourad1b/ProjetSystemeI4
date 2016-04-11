<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des utilisateurs</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>
<div id="resultcsv"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="user-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
            <button class="sort btn btn-default" data-sort="prenom">Tri par Prénom</button>
            <button class="sort btn btn-default" data-sort="mail">Tri par Mail</button>
            <button id="btnNewUser" class="btn btn-warning btnNewUser" data-toggle="modal" data-target="#modal">Nouveau</button>
            <button id="btnImporterUsers" class="btn btn-primary btnImporterUsers">Importer CSV</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idUser col-md-1">Id</div>
                    <div class="nom col-md-3">Nom</div>
                    <div class="prenom col-md-3">Prénom</div>
                    <div class="mail col-md-4">E-mail</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContent" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout de nouveaux utilisateurs</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form addNewUser" id="addNewUser" enctype="multipart/form-data">
                    <!--<div class="form-group">
                        <span class="help-block">Charger un fichier .CSV * <br>(respecter le formalisme suivant : <strong>nom; prenom; mail; telephone</strong>)</span>
                        <label for="upload_file_csv" class="col-sm-3 control-label"></label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control upload_file_csv modalRequired" id="upload_file_csv" name="upload_file_csv" size="60" onchange="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="inputIdUser" class="col-sm-2 control-label"><strong>Numéro</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdUser' class="form-control inputIdUser key"  value=""/>
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
                <button type="button" class="btn btn-success btnSubmitUser buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-info panelImporterUsers">
    <!--<div class="panel-heading">
        <h3 class="panel-title">Ajout des utilisateurs</h3>
    </div>
    -->
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

<script src="../Web/scripts/User2.js"></script>
