<h3 class="text-center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
    xmlns="http://www.w3.org/1999/html">Gestion des utilisateurs</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>


<div class="starter-template">
    <div id="user-list">
        <input class="search" />
        <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
        <button class="sort btn btn-default" data-sort="prenom">Tri par Prénom</button>
        <button class="sort btn btn-default" data-sort="mail">Tri par Mail</button>
        <button id="newUser" class="btn btn-warning" data-toggle="modal" data-target="#modal">Nouveau</button>
        <ul class="menu list-unstyled">
            <li class="row">
                <div class="id col-md-1">Id</div>
                <div class="nom col-md-3">Nom</div>
                <div class="prenom col-md-3">Prénom</div>
                <div class="mail col-md-4">E-mail</div>
            </li>
        </ul>
        <ul class="list list-unstyled"></ul>
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
                <div class="form-group">
                    <label for="inputNom">Nom</label>
                    <input id='inputId' type="hidden" value="" class="form-control" role="input"/>
                    <input id='inputNom' type="text" value="" class="form-control" role="input"/>
                </div>
                <div class="form-group">
                    <label for="inputPrenom">Prenom</label>
                    <input id='inputPrenom' type="text" value="" class="form-control" role="input"/>
                </div>
                <div class="form-group">
                    <label for="inputMail">E-mail<span>*</span></label>
                    <input id='inputMail' type="text" value="" class="form-control" role="input"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success submitUser">Valider</button>
            </div>
        </div>
    </div>
</div>