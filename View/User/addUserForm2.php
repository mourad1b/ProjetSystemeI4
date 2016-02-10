<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des utilisateurs</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="user-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
            <button class="sort btn btn-default" data-sort="prenom">Tri par Prénom</button>
            <button class="sort btn btn-default" data-sort="mail">Tri par Mail</button>
            <button id="btnNewUser" class="btn btn-warning btnNewUser" data-toggle="modal" data-target="#modal">Nouveau</button>
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
                <h4 class="modal-title" id="myModalLabel">Utilisateur</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionMail" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNom" class="col-sm-2 control-label"><strong>Nom</strong></label>
                        <div class="col-sm-9">
                            <input id='inputIdUser' class="form-control inputIdUser " type="hidden" value=""/>
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
