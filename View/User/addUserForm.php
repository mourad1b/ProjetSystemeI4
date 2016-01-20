<h3 class="text-center">Formulaire d'ajout des utilisateurs</h3>
<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="formAddUser" value="true">
    <div class="row">
        <div class="large-12 columns">
            <label>
                <strong>Charger un fichier CSV *</strong>
                <input type="file" name="upload_file_csv" size="60" required />
            </label>
        </div>
    </div>
    <div class="row text-center">
        <input type="submit" class="radius button success" value="Soumettre">
    </div>
</form>