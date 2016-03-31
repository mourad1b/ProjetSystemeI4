<h3 class="text-center">Gestion des templates</h3>
<br>
<div id="flashMessage" class="alert hidden"></div>

<div class="row text-center">
    <div class="starter-template">
        <div id="newsletter-list">
            <input class="search" />
            <button class="sort btn btn-default" data-sort="nom">Tri par Nom</button>
            <button class="sort btn btn-default" data-sort="contenu">Tri par Contenu</button>
            <button id="btnNewNews" class="btn btn-warning btnNewNews" data-toggle="modal" data-target="#modal">Nouveau</button>
            <ul class="menu list-unstyled">
                <li class="row">
                    <div class="idNewsletter col-md-1">Id</div>
                    <div class="nom col-md-3">Nom</div>
                    <div class="contenu col-md-4">Contenu</div>
                    <div class="lien col-md-3">lien</div>
                </li>
            </ul>
            <ul class="list list-unstyled"></ul>
        </div>
    </div>
</div>


<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div id="modalContentNews" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Gestion des templates</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal formActionNews" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNom" class="col-sm-2 control-label"><strong>Libellé<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <input id="inputNom" class="form-control inputNom modalRequired" name="inputNom" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContenu" class="col-sm-2 control-label"><strong>Contenu<span>*</span></strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control inputContenu " id="inputContenu" name="inputContenu" value=""></textarea>
                            <!--<input class="form-control inputContenu modalRequired" id="inputContenu" name="inputContenu" value="" onkeypress="IHM.validateModal()" onkeyup="IHM.validateModal()">-->
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback hasTooltip" title="Champ obligatoire" data-placement="left" style="display:none;"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success btnSubmitNewsletter buttonValide">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="../Web/scripts/Newsletter2.js"></script>
<!-- tinymce -->

<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<script src='../Web/tinymce/tinymce.min.js'></script>

<script>
    tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        plugins : 'advlist autolink link image lists charmap print preview',
    });
</script>
