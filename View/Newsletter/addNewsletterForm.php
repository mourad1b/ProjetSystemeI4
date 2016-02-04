<h3 class="text-center">Gestion des newsletters</h3>
<br>
<p>
    Visualiser liste des newsletter ;
</p>
<p><strong>A Faire :</strong>
</p>

<div class="panel panel-info">
    <div class="panel-heading"><span><a class="glyphicon glyphicon-plus addNews btnAjouter pull-right" title="Ajouter"></a></span>
        <h3 class="panel-title">Gestion des newsletters</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal formManageNewsletter" id="formNewsletter" role="form" enctype="multipart/form-data" action="../Web/index.php" method="post">
            <input type="hidden" name="formManageNewsletter" value="true">
            <ul id="listGroupe" class="list-group">
                <?php /** @var Newsletter $newsletter */
                foreach($newsletters as $newsletter): ?>
                    <li class="list-group-item" id="idNewsletter" data-id="<?php echo $newsletter->getId(); ?>"
                        value="<?php echo $newsletter->getId(); ?>">
                        <span class=""><?php echo $newsletter->getNom(); ?></span>
                        <span><a class="glyphicon glyphicon-trash suppNews btnSupprimer pull-right" title="Supprimer"></a>
                        <a class="glyphicon glyphicon-pencil modifNews btnModifier pull-right" title="Modifier"></a>
                            </span>
                    </li>

                <?php endforeach ?>
            </ul>
        </form>
    </div>
</div>
<div id="1" class="panel panel-body" style="display:none">
    <form class="form-horizontal" enctype="multipart/form-data" action="index.php" method="post">
        <input type="hidden" name="formManageNewsletter" value="true">
        <div class="form-group">
            <label for="nomNewsletter" class="col-sm-2 control-label"><strong>Nom</strong></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="nomNewsletter" placeholder="Nom du Newsletter">
            </div>
        </div>
        <div class="form-group">
            <label for="lienNewsletter" class="col-sm-2 control-label"><strong>Lien</strong></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lienNewsletter" id="lienNewsletter" placeholder="Lien">
            </div>
        </div>
        <div class="form-group">
            <label for="photoNewsletter" class="col-sm-2 control-label"><strong>Photo</strong></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="photoNewsletter" id="photoNewsletter"  placeholder="Photo du newsletter">
            </div>
        </div>
        <div class="form-group">
            <label for="corpsMail" class="col-sm-2 control-label"><strong>Texte</strong></label>
            <div class="col-sm-8">
            <TEXTAREA NAME="texteNewsletter" ROWS="5" COLS="50"></TEXTAREA>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <button type="submit" class="btn btn success">Soumettre</button>
            </div>
        </div>
    </form>
</div>


<div class="form-group">
    <label for="libelle" class="col-sm-2 control-label">
        <strong>Newsletters</strong></label>
</div>
<select id="selectGroupe" class="col-sm-6">
    <option hidden="hidden">Sélectionner</option>
    <?php /** @var Newsletter $newsletter */
    foreach($newsletters as $newsletter): ?>
    <option id="<?php echo $newsletter->getId(); ?>"
        value="<?php echo $newsletter->getId(); ?>"
        data-id="<?php echo $newsletter->getId(); ?>"><?php echo $newsletter->getNom(); ?></option>
    </br>
<?php endforeach ?>
</select>


<script type="text/javascript">
    $(function() {

        var objectUsers = [];
        var idUser, idGroupe, idNewsletter;
        var selectGroupe = $('#selectGroupe');
        var loadingImg = $('#loading-img');
        var divOne = document.getElementById('1');

        var addNews = $(".addNews");
        var modifNews = $(".modifNews");
        var supprNews = $(".supprNews");
        var selectNewsletter = $('#idNewsletter');

        loadingImg.hide();

        addNews.click(function (e) {
            e.stopPropagation();

            divOne.style.display = 'block';
            console.log("clic sur ajout ");
            //loadingImg.show();
                });

        modifNews.click(function (e) {
            e.stopPropagation();
            url = "../Web/index.php?action=update";
            idNewsletter = selectNewsletter.data('id');

            console.log(idNewsletter);
            loadingImg.show();
            $.post(url)
             .done(function (data) {
                console.log(data);
                    loadingImg.hide();
             });


        });
    });
</script>
