<h3 class="text-center">Formulaire d'ajout des utilisateurs</h3>

<div class="panel panel-info">
    <div class="panel-heading addFile">
        <h3 class="panel-title">Ajout des utilisateurs</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal addFile" id="formFile" role="form" enctype="multipart/form-data" action="index.php" method="post">
            <input type="hidden" name="formAddUser" value="true">
            <div class="form-group">
                    <label for="upload_file_csv" class="col-sm-10 control-label">
                        <span class="help-block">Charger un fichier CSV * (respecter le formalisme : nom; prenom; mail; telephone)</span>
                    </label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="upload_file_csv" name="upload_file_csv" size="60" required/>
                    </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn success">Soumettre</button>
                </div>
            </div>
        </form>
    </div>
</div>