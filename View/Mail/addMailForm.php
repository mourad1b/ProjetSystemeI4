<h3 class="text-center">Formulaire d'ajout des MAILS </h3>
<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="formAddMail" value="true">
    <div class="row">
        <div class="large-12 columns">
            <label>
                <strong> VUE => Ajouter un mail</strong>
                <input type="text" name="libelleMail" id="libelleMail" value="Nom du mail"/>
                <input type="text" name="objetMail" id="objetMail" value="Objet du mail"/>
                <input type="text" name="bodyMail" id="bodyMail" value="Corp du mail"/>
                <input type="submit" class="radius button success" value="Ajouter"/>
            </label>
        </div>
    </div>
    <br>
    <br>

</form>