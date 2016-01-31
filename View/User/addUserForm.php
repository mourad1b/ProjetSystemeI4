<h3 class="text-center">Formulaire d'ajout des utilisateurs</h3>
<br>
<form class="form-horizontal" enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="formAddUser" value="true">
    <div class="form-group">
        <label for="upload_file_csv">
            <strong>Charger un fichier CSV * (respecter le formalisme : nom; prenom; mail; telephone)</strong>
        </label>
        <br>
        <div class="col-sm-offset-4 col-sm-10">
            <input type="file" id="upload_file_csv" name="upload_file_csv" size="60" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <button type="submit" class="btn btn success">Soumettre</button>
        </div>
    </div>
</form>