<h3 class="text-center">Formulaire d'ajout des mails </h3>
<br>
<p>
    Visualiser liste des mails ;
</p>
<p><strong>A Faire :</strong> ajouter/modifier les mails
</p>
<div class="panel panel-info">
    <div class="panel-heading addFile">
        <h3 class="panel-title">Ajout des mails</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data" action="index.php" method="post">
            <input type="hidden" name="formAddMail" value="true">
            <div class="form-group">
                <label for="libeleMail" class="col-sm-2 control-label"><strong>Nom du mail</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="libeleMail" placeholder="Nom du mail">
                </div>
            </div>
            <div class="form-group">
                <label for="objetMail" class="col-sm-2 control-label"><strong>Objet</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="objetMail" placeholder="Objet du mail">
                </div>
            </div>
            <div class="form-group">
                <label for="corpsMail" class="col-sm-2 control-label"><strong>Corps</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="corpsMail" placeholder="Corps du mail">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                    <button type="submit" class="btn btn success">Soumettre</button>
                </div>
            </div>
        </form>
    </div>
</div>